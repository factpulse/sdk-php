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
}
