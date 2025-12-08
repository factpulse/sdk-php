<?php
namespace FactPulse\SDK\Helpers;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\MultipartStream;

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

/** Credentials AFNOR PDP pour le mode Zero-Trust. L'API FactPulse utilise ces credentials pour s'authentifier auprès de la PDP AFNOR. */
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

/** Crée une ligne de poste (aligné sur LigneDePoste de models.py).
 * Pour le taux TVA: soit tauxTva (code) soit tauxTvaManuel (valeur) dans $options */
function ligneDePoste(int $numero, string $denomination, $quantite, $montantUnitaireHt, $montantTotalLigneHt,
    string $categorieTva = 'S', string $unite = 'FORFAIT', array $options = []): array {
    $result = ['numero' => $numero, 'denomination' => $denomination, 'quantite' => montant($quantite),
        'montantUnitaireHt' => montant($montantUnitaireHt), 'montantTotalLigneHt' => montant($montantTotalLigneHt),
        'categorieTva' => $categorieTva, 'unite' => $unite];
    // Soit tauxTva (code) soit tauxTvaManuel (valeur)
    if (isset($options['tauxTva'])) $result['tauxTva'] = $options['tauxTva'];
    else $result['tauxTvaManuel'] = montant($options['tauxTvaManuel'] ?? '20.00');
    if (isset($options['reference'])) $result['reference'] = $options['reference'];
    if (isset($options['montantRemiseHt'])) $result['montantRemiseHt'] = montant($options['montantRemiseHt']);
    if (isset($options['codeRaisonReduction'])) $result['codeRaisonReduction'] = $options['codeRaisonReduction'];
    if (isset($options['raisonReduction'])) $result['raisonReduction'] = $options['raisonReduction'];
    if (isset($options['dateDebutPeriode'])) $result['dateDebutPeriode'] = $options['dateDebutPeriode'];
    if (isset($options['dateFinPeriode'])) $result['dateFinPeriode'] = $options['dateFinPeriode'];
    return $result;
}

/** Crée une ligne de TVA (aligné sur LigneDeTVA de models.py).
 * Pour le taux: soit taux (code) soit tauxManuel (valeur) dans $options */
function ligneDeTva($montantBaseHt, $montantTva, string $categorie = 'S', array $options = []): array {
    $result = ['montantBaseHt' => montant($montantBaseHt), 'montantTva' => montant($montantTva), 'categorie' => $categorie];
    // Soit taux (code) soit tauxManuel (valeur)
    if (isset($options['taux'])) $result['taux'] = $options['taux'];
    else $result['tauxManuel'] = montant($options['tauxManuel'] ?? '20.00');
    return $result;
}

/** Crée une adresse postale pour l'API FactPulse. */
function adressePostale(string $ligne1, string $codePostal, string $ville, string $pays = 'FR', ?string $ligne2 = null, ?string $ligne3 = null): array {
    $result = ['ligneUn' => $ligne1, 'codePostal' => $codePostal, 'nomVille' => $ville, 'paysCodeIso' => $pays];
    if ($ligne2 !== null) $result['ligneDeux'] = $ligne2;
    if ($ligne3 !== null) $result['ligneTrois'] = $ligne3;
    return $result;
}

/** Crée une adresse électronique. schemeId: "0009"=SIREN, "0225"=SIRET */
function adresseElectronique(string $identifiant, string $schemeId = '0009'): array {
    return ['identifiant' => $identifiant, 'schemeId' => $schemeId];
}

/** Calcule le numéro TVA intracommunautaire français depuis un SIREN. */
function calculerTvaIntra(string $siren): ?string {
    if (strlen($siren) !== 9 || !ctype_digit($siren)) return null;
    $cle = (12 + 3 * ((int)$siren % 97)) % 97;
    return sprintf('FR%02d%s', $cle, $siren);
}

/** Crée un fournisseur (émetteur) avec auto-calcul SIREN, TVA intracommunautaire et adresses. */
function fournisseur(string $nom, string $siret, string $adresseLigne1, string $codePostal, string $ville, array $options = []): array {
    $siren = $options['siren'] ?? (strlen($siret) === 14 ? substr($siret, 0, 9) : null);
    $numeroTvaIntra = $options['numeroTvaIntra'] ?? ($siren ? calculerTvaIntra($siren) : null);
    $result = [
        'nom' => $nom, 'idFournisseur' => $options['idFournisseur'] ?? 0, 'siret' => $siret,
        'adresseElectronique' => adresseElectronique($siret, '0225'),
        'adressePostale' => adressePostale($adresseLigne1, $codePostal, $ville, $options['pays'] ?? 'FR', $options['adresseLigne2'] ?? null),
    ];
    if ($siren) $result['siren'] = $siren;
    if ($numeroTvaIntra) $result['numeroTvaIntra'] = $numeroTvaIntra;
    if (isset($options['iban'])) $result['iban'] = $options['iban'];
    if (isset($options['codeService'])) $result['idServiceFournisseur'] = $options['codeService'];
    if (isset($options['codeCoordonnesBancaires'])) $result['codeCoordonnesBancairesFournisseur'] = $options['codeCoordonnesBancaires'];
    return $result;
}

/** Crée un destinataire (client) avec auto-calcul SIREN et adresses. */
function destinataire(string $nom, string $siret, string $adresseLigne1, string $codePostal, string $ville, array $options = []): array {
    $siren = $options['siren'] ?? (strlen($siret) === 14 ? substr($siret, 0, 9) : null);
    $result = [
        'nom' => $nom, 'siret' => $siret,
        'adresseElectronique' => adresseElectronique($siret, '0225'),
        'adressePostale' => adressePostale($adresseLigne1, $codePostal, $ville, $options['pays'] ?? 'FR', $options['adresseLigne2'] ?? null),
    ];
    if ($siren) $result['siren'] = $siren;
    if (isset($options['codeServiceExecutant'])) $result['codeServiceExecutant'] = $options['codeServiceExecutant'];
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
                $response = $this->httpClient->get($this->apiUrl . "/api/v1/traitement/taches/{$taskId}/statut",
                    ['headers' => ['Authorization' => 'Bearer ' . $this->accessToken]]);
                $data = json_decode($response->getBody()->getContents(), true);
                if ($data['statut'] === 'SUCCESS') return $data['resultat'] ?? [];
                if ($data['statut'] === 'FAILURE') {
                    // Format AFNOR: errorMessage, details
                    $errors = array_map(fn($e) => ValidationErrorDetail::fromArray($e), $data['resultat']['details'] ?? []);
                    throw new FactPulseValidationException("Tâche {$taskId} échouée: " . ($data['resultat']['errorMessage'] ?? '?'), $errors);
                }
            } catch (GuzzleException $e) { if ($e->getCode() === 401) { $this->resetAuth(); continue; } throw $e; }
            usleep((int)($currentInterval * 1000)); $currentInterval = min($currentInterval * 1.5, 10000);
        }
    }

    public function genererFacturx($factureData, string $pdfPath, string $profil = 'EN16931', string $formatSortie = 'pdf', bool $sync = true, ?int $timeout = null): string {
        $jsonData = is_string($factureData) ? $factureData : json_encode($factureData);
        for ($attempt = 0; $attempt <= $this->maxRetries; $attempt++) {
            $this->ensureAuthenticated();
            try {
                $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/generer-facture', [
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

    // =========================================================================
    // AFNOR PDP - Authentication et helpers internes
    // =========================================================================

    /**
     * Récupère les credentials AFNOR (mode stored ou zero-trust).
     * Mode zero-trust: Retourne les afnorCredentials fournis au constructeur.
     * Mode stored: Récupère les credentials via GET /api/v1/afnor/credentials.
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
            throw new FactPulseAuthException("Échec récupération credentials AFNOR: " . $e->getMessage());
        }
    }

    /**
     * Obtient le token OAuth2 AFNOR et l'URL de la PDP.
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
                throw new FactPulseAuthException("Réponse OAuth2 AFNOR invalide");
            }
            return ['token' => $tokenData['access_token'], 'pdpBaseUrl' => $credentials->flowServiceUrl];
        } catch (GuzzleException $e) {
            throw new FactPulseAuthException("Échec OAuth2 AFNOR: " . $e->getMessage());
        }
    }

    /**
     * Effectue une requête vers l'API AFNOR avec gestion d'auth et d'erreurs.
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
            throw new FactPulseValidationException("Erreur AFNOR: " . $e->getMessage());
        }
    }

    // ==================== AFNOR Flow Service ====================

    /**
     * Soumet une facture à une PDP via l'API AFNOR.
     */
    public function soumettreFactureAfnor(string $pdfPath, string $flowName, array $options = []): array {
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
     * Recherche des flux de facturation AFNOR.
     */
    public function rechercherFluxAfnor(array $criteria = []): array {
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
     * Télécharge le fichier PDF d'un flux AFNOR.
     */
    public function telechargerFluxAfnor(string $flowId): string {
        $result = $this->makeAfnorRequest('GET', "/flow/v1/flows/{$flowId}");
        return $result['_raw'] ?? '';
    }

    /**
     * Vérifie la disponibilité du Flow Service AFNOR.
     */
    public function healthcheckAfnor(): array {
        return $this->makeAfnorRequest('GET', '/flow/v1/healthcheck');
    }

    // ==================== AFNOR Directory ====================

    /**
     * Recherche une entreprise par SIRET dans l'annuaire AFNOR.
     */
    public function rechercherSiretAfnor(string $siret): array {
        return $this->makeAfnorRequest('GET', "/directory/siret/{$siret}");
    }

    /**
     * Recherche une entreprise par SIREN dans l'annuaire AFNOR.
     */
    public function rechercherSirenAfnor(string $siren): array {
        return $this->makeAfnorRequest('GET', "/directory/siren/{$siren}");
    }

    /**
     * Liste les codes de routage disponibles pour un SIREN.
     */
    public function listerCodesRoutageAfnor(string $siren): array {
        return $this->makeAfnorRequest('GET', "/directory/siren/{$siren}/routing-codes");
    }

    // =========================================================================
    // Chorus Pro
    // =========================================================================

    /**
     * Effectue une requête vers l'API Chorus Pro.
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
     * Valide un PDF Factur-X.
     */
    public function validerPdfFacturx(string $pdfPath, string $profil = 'EN16931'): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/valider-pdf-facturx', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => [
                    ['name' => 'fichier_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                    ['name' => 'profil', 'contents' => $profil],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Erreur validation: " . $e->getMessage());
        }
    }

    /**
     * Valide un XML Factur-X.
     */
    public function validerXmlFacturx(string $xmlContent, string $profil = 'EN16931'): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/valider-xml', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => [
                    ['name' => 'fichier_xml', 'contents' => $xmlContent, 'filename' => 'facture.xml'],
                    ['name' => 'profil', 'contents' => $profil],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Erreur validation XML: " . $e->getMessage());
        }
    }

    /**
     * Valide la signature d'un PDF signé.
     */
    public function validerSignaturePdf(string $pdfPath): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/valider-signature-pdf', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => [
                    ['name' => 'fichier_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
                ],
            ]);
            return json_decode($response->getBody()->getContents(), true) ?? [];
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Erreur validation signature: " . $e->getMessage());
        }
    }

    // =========================================================================
    // Signature
    // =========================================================================

    /**
     * Signe un PDF avec le certificat configuré côté serveur.
     */
    public function signerPdf(string $pdfPath, array $options = []): string {
        $this->ensureAuthenticated();
        $multipart = [
            ['name' => 'fichier_pdf', 'contents' => fopen($pdfPath, 'r'), 'filename' => basename($pdfPath)],
        ];
        if (isset($options['raison'])) $multipart[] = ['name' => 'raison', 'contents' => $options['raison']];
        if (isset($options['localisation'])) $multipart[] = ['name' => 'localisation', 'contents' => $options['localisation']];
        if (isset($options['contact'])) $multipart[] = ['name' => 'contact', 'contents' => $options['contact']];
        $multipart[] = ['name' => 'use_pades_lt', 'contents' => ($options['usePadesLt'] ?? false) ? 'true' : 'false'];
        $multipart[] = ['name' => 'use_timestamp', 'contents' => ($options['useTimestamp'] ?? true) ? 'true' : 'false'];

        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/signer-pdf', [
                'headers' => ['Authorization' => 'Bearer ' . $this->accessToken],
                'multipart' => $multipart,
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if (!isset($result['pdf_signe_base64'])) {
                throw new FactPulseValidationException("Réponse de signature invalide");
            }
            return base64_decode($result['pdf_signe_base64']);
        } catch (GuzzleException $e) {
            throw new FactPulseValidationException("Erreur signature: " . $e->getMessage());
        }
    }

    /**
     * Génère un certificat de test (NON PRODUCTION).
     */
    public function genererCertificatTest(array $options = []): array {
        $this->ensureAuthenticated();
        try {
            $response = $this->httpClient->post($this->apiUrl . '/api/v1/traitement/generer-certificat-test', [
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
            throw new FactPulseValidationException("Erreur génération certificat: " . $e->getMessage());
        }
    }

    // =========================================================================
    // Workflow complet
    // =========================================================================

    /**
     * Génère un PDF Factur-X complet avec validation, signature et soumission optionnelles.
     */
    public function genererFacturxComplet(array $facture, string $pdfSourcePath, array $options = []): array {
        $profil = $options['profil'] ?? 'EN16931';
        $valider = $options['valider'] ?? true;
        $signer = $options['signer'] ?? false;
        $soumettreAfnor = $options['soumettreAfnor'] ?? false;
        $timeout = $options['timeout'] ?? 120000;

        $result = [];

        // 1. Génération
        $pdfBytes = $this->genererFacturx($facture, $pdfSourcePath, $profil, 'pdf', true, $timeout);
        $result['pdfBytes'] = $pdfBytes;

        // Créer un fichier temporaire pour les opérations suivantes
        $tempPath = tempnam(sys_get_temp_dir(), 'facturx_') . '.pdf';
        file_put_contents($tempPath, $pdfBytes);

        try {
            // 2. Validation
            if ($valider) {
                $validation = $this->validerPdfFacturx($tempPath, $profil);
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
            if ($signer) {
                $pdfBytes = $this->signerPdf($tempPath, $options);
                $result['pdfBytes'] = $pdfBytes;
                $result['signature'] = ['signe' => true];
                file_put_contents($tempPath, $pdfBytes);
            }

            // 4. Soumission AFNOR
            if ($soumettreAfnor) {
                $numeroFacture = $facture['numeroFacture'] ?? $facture['numero_facture'] ?? 'FACTURE';
                $flowName = $options['afnorFlowName'] ?? "Facture {$numeroFacture}";
                $trackingId = $options['afnorTrackingId'] ?? $numeroFacture;
                $afnorResult = $this->soumettreFactureAfnor($tempPath, $flowName, ['trackingId' => $trackingId]);
                $result['afnor'] = $afnorResult;
            }

            // Sauvegarde finale
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
