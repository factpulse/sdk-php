<?php
/**
 * FactPulse SDK - Thin HTTP wrapper with auto-polling.
 *
 * Usage:
 *   $client = new FactPulseClient('email', 'password', 'client_uid');
 *
 *   // POST /api/v1/processing/invoices/submit-complete-async
 *   $result = $client->post('processing/invoices/submit-complete-async', [
 *       'invoiceData' => [...],
 *       'destination' => ['type' => 'afnor']
 *   ]);
 *   $pdfBytes = $result['content']; // auto-decoded, auto-polled
 */
namespace FactPulse\SDK;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class FactPulseError extends \Exception {
    public ?int $statusCode;
    public array $details;

    public function __construct(string $message, ?int $statusCode = null, array $details = []) {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->details = $details;
    }
}

class FactPulseClient {
    private const DEFAULT_API_URL = 'https://factpulse.fr';

    private string $apiUrl;
    private string $email;
    private string $password;
    private string $clientUid;
    private int $timeout;
    private int $pollingTimeout;
    private HttpClient $httpClient;

    private ?string $token = null;
    private float $tokenExpiresAt = 0;

    public function __construct(
        string $email,
        string $password,
        string $clientUid,
        string $apiUrl = self::DEFAULT_API_URL,
        int $timeout = 60,
        int $pollingTimeout = 120
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->clientUid = $clientUid;
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->timeout = $timeout;
        $this->pollingTimeout = $pollingTimeout;
        $this->httpClient = new HttpClient(['timeout' => $timeout]);
    }

    /** POST request to /api/v1/{path} */
    public function post(string $path, array $data = []): array {
        return $this->request('POST', $path, $data, true);
    }

    /** GET request to /api/v1/{path} */
    public function get(string $path, array $params = []): array {
        return $this->request('GET', $path, $params, true);
    }

    /** POST request with multipart/form-data (for file uploads) */
    public function postMultipart(string $path, array $data = [], array $files = []): array {
        return $this->requestMultipart($path, $data, $files, true);
    }

    private function request(string $method, string $path, array $data, bool $retryAuth): array {
        $this->ensureAuth();
        $url = "{$this->apiUrl}/api/v1/{$path}";

        try {
            $options = ['headers' => ['Authorization' => "Bearer {$this->token}"]];
            if ($method === 'POST') {
                $options['json'] = $data;
                $response = $this->httpClient->post($url, $options);
            } else {
                $options['query'] = $data;
                $response = $this->httpClient->get($url, $options);
            }
            $result = json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            if ($retryAuth && method_exists($e, 'getResponse') && $e->getResponse()?->getStatusCode() === 401) {
                $this->invalidateToken();
                return $this->request($method, $path, $data, false);
            }
            $this->handleGuzzleError($e);
        }

        // Auto-poll: support both taskId (camelCase) and task_id (snake_case)
        $taskId = $result['taskId'] ?? $result['task_id'] ?? null;
        if ($taskId) {
            $result = $this->poll($taskId);
        }

        // Auto-decode: support both content_b64 and contentB64
        $b64Content = $result['content_b64'] ?? $result['contentB64'] ?? null;
        if ($b64Content) {
            $result['content'] = base64_decode($b64Content);
            unset($result['content_b64'], $result['contentB64']);
        }

        return $result;
    }

    private function requestMultipart(string $path, array $data, array $files, bool $retryAuth): array {
        $this->ensureAuth();
        $url = "{$this->apiUrl}/api/v1/{$path}";

        // Build multipart array
        $multipart = [];
        foreach ($data as $key => $value) {
            $multipart[] = ['name' => $key, 'contents' => $value];
        }
        foreach ($files as $key => $contents) {
            $multipart[] = ['name' => $key, 'contents' => $contents, 'filename' => $key];
        }

        try {
            $response = $this->httpClient->post($url, [
                'headers' => ['Authorization' => "Bearer {$this->token}"],
                'multipart' => $multipart,
            ]);
            $result = json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            if ($retryAuth && method_exists($e, 'getResponse') && $e->getResponse()?->getStatusCode() === 401) {
                $this->invalidateToken();
                return $this->requestMultipart($path, $data, $files, false);
            }
            $this->handleGuzzleError($e);
        }

        // Auto-poll: support both taskId (camelCase) and task_id (snake_case)
        $taskId = $result['taskId'] ?? $result['task_id'] ?? null;
        if ($taskId) {
            $result = $this->poll($taskId);
        }

        // Auto-decode: support both content_b64 and contentB64
        $b64Content = $result['content_b64'] ?? $result['contentB64'] ?? null;
        if ($b64Content) {
            $result['content'] = base64_decode($b64Content);
            unset($result['content_b64'], $result['contentB64']);
        }

        return $result;
    }

    private function poll(string $taskId): array {
        $start = microtime(true);
        $interval = 1.0;

        while (true) {
            $elapsed = microtime(true) - $start;
            if ($elapsed >= $this->pollingTimeout) {
                throw new FactPulseError("Polling timeout after {$this->pollingTimeout}s for task {$taskId}");
            }

            $this->ensureAuth();
            try {
                $response = $this->httpClient->get(
                    "{$this->apiUrl}/api/v1/processing/tasks/{$taskId}/status",
                    ['headers' => ['Authorization' => "Bearer {$this->token}"]]
                );
                $data = json_decode($response->getBody()->getContents(), true) ?? [];
            } catch (GuzzleException $e) {
                if (method_exists($e, 'getResponse') && $e->getResponse()?->getStatusCode() === 401) {
                    $this->invalidateToken();
                    continue;
                }
                throw new FactPulseError("Network error while polling: " . $e->getMessage());
            }

            $status = $data['status'] ?? null;

            if ($status === 'SUCCESS') {
                $result = $data['result'] ?? [];
                // Support both content_b64 and contentB64
                $b64Content = $result['content_b64'] ?? $result['contentB64'] ?? null;
                if ($b64Content) {
                    $result['content'] = base64_decode($b64Content);
                    unset($result['content_b64'], $result['contentB64']);
                }
                return $result;
            }

            if ($status === 'FAILURE') {
                $res = $data['result'] ?? [];
                throw new FactPulseError($res['errorMessage'] ?? 'Task failed', null, $res['details'] ?? []);
            }

            usleep((int)(min($interval, $this->pollingTimeout - $elapsed) * 1000000));
            $interval = min($interval * 1.5, 10);
        }
    }

    private function ensureAuth(): void {
        if (microtime(true) >= $this->tokenExpiresAt) {
            $this->refreshToken();
        }
    }

    private function refreshToken(): void {
        try {
            $response = $this->httpClient->post("{$this->apiUrl}/api/token/", [
                'json' => ['username' => $this->email, 'password' => $this->password, 'client_uid' => $this->clientUid]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
            $this->token = $data['access'] ?? throw new FactPulseError('Invalid auth response');
            $this->tokenExpiresAt = microtime(true) + 28 * 60;
        } catch (GuzzleException $e) {
            throw new FactPulseError("Authentication failed: " . $e->getMessage());
        }
    }

    private function invalidateToken(): void {
        $this->tokenExpiresAt = 0;
    }

    private function handleGuzzleError(GuzzleException $e): never {
        $msg = "API Error: " . $e->getMessage();
        $statusCode = null;
        $details = [];

        if (method_exists($e, 'getResponse') && $response = $e->getResponse()) {
            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody()->getContents(), true);
            if (is_array($body)) {
                if (is_array($body['detail'] ?? null)) {
                    $details = $body['detail'];
                    $msgs = array_map(fn($err) => ($err['loc'][count($err['loc'])-1] ?? '?') . ': ' . ($err['msg'] ?? '?'), $body['detail']);
                    $msg = 'Validation error: ' . implode('; ', $msgs);
                } elseif (is_string($body['detail'] ?? null)) {
                    $msg = $body['detail'];
                } elseif (is_string($body['errorMessage'] ?? null)) {
                    $msg = $body['errorMessage'];
                }
            }
        }

        throw new FactPulseError($msg, $statusCode, $details);
    }
}
