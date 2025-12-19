<?php
namespace FactPulse\SDK\Helpers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\MultipartStream;

// =============================================================================
// Credentials classes - for simplified configuration
// =============================================================================

/** Chorus Pro credentials for Zero-Trust mode. */
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

/** AFNOR PDP credentials for Zero-Trust mode. The FactPulse API uses these credentials to authenticate with the AFNOR PDP. */
class AFNORCredentials {
    public string $flowServiceUrl, $tokenUrl, $clientId, $clientSecret;
    public ?string $directoryServiceUrl;

    public function __construct(string $flowServiceUrl, string $tokenUrl, string $clientId, string $clientSecret, ?string $directoryServiceUrl = null) {
        $this->flowServiceUrl = $flowServiceUrl; $this->tokenUrl = $tokenUrl;
        $this->clientId = $clientId; $this->clientSecret = $clientSecret; $this->directoryServiceUrl = $directoryServiceUrl;
    }

    public function toArray(): array {
        $result = ['flow_service_url' => $this->flowServiceUrl, 'token_url' => $this->tokenUrl,
            'client_id' => $this->clientId, 'client_secret' => $this->clientSecret];
        if ($this->directoryServiceUrl !== null) $result['directory_service_url'] = $this->directoryServiceUrl;
        return $result;
    }
}

// =============================================================================
// Helpers for anyOf types - avoids verbosity of generated wrappers
// =============================================================================

function amount($value): string {
    if ($value === null) return '0.00';
    if (is_numeric($value)) return number_format((float)$value, 2, '.', '');
    return is_string($value) ? $value : '0.00';
}

function invoiceTotals($ht, $tva, $ttc, $aPayer, $remiseTtc = null, ?string $motifRemise = null, $acompte = null): array {
    $result = ['montantHtTotal' => amount($ht), 'montantTva' => amount($tva), 'montantTtcTotal' => amount($ttc), 'montantAPayer' => amount($aPayer)];
    if ($remiseTtc !== null) $result['montantRemiseGlobaleTtc'] = amount($remiseTtc);
    if ($motifRemise !== null) $result['motifRemiseGlobaleTtc'] = $motifRemise;
    if ($acompte !== null) $result['acompte'] = amount($acompte);
    return $result;
}

/** Creates an invoice line (aligned with LigneDePoste from models.py).
 * For VAT rate: either tauxTva (code) or tauxTvaManuel (value) in $options */
function invoiceLine(int $numero, string $denomination, $quantite, $montantUnitaireHt, $montantTotalLigneHt,
    string $categorieTva = 'S', string $unite = 'FORFAIT', array $options = []): array {
    $result = ['numero' => $numero, 'denomination' => $denomination, 'quantite' => amount($quantite),
        'montantUnitaireHt' => amount($montantUnitaireHt), 'montantTotalLigneHt' => amount($montantTotalLigneHt),
        'categorieTva' => $categorieTva, 'unite' => $unite];
    // Either tauxTva (code) or tauxTvaManuel (value)
    if (isset($options['tauxTva'])) $result['tauxTva'] = $options['tauxTva'];
    else $result['tauxTvaManuel'] = amount($options['tauxTvaManuel'] ?? '20.00');
    if (isset($options['reference'])) $result['reference'] = $options['reference'];
    if (isset($options['montantRemiseHt'])) $result['montantRemiseHt'] = amount($options['montantRemiseHt']);
    if (isset($options['codeRaisonReduction'])) $result['codeRaisonReduction'] = $options['codeRaisonReduction'];
    if (isset($options['raisonReduction'])) $result['raisonReduction'] = $options['raisonReduction'];
    if (isset($options['dateDebutPeriode'])) $result['dateDebutPeriode'] = $options['dateDebutPeriode'];
    if (isset($options['dateFinPeriode'])) $result['dateFinPeriode'] = $options['dateFinPeriode'];
    return $result;
}

/** Creates a VAT line (aligned with LigneDeTVA from models.py).
 * For rate: either taux (code) or tauxManuel (value) in $options */
function vatLine($montantBaseHt, $montantTva, string $categorie = 'S', array $options = []): array {
    $result = ['montantBaseHt' => amount($montantBaseHt), 'montantTva' => amount($montantTva), 'categorie' => $categorie];
    // Either taux (code) or tauxManuel (value)
    if (isset($options['taux'])) $result['taux'] = $options['taux'];
    else $result['tauxManuel'] = amount($options['tauxManuel'] ?? '20.00');
    return $result;
}

/** Creates a postal address for the FactPulse API. */
function postalAddress(string $ligne1, string $codePostal, string $ville, string $pays = 'FR', ?string $ligne2 = null, ?string $ligne3 = null): array {
    $result = ['ligneUn' => $ligne1, 'codePostal' => $codePostal, 'nomVille' => $ville, 'paysCodeIso' => $pays];
    if ($ligne2 !== null) $result['ligneDeux'] = $ligne2;
    if ($ligne3 !== null) $result['ligneTrois'] = $ligne3;
    return $result;
}

/** Creates an electronic address. schemeId: "0009"=SIREN, "0225"=SIRET */
function electronicAddress(string $identifiant, string $schemeId = '0009'): array {
    return ['identifiant' => $identifiant, 'schemeId' => $schemeId];
}

/** Computes the French intra-EU VAT number from a SIREN. */
function computeVatNumber(string $siren): ?string {
    if (strlen($siren) !== 9 || !ctype_digit($siren)) return null;
    $cle = (12 + 3 * ((int)$siren % 97)) % 97;
    return sprintf('FR%02d%s', $cle, $siren);
}

/** Creates a supplier (sender) with auto-computed SIREN, intra-EU VAT and addresses. */
function supplier(string $nom, string $siret, string $adresseLigne1, string $codePostal, string $ville, array $options = []): array {
    $siren = $options['siren'] ?? (strlen($siret) === 14 ? substr($siret, 0, 9) : null);
    $numeroTvaIntra = $options['numeroTvaIntra'] ?? ($siren ? computeVatNumber($siren) : null);
    $result = [
        'nom' => $nom, 'idFournisseur' => $options['idFournisseur'] ?? 0, 'siret' => $siret,
        'adresseElectronique' => electronicAddress($siret, '0225'),
        'adressePostale' => postalAddress($adresseLigne1, $codePostal, $ville, $options['pays'] ?? 'FR', $options['adresseLigne2'] ?? null),
    ];
    if ($siren) $result['siren'] = $siren;
    if ($numeroTvaIntra) $result['numeroTvaIntra'] = $numeroTvaIntra;
    if (isset($options['iban'])) $result['iban'] = $options['iban'];
    if (isset($options['codeService'])) $result['idServiceFournisseur'] = $options['codeService'];
    if (isset($options['codeCoordonnesBancaires'])) $result['codeCoordonnesBancairesFournisseur'] = $options['codeCoordonnesBancaires'];
    return $result;
}

/** Creates a recipient (customer) with auto-computed SIREN and addresses. */
function recipient(string $nom, string $siret, string $adresseLigne1, string $codePostal, string $ville, array $options = []): array {
    $siren = $options['siren'] ?? (strlen($siret) === 14 ? substr($siret, 0, 9) : null);
    $result = [
        'nom' => $nom, 'siret' => $siret,
        'adresseElectronique' => electronicAddress($siret, '0225'),
        'adressePostale' => postalAddress($adresseLigne1, $codePostal, $ville, $options['pays'] ?? 'FR', $options['adresseLigne2'] ?? null),
    ];
    if ($siren) $result['siren'] = $siren;
    if (isset($options['codeServiceExecutant'])) $result['codeServiceExecutant'] = $options['codeServiceExecutant'];
    return $result;
}

/**
 * Creates a payee (factor) for factoring.
 *
 * The payee (BG-10 / PayeeTradeParty) is used when payment must be made
 * to a third party different from the supplier, typically a factor
 * (factoring company).
 *
 * For factored invoices, you must also:
 * - Use a factored document type (393, 396, 501, 502, 472, 473)
 * - Add an ACC note with the subrogation mention
 * - The payee's IBAN will be used for payment
 *
 * @param string $nom Factor's company name (BT-59)
 * @param array $options Options: siret (BT-60), siren (BT-61), iban, bic
 * @return array Dict ready to use in a factored invoice
 *
 * @example
 * $factor = payee('FACTOR SAS', [
 *     'siret' => '30000000700033',
 *     'iban' => 'FR76 3000 4000 0500 0012 3456 789',
 * ]);
 */
function payee(string $nom, array $options = []): array {
    // Auto-compute SIREN from SIRET
    $siret = $options['siret'] ?? null;
    $siren = $options['siren'] ?? ($siret && strlen($siret) === 14 ? substr($siret, 0, 9) : null);

    $result = ['nom' => $nom];
    if ($siret) $result['siret'] = $siret;
    if ($siren) $result['siren'] = $siren;
    if (isset($options['iban'])) $result['iban'] = $options['iban'];
    if (isset($options['bic'])) $result['bic'] = $options['bic'];
    return $result;
}

// =============================================================================
// Main client
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
    // Alias plus courts
    public function getChorusProCredentials(): ?array { return $this->getChorusCredentialsForApi(); }
    public function getAfnorCredentials(): ?array { return $this->getAfnorCredentialsForApi(); }

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
                $response = $this->httpClient->get($this->apiUrl . "/api/v1/processing/tasks/{$taskId}/status",
                    ['headers' => ['Authorization' => 'Bearer ' . $this->accessToken]]);
                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['statut'] === 'SUCCESS') return $data['resultat'] ?? [];
                if ($data['statut'] === 'FAILURE') {
                    // Format AFNOR: errorMessage, details
                    $errors = array_map(fn($e) => ValidationErrorDetail::fromArray($e), $data['resultat']['details'] ?? []);
                    throw new FactPulseValidationException("Task {$taskId} failed: " . ($data['resultat']['errorMessage'] ?? '?'), $errors);
                }
            } catch (GuzzleException $e) { if ($e->getCode() === 401) { $this->resetAuth(); continue; } throw $e; }
            usleep((int)($currentInterval * 1000)); $currentInterval = min($currentInterval * 1.5, 10000);
        }
    }

    public function generateFacturx($factureData, string $pdfPath, string $profil = 'EN16931', string $formatSortie = 'pdf', bool $sync = true, ?int $timeout = null): string {
        $jsonData = is_string($factureData) ? $factureData : json_encode($factureData);
        for ($attempt = 0; $attempt <= $this->maxRetries; $attempt++) {
            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/generate-invoice', [
                    'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                    'multipart' => [
                        ['name' => 'invoice_data', 'contents' => $jsonData],
                        ['name' => 'profile', 'contents' => $profil], ['name' => 'output_format', 'contents' => $formatSortie],
                        ['name' => 'source_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                    ],
                ]);
                $taskId = json_decode($response->getBody()->getContents(), true)['task_id'] ?? null;
                if (!$taskId) throw new FactPulseValidationException("No task ID");
                if (!$sync) return $taskId;
                $result = $this->pollTask($taskId, $timeout);
                return isset($result['contenu_b64']) ? base64_decode($result['contenu_b64']) : throw new FactPulseValidationException("No content");
            } catch (GuzzleException $e) {
                if ($e->getCode() === 401 && $attempt < $this->maxRetries) { $this->resetAuth(); continue; }

                // Extract error details from response body
                $errorMsg = "API error ({$e->getCode()}): " . $e->getMessage();
                $errors = [];
                $responseBody = null;

                if ($e->hasResponse()) {
                    $responseBody = json_decode($e->getResponse()->getBody()->getContents(), true);
                    if ($responseBody) {
                        // FastAPI/Pydantic format: {"detail": [{"loc": [...], "msg": "...", "type": "..."}]}
                        if (isset($responseBody['detail']) && is_array($responseBody['detail'])) {
                            $errorMsg = 'Validation error';
                            foreach ($responseBody['detail'] as $err) {
                                if (is_array($err)) {
                                    $loc = $err['loc'] ?? [];
                                    $errors[] = new ValidationErrorDetail(
                                        'ERROR',
                                        implode(' -> ', array_map('strval', $loc)),
                                        $err['msg'] ?? json_encode($err),
                                        'validation',
                                        $err['type'] ?? null
                                    );
                                }
                            }
                        } elseif (isset($responseBody['detail']) && is_string($responseBody['detail'])) {
                            $errorMsg = $responseBody['detail'];
                        } elseif (isset($responseBody['errorMessage'])) {
                            $errorMsg = $responseBody['errorMessage'];
                        }
                    }
                }

                error_log("API error {$e->getCode()}: " . json_encode($responseBody));
                throw new FactPulseValidationException($errorMsg, $errors);
            }
        }
        throw new FactPulseValidationException("Failed after retries");
    }

    public static function formatAmount($m): string {
        return $m === null ? '0.00' : (is_numeric($m) ? number_format((float)$m, 2, '.', '') : (is_string($m) ? $m : '0.00'));
    }

    // =========================================================================
    // AFNOR PDP - Authentication and internal helpers
    // =========================================================================

    /**
     * Retrieves AFNOR credentials (stored or zero-trust mode).
     * Zero-trust mode: Returns the afnorCredentials provided to the constructor.
     * Stored mode: Retrieves credentials via GET /api/v1/afnor/credentials.
     */
    private function getAfnorCredentialsInternal(): AFNORCredentials {
        if ($this->afnorCredentials) {
            return $this->afnorCredentials;
        }

        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->get($this->apiUrl . '/api/v1/afnor/credentials', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
            ]);
            $creds = json_decode($response->getBody()->getContents(), true);
            return new AFNORCredentials(
                $creds['flow_service_url'],
                $creds['token_url'],
                $creds['client_id'],
                $creds['client_secret'],
                $creds['directory_service_url'] ?? null
            );
        } catch (GuzzleException $e) {
            throw new FactPulseAuthException("Failed to retrieve AFNOR credentials: " . $e->getMessage());
        }
    }

    /**
     * Obtains the AFNOR OAuth2 token and the PDP URL.
     */
    private function getAfnorTokenAndUrl(): array {
        $credentials = $this->getAfnorCredentialsInternal();

        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/afnor/oauth/token', [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $credentials->clientId,
                    'client_secret' => $credentials->clientSecret,
                ],
                'headers' => ['X-PDP-Token-URL' => $credentials->tokenUrl],
            ]);
            $tokenData = json_decode($response->getBody()->getContents(), true);
            if (!isset($tokenData['access_token'])) {
                throw new FactPulseAuthException("Invalid AFNOR OAuth2 response");
            }
            return ['token' => $tokenData['access_token'], 'pdpBaseUrl' => $credentials->flowServiceUrl];
        } catch (GuzzleException $e) {
            throw new FactPulseAuthException("AFNOR OAuth2 failed: " . $e->getMessage());
        }
    }

    /**
     * Performs a request to the AFNOR API with auth and error handling.
     */
    private function makeAfnorRequest(string $method, string $endpoint, ?array $jsonData = null, ?array $multipart = null, ?array $params = null): array {
        ['token' => $afnorToken, 'pdpBaseUrl' => $pdpBaseUrl] = $this->getAfnorTokenAndUrl();
        $url = $this->apiUrl . '/api/v1/afnor' . $endpoint;
        $headers = ['Authorization' => 'Bearer ' . $afnorToken, 'X-PDP-Base-URL' => $pdpBaseUrl];

        try {
            $options = ['headers' => $headers];
            if ($params) $options['query'] = $params;
            if ($multipart) $options['multipart'] = $multipart;
            elseif ($jsonData !== null) $options['json'] = $jsonData;

            $response = $this->httpClient->request($method, $url, $options);
            $contentType = $response->getHeaderLine('Content-Type');
            $body = $response->getBody()->getContents();

            if (str_contains($contentType, 'application/json')) {
                return json_decode($body, true) ?? [];
            }
            return ['_raw' => $body];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("AFNOR error: " . $e->getMessage());
        }
    }

    // ==================== AFNOR Flow Service ====================

    /**
     * Submits an invoice to a PDP via the AFNOR API.
     */
    public function submitInvoiceAfnor(string $pdfPath, string $flowName, array $options = []): array {
        $pdfContent = file_get_contents($pdfPath);
        $sha256 = hash('sha256', $pdfContent);

        $flowInfo = [
            'name' => $flowName,
            'flowSyntax' => $options['flowSyntax'] ?? 'CII',
            'flowProfile' => $options['flowProfile'] ?? 'EN16931',
            'sha256' => $sha256,
        ];
        if (isset($options['trackingId'])) $flowInfo['trackingId'] = $options['trackingId'];

        return $this->makeAfnorRequest('POST', '/flow/v1/flows', null, [
            ['name' => 'file', 'contents' => $pdfContent, 'filename' => basename($pdfPath)],
            ['name' => 'flowInfo', 'contents' => json_encode($flowInfo), 'headers' => ['Content-Type' => 'application/json']],
        ]);
    }

    /**
     * Searches AFNOR invoice flows.
     */
    public function searchFlowsAfnor(array $criteria = []): array {
        $searchBody = [
            'offset' => $criteria['offset'] ?? 0,
            'limit' => $criteria['limit'] ?? 25,
            'where' => [],
        ];
        if (isset($criteria['trackingId'])) $searchBody['where']['trackingId'] = $criteria['trackingId'];
        if (isset($criteria['status'])) $searchBody['where']['status'] = $criteria['status'];

        return $this->makeAfnorRequest('POST', '/flow/v1/flows/search', $searchBody);
    }

    /**
     * Downloads the PDF file of an AFNOR flow.
     */
    public function downloadFlowAfnor(string $flowId): string {
        $result = $this->makeAfnorRequest('GET', "/flow/v1/flows/{$flowId}");
        return $result['_raw'] ?? '';
    }

    /**
     * Checks AFNOR Flow Service availability.
     */
    public function healthcheckAfnor(): array {
        return $this->makeAfnorRequest('GET', '/flow/v1/healthcheck');
    }

    // ==================== AFNOR Directory ====================

    /**
     * Searches a company by SIRET in the AFNOR directory.
     */
    public function searchSiretAfnor(string $siret): array {
        return $this->makeAfnorRequest('GET', "/directory/siret/{$siret}");
    }

    /**
     * Searches a company by SIREN in the AFNOR directory.
     */
    public function searchSirenAfnor(string $siren): array {
        return $this->makeAfnorRequest('GET', "/directory/siren/{$siren}");
    }

    /**
     * Lists available routing codes for a SIREN.
     */
    public function listRoutingCodesAfnor(string $siren): array {
        return $this->makeAfnorRequest('GET', "/directory/siren/{$siren}/routing-codes");
    }

    // =========================================================================
    // Chorus Pro
    // =========================================================================

    /**
     * Performs a request to the Chorus Pro API.
     */
    private function makeChorusRequest(string $method, string $endpoint, ?array $jsonData = null): array {
        $this->ensureAuthenticated();
        $url = $this->apiUrl . '/api/v1/chorus-pro' . $endpoint;

        $body = $jsonData ?? [];
        if ($this->chorusCredentials) {
            $body['credentials'] = $this->chorusCredentials->toArray();
        }

        try {
            $response = $this->httpClient->request($method, $url, [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'json' => $body,
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Erreur Chorus Pro: " . $e->getMessage());
        }
    }

    /**
     * Recherche des structures sur Chorus Pro.
     */
    public function rechercherStructureChorus(?string $identifiantStructure = null, ?string $raisonSociale = null, string $typeIdentifiant = 'SIRET', bool $restreindrePrivees = true): array {
        $body = ['restreindre_structures_privees' => $restreindrePrivees];
        if ($identifiantStructure) $body['identifiant_structure'] = $identifiantStructure;
        if ($raisonSociale) $body['raison_sociale_structure'] = $raisonSociale;
        if ($typeIdentifiant) $body['type_identifiant_structure'] = $typeIdentifiant;

        return $this->makeChorusRequest('POST', '/structures/rechercher', $body);
    }

    /**
     * Consulte les détails d'une structure Chorus Pro.
     */
    public function consulterStructureChorus(int $idStructureCpp): array {
        return $this->makeChorusRequest('POST', '/structures/consulter', ['id_structure_cpp' => $idStructureCpp]);
    }

    /**
     * Obtient l'ID Chorus Pro d'une structure depuis son SIRET.
     */
    public function obtenirIdChorusDepuisSiret(string $siret, string $typeIdentifiant = 'SIRET'): array {
        return $this->makeChorusRequest('POST', '/structures/obtenir-id-depuis-siret', [
            'siret' => $siret, 'type_identifiant' => $typeIdentifiant,
        ]);
    }

    /**
     * Liste les services d'une structure Chorus Pro.
     */
    public function listerServicesStructureChorus(int $idStructureCpp): array {
        return $this->makeChorusRequest('GET', "/structures/{$idStructureCpp}/services");
    }

    /**
     * Soumet une facture à Chorus Pro.
     */
    public function soumettreFactureChorus(array $factureData): array {
        return $this->makeChorusRequest('POST', '/factures/soumettre', $factureData);
    }

    /**
     * Consulte le statut d'une facture Chorus Pro.
     */
    public function consulterFactureChorus(int $identifiantFactureCpp): array {
        return $this->makeChorusRequest('POST', '/factures/consulter', ['identifiant_facture_cpp' => $identifiantFactureCpp]);
    }

    // =========================================================================
    // Validation
    // =========================================================================

    /**
     * Validates a Factur-X PDF.
     * @param string $pdfPath Path to the PDF file
     * @param string|null $profil Factur-X profile (MINIMUM, BASIC, EN16931, EXTENDED). If null, auto-detected.
     * @param bool $useVerapdf Enables strict PDF/A validation with VeraPDF (default: false)
     */
    public function validateFacturxPdf(string $pdfPath, ?string $profil = null, bool $useVerapdf = false): array {
        $this->ensureAuthenticated();
        try {
            $multipart = [
                ['name' => 'pdf_file', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                ['name' => 'use_verapdf', 'contents' => $useVerapdf ? 'true' : 'false'],
            ];
            if ($profil !== null) {
                $multipart[] = ['name' => 'profile', 'contents' => $profil];
            }
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/validate-facturx-pdf', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => $multipart,
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Validation error: " . $e->getMessage());
        }
    }

    /**
     * Validates a Factur-X XML.
     */
    public function validateFacturxXml(string $xmlContent, string $profil = 'EN16931'): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/validate-xml', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => [
                    ['name' => 'xml_file', 'contents' => $xmlContent, 'filename' => 'facture.xml'],
                    ['name' => 'profile', 'contents' => $profil],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("XML validation error: " . $e->getMessage());
        }
    }

    /**
     * Validates the signature of a signed PDF.
     */
    public function validatePdfSignature(string $pdfPath): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/validate-pdf-signature', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => [
                    ['name' => 'pdf_file', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Signature validation error: " . $e->getMessage());
        }
    }

    // =========================================================================
    // Signature
    // =========================================================================

    /**
     * Signs a PDF with the server-side configured certificate.
     */
    public function signPdf(string $pdfPath, array $options = []): string {
        $this->ensureAuthenticated();
        $multipart = [
            ['name' => 'pdf_file', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
        ];
        if (isset($options['reason'])) $multipart[] = ['name' => 'reason', 'contents' => $options['reason']];
        if (isset($options['location'])) $multipart[] = ['name' => 'location', 'contents' => $options['location']];
        if (isset($options['contact'])) $multipart[] = ['name' => 'contact', 'contents' => $options['contact']];
        $multipart[] = ['name' => 'use_pades_lt', 'contents' => ($options['usePadesLt'] ?? false) ? 'true' : 'false'];
        $multipart[] = ['name' => 'use_timestamp', 'contents' => ($options['useTimestamp'] ?? true) ? 'true' : 'false'];

        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/sign-pdf', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => $multipart,
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if (!isset($result['pdf_signe_base64'])) {
                throw new FactPulseValidationException("Invalid signature response");
            }
            return base64_decode($result['pdf_signe_base64']);
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Signature error: " . $e->getMessage());
        }
    }

    /**
     * Generates a test certificate (NOT FOR PRODUCTION).
     */
    public function generateTestCertificate(array $options = []): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/processing/generate-test-certificate', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'json' => [
                    'cn' => $options['cn'] ?? 'Test Organisation',
                    'organisation' => $options['organisation'] ?? 'Test Organisation',
                    'email' => $options['email'] ?? 'test@example.com',
                    'duree_jours' => $options['dureeJours'] ?? 365,
                    'taille_cle' => $options['tailleCle'] ?? 2048,
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Certificate generation error: " . $e->getMessage());
        }
    }

    // =========================================================================
    // Complete workflow
    // =========================================================================

    /**
     * Generates a complete Factur-X PDF with optional validation, signing and submission.
     */
    public function generateCompleteFacturx(array $facture, string $pdfSourcePath, array $options = []): array {
        $profil = $options['profil'] ?? 'EN16931';
        $validate = $options['validate'] ?? true;
        $sign = $options['sign'] ?? false;
        $submitAfnor = $options['submitAfnor'] ?? false;
        $timeout = $options['timeout'] ?? 120000;

        $result = [];

        // 1. Generation
        $pdfBytes = $this->generateFacturx($facture, $pdfSourcePath, $profil, 'pdf', true, $timeout);
        $result['pdfBytes'] = $pdfBytes;

        // Create a temporary file for subsequent operations
        $tempPath = tempnam(sys_get_temp_dir(), 'facturx_') . '.pdf';
        file_put_contents($tempPath, $pdfBytes);

        try {
            // 2. Validation
            if ($validate) {
                $validation = $this->validateFacturxPdf($tempPath, $profil);
                $result['validation'] = $validation;
                if (!($validation['est_conforme'] ?? false)) {
                    if (isset($options['outputPath'])) {
                        file_put_contents($options['outputPath'], $pdfBytes);
                        $result['pdfPath'] = $options['outputPath'];
                    }
                    return $result;
                }
            }

            // 3. Signature
            if ($sign) {
                $pdfBytes = $this->signPdf($tempPath, $options);
                $result['pdfBytes'] = $pdfBytes;
                $result['signature'] = ['signed' => true];
                file_put_contents($tempPath, $pdfBytes);
            }

            // 4. AFNOR submission
            if ($submitAfnor) {
                $invoiceNumber = $facture['numeroFacture'] ?? $facture['numero_facture'] ?? 'INVOICE';
                $flowName = $options['afnorFlowName'] ?? "Invoice {$invoiceNumber}";
                $trackingId = $options['afnorTrackingId'] ?? $invoiceNumber;
                $afnorResult = $this->submitInvoiceAfnor($tempPath, $flowName, ['trackingId' => $trackingId]);
                $result['afnor'] = $afnorResult;
            }

            // Final save
            if (isset($options['outputPath'])) {
                file_put_contents($options['outputPath'], $pdfBytes);
                $result['pdfPath'] = $options['outputPath'];
            }
        } finally {
            @unlink($tempPath);
        }

        return $result;
    }
}
