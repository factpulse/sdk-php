<?php
namespace FactPulse\SDK\Helpers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class FactPulseClient {
    private const DEFAULT_API_URL = 'https://factpulse.fr';
    private const DEFAULT_POLLING_INTERVAL = 2000;
    private const DEFAULT_POLLING_TIMEOUT = 120000;
    private const DEFAULT_MAX_RETRIES = 1;

    private string $email, $password, $apiUrl;
    private ?string $clientUid;
    private int $pollingInterval, $pollingTimeout, $maxRetries;
    private HttpClient $httpClient;
    private ?string $accessToken = null, $refreshToken = null;
    private ?int $tokenExpiresAt = null;

    public function __construct(string $email, string $password, ?string $apiUrl = null, ?string $clientUid = null,
        ?int $pollingInterval = null, ?int $pollingTimeout = null, ?int $maxRetries = null) {
        $this->email = $email;
        $this->password = $password;
        $this->apiUrl = rtrim($apiUrl ?? self::DEFAULT_API_URL, '/');
        $this->clientUid = $clientUid;
        $this->pollingInterval = $pollingInterval ?? self::DEFAULT_POLLING_INTERVAL;
        $this->pollingTimeout = $pollingTimeout ?? self::DEFAULT_POLLING_TIMEOUT;
        $this->maxRetries = $maxRetries ?? self::DEFAULT_MAX_RETRIES;
        $this->httpClient = new HttpClient(['timeout' => 30, 'headers' => ['Content-Type' => 'application/json']]);
    }

    private function obtainToken(): array {
        $payload = ['username' => $this->email, 'password' => $this->password];
        if ($this->clientUid) $payload['client_uid'] = $this->clientUid;
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/token/', ['json' => $payload]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new FactPulseAuthException("Impossible d'obtenir le token JWT: " . $e->getMessage());
        }
    }

    public function ensureAuthenticated(bool $forceRefresh = false): void {
        $now = time() * 1000;
        if ($forceRefresh || !$this->accessToken || ($this->tokenExpiresAt && $now >= $this->tokenExpiresAt)) {
            $tokens = $this->obtainToken();
            $this->accessToken = $tokens['access'];
            $this->refreshToken = $tokens['refresh'];
            $this->tokenExpiresAt = $now + (28 * 60 * 1000);
        }
    }

    public function resetAuth(): void { $this->accessToken = $this->refreshToken = null; $this->tokenExpiresAt = null; }

    public function pollTask(string $taskId, ?int $timeout = null, ?int $interval = null): array {
        $timeoutMs = $timeout ?? $this->pollingTimeout;
        $intervalMs = $interval ?? $this->pollingInterval;
        $startTime = microtime(true) * 1000;
        $currentInterval = (float)$intervalMs;

        while (true) {
            $elapsed = (microtime(true) * 1000) - $startTime;
            if ($elapsed > $timeoutMs) throw new FactPulsePollingTimeoutException($taskId, $timeoutMs);

            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->get($this->apiUrl . "/api/facturation/v1/traitement/taches/{$taskId}/statut",
                    ['headers' => ['Authorization' => 'Bearer ' . $this->accessToken]]);
                $data = json_decode($response->getBody()->getContents(), true);
                $statut = $data['statut'] ?? '';

                if ($statut === 'SUCCESS') return $data['resultat'] ?? [];
                if ($statut === 'FAILURE') {
                    $errorMsg = $data['resultat']['message_erreur'] ?? 'Erreur inconnue';
                    $errors = [];
                    foreach (($data['resultat']['erreurs'] ?? []) as $err) {
                        if (is_array($err)) $errors[] = ValidationErrorDetail::fromArray($err);
                    }
                    throw new FactPulseValidationException("La tâche {$taskId} a échoué: {$errorMsg}", $errors);
                }
            } catch (GuzzleException $e) {
                if ($e->getCode() === 401) { $this->resetAuth(); continue; }
            }
            usleep((int)($currentInterval * 1000));
            $currentInterval = min($currentInterval * 1.5, 10000);
        }
    }

    public function genererFacturx($factureData, string $pdfPath, string $profil = 'EN16931',
        string $formatSortie = 'pdf', bool $sync = true, ?int $timeout = null): string {
        $jsonData = is_string($factureData) ? $factureData : json_encode($factureData);
        $taskId = null;

        for ($attempt = 0; $attempt <= $this->maxRetries; $attempt++) {
            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->post($this->apiUrl . '/api/facturation/v1/traitement/generer-facture', [
                    'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                    'multipart' => [
                        ['name' => 'donnees_facture', 'contents' => $jsonData],
                        ['name' => 'profil', 'contents' => $profil],
                        ['name' => 'format_sortie', 'contents' => $formatSortie],
                        ['name' => 'source_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                    ],
                ]);
                $data = json_decode($response->getBody()->getContents(), true);
                $taskId = $data['id_tache'] ?? null;
                break;
            } catch (GuzzleException $e) {
                if ($e->getCode() === 401 && $attempt < $this->maxRetries) { $this->resetAuth(); continue; }
                throw new FactPulseValidationException("Erreur API: " . $e->getMessage());
            }
        }

        if (!$taskId) throw new FactPulseValidationException("Pas d'ID de tâche dans la réponse");
        if (!$sync) return $taskId;

        $result = $this->pollTask($taskId, $timeout);
        if (isset($result['contenu_b64'])) return base64_decode($result['contenu_b64']);
        throw new FactPulseValidationException("Le résultat ne contient pas de contenu");
    }

    public static function formatMontant($montant): string {
        if ($montant === null) return '0.00';
        if (is_numeric($montant)) return number_format((float)$montant, 2, '.', '');
        return is_string($montant) ? $montant : '0.00';
    }
}
