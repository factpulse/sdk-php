<?php
namespace FactPulse\SDK\Helpers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

// =============================================================================
// Credentials classes - pour une configuration simplifiée
// =============================================================================

/** Credentials Chorus Pro pour le mode Zero-Trust. */
class ChorusProCredentials {
    public string $pisteClientId;
    public string $pisteClientSecret;
    public string $chorusProLogin;
    public string $chorusProPassword;
    public bool $sandbox;

    public function __construct(string $pisteClientId, string $pisteClientSecret, string $chorusProLogin, string $chorusProPassword, bool $sandbox = true) {
        $this->pisteClientId = $pisteClientId; $this->pisteClientSecret = $pisteClientSecret;
        $this->chorusProLogin = $chorusProLogin; $this->chorusProPassword = $chorusProPassword; $this->sandbox = $sandbox;
    }

    public function toArray(): array {
        return ['piste_client_id' => $this->pisteClientId, 'piste_client_secret' => $this->pisteClientSecret,
            'chorus_pro_login' => $this->chorusProLogin, 'chorus_pro_password' => $this->chorusProPassword, 'sandbox' => $this->sandbox];
    }
}

/** Credentials AFNOR PDP pour le mode Zero-Trust. */
class AFNORCredentials {
    public string $clientId, $clientSecret, $flowServiceUrl;

    public function __construct(string $clientId, string $clientSecret, string $flowServiceUrl) {
        $this->clientId = $clientId; $this->clientSecret = $clientSecret; $this->flowServiceUrl = $flowServiceUrl;
    }

    public function toArray(): array {
        return ['client_id' => $this->clientId, 'client_secret' => $this->clientSecret, 'flow_service_url' => $this->flowServiceUrl];
    }
}

// =============================================================================
// Helpers pour les types anyOf - évite la verbosité des wrappers générés
// =============================================================================

function montant($value): string {
    if ($value === null) return '0.00';
    if (is_numeric($value)) return number_format((float)$value, 2, '.', '');
    return is_string($value) ? $value : '0.00';
}

function montantTotal($ht, $tva, $ttc, $aPayer, $remiseTtc = null, ?string $motifRemise = null, $acompte = null): array {
    $result = ['montantHtTotal' => montant($ht), 'montantTva' => montant($tva), 'montantTtcTotal' => montant($ttc), 'montantAPayer' => montant($aPayer)];
    if ($remiseTtc !== null) $result['montantRemiseGlobaleTtc'] = montant($remiseTtc);
    if ($motifRemise !== null) $result['motifRemiseGlobaleTtc'] = $motifRemise;
    if ($acompte !== null) $result['acompte'] = montant($acompte);
    return $result;
}

function ligneDePoste(int $numero, string $denomination, $quantite, $montantUnitaireHt, $montantLigneHt,
    $tauxTva = '20.00', string $unite = 'C62', array $options = []): array {
    $result = ['numero' => $numero, 'denomination' => $denomination, 'quantite' => montant($quantite),
        'montantUnitaireHt' => montant($montantUnitaireHt), 'montantTotalLigneHt' => montant($montantLigneHt),
        'tauxTva' => montant($tauxTva), 'unite' => $unite];
    if (isset($options['montantTvaLigne'])) $result['montantTvaLigne'] = montant($options['montantTvaLigne']);
    if (isset($options['montantRemiseHt'])) $result['montantRemiseHt'] = montant($options['montantRemiseHt']);
    if (isset($options['codeRaisonRemise'])) $result['codeRaisonReduction'] = $options['codeRaisonRemise'];
    if (isset($options['motifRemise'])) $result['motifRemise'] = $options['motifRemise'];
    if (isset($options['description'])) $result['description'] = $options['description'];
    return $result;
}

function ligneDeTva($taux, $baseHt, $montantTva, string $categorie = 'S', ?string $motifExoneration = null): array {
    $result = ['tauxTva' => montant($taux), 'montantBaseHt' => montant($baseHt), 'montantTva' => montant($montantTva), 'categorieTva' => $categorie];
    if ($motifExoneration !== null) $result['motifExoneration'] = $motifExoneration;
    return $result;
}

// =============================================================================
// Client principal
// =============================================================================

class FactPulseClient {
    private const DEFAULT_API_URL = 'https://factpulse.fr';
    private string $email, $password, $apiUrl;
    private ?string $clientUid;
    private ?ChorusProCredentials $chorusCredentials;
    private ?AFNORCredentials $afnorCredentials;
    private int $pollingInterval, $pollingTimeout, $maxRetries;
    private HttpClient $httpClient;
    private ?string $accessToken = null, $refreshToken = null;
    private ?int $tokenExpiresAt = null;

    public function __construct(string $email, string $password, ?string $apiUrl = null, ?string $clientUid = null,
        ?ChorusProCredentials $chorusCredentials = null, ?AFNORCredentials $afnorCredentials = null,
        ?int $pollingInterval = null, ?int $pollingTimeout = null, ?int $maxRetries = null) {
        $this->email = $email; $this->password = $password;
        $this->apiUrl = rtrim($apiUrl ?? self::DEFAULT_API_URL, '/');
        $this->clientUid = $clientUid;
        $this->chorusCredentials = $chorusCredentials;
        $this->afnorCredentials = $afnorCredentials;
        $this->pollingInterval = $pollingInterval ?? 2000;
        $this->pollingTimeout = $pollingTimeout ?? 120000; $this->maxRetries = $maxRetries ?? 1;
        $this->httpClient = new HttpClient(['timeout' => 30]);
    }

    public function getChorusCredentialsForApi(): ?array { return $this->chorusCredentials?->toArray(); }
    public function getAfnorCredentialsForApi(): ?array { return $this->afnorCredentials?->toArray(); }

    public function ensureAuthenticated(bool $forceRefresh = false): void {
        $now = time() * 1000;
        if ($forceRefresh || !$this->accessToken || ($this->tokenExpiresAt && $now >= $this->tokenExpiresAt)) {
            $payload = ['username' => $this->email, 'password' => $this->password];
            if ($this->clientUid) $payload['client_uid'] = $this->clientUid;
            try {
                $response = $this->httpClient->post($this->apiUrl . '/api/token/', ['json' => $payload]);
                $tokens = json_decode($response->getBody()->getContents(), true);
                $this->accessToken = $tokens['access']; $this->refreshToken = $tokens['refresh'];
                $this->tokenExpiresAt = $now + (28 * 60 * 1000);
            } catch (GuzzleException $e) { throw new FactPulseAuthException("Auth failed: " . $e->getMessage()); }
        }
    }

    public function resetAuth(): void { $this->accessToken = $this->refreshToken = null; $this->tokenExpiresAt = null; }

    public function pollTask(string $taskId, ?int $timeout = null, ?int $interval = null): array {
        $timeoutMs = $timeout ?? $this->pollingTimeout; $intervalMs = $interval ?? $this->pollingInterval;
        $startTime = microtime(true) * 1000; $currentInterval = (float)$intervalMs;
        while (true) {
            if ((microtime(true) * 1000) - $startTime > $timeoutMs) throw new FactPulsePollingTimeoutException($taskId, $timeoutMs);
            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->get($this->apiUrl . "/api/facturation/v1/traitement/taches/{$taskId}/statut",
                    ['headers' => ['Authorization' => 'Bearer ' . $this->accessToken]]);
                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['statut'] === 'SUCCESS') return $data['resultat'] ?? [];
                if ($data['statut'] === 'FAILURE') {
                    $errors = array_map(fn($e) => ValidationErrorDetail::fromArray($e), $data['resultat']['erreurs'] ?? []);
                    throw new FactPulseValidationException("Tâche {$taskId} échouée: " . ($data['resultat']['message_erreur'] ?? '?'), $errors);
                }
            } catch (GuzzleException $e) { if ($e->getCode() === 401) { $this->resetAuth(); continue; } }
            usleep((int)($currentInterval * 1000)); $currentInterval = min($currentInterval * 1.5, 10000);
        }
    }

    public function genererFacturx($factureData, string $pdfPath, string $profil = 'EN16931', string $formatSortie = 'pdf', bool $sync = true, ?int $timeout = null): string {
        $jsonData = is_string($factureData) ? $factureData : json_encode($factureData);
        for ($attempt = 0; $attempt <= $this->maxRetries; $attempt++) {
            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->post($this->apiUrl . '/api/facturation/v1/traitement/generer-facture', [
                    'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                    'multipart' => [
                        ['name' => 'donnees_facture', 'contents' => $jsonData],
                        ['name' => 'profil', 'contents' => $profil], ['name' => 'format_sortie', 'contents' => $formatSortie],
                        ['name' => 'source_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                    ],
                ]);
                $taskId = json_decode($response->getBody()->getContents(), true)['id_tache'] ?? null;
                if (!$taskId) throw new FactPulseValidationException("Pas d'ID de tâche");
                if (!$sync) return $taskId;
                $result = $this->pollTask($taskId, $timeout);
                return isset($result['contenu_b64']) ? base64_decode($result['contenu_b64']) : throw new FactPulseValidationException("Pas de contenu");
            } catch (GuzzleException $e) {
                if ($e->getCode() === 401 && $attempt < $this->maxRetries) { $this->resetAuth(); continue; }
                throw new FactPulseValidationException("Erreur API: " . $e->getMessage());
            }
        }
        throw new FactPulseValidationException("Échec après retries");
    }

    public static function formatMontant($m): string {
        return $m === null ? '0.00' : (is_numeric($m) ? number_format((float)$m, 2, '.', '') : (is_string($m) ? $m : '0.00'));
    }
}
