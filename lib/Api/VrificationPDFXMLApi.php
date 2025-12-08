<?php
/**
 * VrificationPDFXMLApi
 * PHP version 8.1
 *
 * @category Class
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * API REST FactPulse
 *
 * API REST pour la facturation électronique en France : Factur-X, AFNOR PDP/PA, signatures électroniques.  ## 🎯 Fonctionnalités principales  ### 📄 Génération de factures Factur-X - **Formats** : XML seul ou PDF/A-3 avec XML embarqué - **Profils** : MINIMUM, BASIC, EN16931, EXTENDED - **Normes** : EN 16931 (directive UE 2014/55), ISO 19005-3 (PDF/A-3), CII (UN/CEFACT) - **🆕 Format simplifié** : Génération à partir de SIRET + auto-enrichissement (API Chorus Pro + Recherche Entreprises)  ### ✅ Validation et conformité - **Validation XML** : Schematron (45 à 210+ règles selon profil) - **Validation PDF** : PDF/A-3, métadonnées XMP Factur-X, signatures électroniques - **VeraPDF** : Validation stricte PDF/A (146+ règles ISO 19005-3) - **Traitement asynchrone** : Support Celery pour validations lourdes (VeraPDF)  ### 📡 Intégration AFNOR PDP/PA (XP Z12-013) - **Soumission de flux** : Envoi de factures vers Plateformes de Dématérialisation Partenaires - **Recherche de flux** : Consultation des factures soumises - **Téléchargement** : Récupération des PDF/A-3 avec XML - **Directory Service** : Recherche d'entreprises (SIREN/SIRET) - **Multi-client** : Support de plusieurs configs PDP par utilisateur (stored credentials ou zero-storage)  ### ✍️ Signature électronique PDF - **Standards** : PAdES-B-B, PAdES-B-T (horodatage RFC 3161), PAdES-B-LT (archivage long terme) - **Niveaux eIDAS** : SES (auto-signé), AdES (CA commerciale), QES (PSCO) - **Validation** : Vérification intégrité cryptographique et certificats - **Génération de certificats** : Certificats X.509 auto-signés pour tests  ### 🔄 Traitement asynchrone - **Celery** : Génération, validation et signature asynchrones - **Polling** : Suivi d'état via `/taches/{id_tache}/statut` - **Pas de timeout** : Idéal pour gros fichiers ou validations lourdes  ## 🔒 Authentification  Toutes les requêtes nécessitent un **token JWT** dans le header Authorization : ``` Authorization: Bearer YOUR_JWT_TOKEN ```  ### Comment obtenir un token JWT ?  #### 🔑 Méthode 1 : API `/api/token/` (Recommandée)  **URL :** `https://www.factpulse.fr/api/token/`  Cette méthode est **recommandée** pour l'intégration dans vos applications et workflows CI/CD.  **Prérequis :** Avoir défini un mot de passe sur votre compte  **Pour les utilisateurs inscrits via email/password :** - Vous avez déjà un mot de passe, utilisez-le directement  **Pour les utilisateurs inscrits via OAuth (Google/GitHub) :** - Vous devez d'abord définir un mot de passe sur : https://www.factpulse.fr/accounts/password/set/ - Une fois le mot de passe créé, vous pourrez utiliser l'API  **Exemple de requête :** ```bash curl -X POST https://www.factpulse.fr/api/token/ \\   -H \"Content-Type: application/json\" \\   -d '{     \"username\": \"votre_email@example.com\",     \"password\": \"votre_mot_de_passe\"   }' ```  **Paramètre optionnel `client_uid` :**  Pour sélectionner les credentials d'un client spécifique (PA/PDP, Chorus Pro, certificats de signature), ajoutez `client_uid` :  ```bash curl -X POST https://www.factpulse.fr/api/token/ \\   -H \"Content-Type: application/json\" \\   -d '{     \"username\": \"votre_email@example.com\",     \"password\": \"votre_mot_de_passe\",     \"client_uid\": \"550e8400-e29b-41d4-a716-446655440000\"   }' ```  Le `client_uid` sera inclus dans le JWT et permettra à l'API d'utiliser automatiquement : - Les credentials AFNOR/PDP configurés pour ce client - Les credentials Chorus Pro configurés pour ce client - Les certificats de signature électronique configurés pour ce client  **Réponse :** ```json {   \"access\": \"eyJ0eXAiOiJKV1QiLCJhbGc...\",  // Token d'accès (validité: 30 min)   \"refresh\": \"eyJ0eXAiOiJKV1QiLCJhbGc...\"  // Token de rafraîchissement (validité: 7 jours) } ```  **Avantages :** - ✅ Automatisation complète (CI/CD, scripts) - ✅ Gestion programmatique des tokens - ✅ Support du refresh token pour renouveler automatiquement l'accès - ✅ Intégration facile dans n'importe quel langage/outil  #### 🖥️ Méthode 2 : Génération via Dashboard (Alternative)  **URL :** https://www.factpulse.fr/dashboard/  Cette méthode convient pour des tests rapides ou une utilisation occasionnelle via l'interface graphique.  **Fonctionnement :** - Connectez-vous au dashboard - Utilisez les boutons \"Generate Test Token\" ou \"Generate Production Token\" - Fonctionne pour **tous** les utilisateurs (OAuth et email/password), sans nécessiter de mot de passe  **Types de tokens :** - **Token Test** : Validité 24h, quota 1000 appels/jour (gratuit) - **Token Production** : Validité 7 jours, quota selon votre forfait  **Avantages :** - ✅ Rapide pour tester l'API - ✅ Aucun mot de passe requis - ✅ Interface visuelle simple  **Inconvénients :** - ❌ Nécessite une action manuelle - ❌ Pas de refresh token - ❌ Moins adapté pour l'automatisation  ### 📚 Documentation complète  Pour plus d'informations sur l'authentification et l'utilisation de l'API : https://www.factpulse.fr/documentation-api/
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.18.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace FactPulse\SDK\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use FactPulse\SDK\ApiException;
use FactPulse\SDK\Configuration;
use FactPulse\SDK\FormDataProcessor;
use FactPulse\SDK\HeaderSelector;
use FactPulse\SDK\ObjectSerializer;

/**
 * VrificationPDFXMLApi Class Doc Comment
 *
 * @category Class
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class VrificationPDFXMLApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet' => [
            'application/json',
        ],
        'obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0' => [
            'application/json',
        ],
        'verifierPdfAsyncApiV1VerificationVerifierAsyncPost' => [
            'multipart/form-data',
        ],
        'verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0' => [
            'multipart/form-data',
        ],
        'verifierPdfSyncApiV1VerificationVerifierPost' => [
            'multipart/form-data',
        ],
        'verifierPdfSyncApiV1VerificationVerifierPost_0' => [
            'multipart/form-data',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\StatutTache|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'][0])
    {
        list($response) = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetWithHttpInfo($id_tache, $contentType);
        return $response;
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetWithHttpInfo
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\StatutTache|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetWithHttpInfo($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'][0])
    {
        $request = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetRequest($id_tache, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\StatutTache',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\StatutTache',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\StatutTache',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetAsync
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetAsync($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'][0])
    {
        return $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetAsyncWithHttpInfo($id_tache, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetAsyncWithHttpInfo
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetAsyncWithHttpInfo($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'][0])
    {
        $returnType = '\FactPulse\SDK\Model\StatutTache';
        $request = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetRequest($id_tache, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGetRequest($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'][0])
    {

        // verify the required parameter 'id_tache' is set
        if ($id_tache === null || (is_array($id_tache) && count($id_tache) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_tache when calling obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet'
            );
        }


        $resourcePath = '/api/v1/verification/verifier-async/{id_tache}/statut';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_tache !== null) {
            $resourcePath = str_replace(
                '{' . 'id_tache' . '}',
                ObjectSerializer::toPathValue($id_tache),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\StatutTache|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'][0])
    {
        list($response) = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0WithHttpInfo($id_tache, $contentType);
        return $response;
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0WithHttpInfo
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\StatutTache|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0WithHttpInfo($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'][0])
    {
        $request = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0Request($id_tache, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\StatutTache',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\StatutTache',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\StatutTache',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0Async
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0Async($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'][0])
    {
        return $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0AsyncWithHttpInfo($id_tache, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0AsyncWithHttpInfo
     *
     * Obtenir le statut d&#39;une vérification asynchrone
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0AsyncWithHttpInfo($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'][0])
    {
        $returnType = '\FactPulse\SDK\Model\StatutTache';
        $request = $this->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0Request($id_tache, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'
     *
     * @param  string $id_tache (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0Request($id_tache, string $contentType = self::contentTypes['obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'][0])
    {

        // verify the required parameter 'id_tache' is set
        if ($id_tache === null || (is_array($id_tache) && count($id_tache) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_tache when calling obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0'
            );
        }


        $resourcePath = '/api/v1/verification/verifier-async/{id_tache}/statut';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_tache !== null) {
            $resourcePath = str_replace(
                '{' . 'id_tache' . '}',
                ObjectSerializer::toPathValue($id_tache),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPost
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ReponseTache|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'][0])
    {
        list($response) = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPostWithHttpInfo($fichier_pdf, $forcer_ocr, $contentType);
        return $response;
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPostWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ReponseTache|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPostWithHttpInfo($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'][0])
    {
        $request = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPostRequest($fichier_pdf, $forcer_ocr, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 202:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\ReponseTache',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\ReponseTache',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ReponseTache',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPostAsync
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPostAsync($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'][0])
    {
        return $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPostAsyncWithHttpInfo($fichier_pdf, $forcer_ocr, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPostAsyncWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPostAsyncWithHttpInfo($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ReponseTache';
        $request = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPostRequest($fichier_pdf, $forcer_ocr, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'verifierPdfAsyncApiV1VerificationVerifierAsyncPost'
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPostRequest($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost'][0])
    {

        // verify the required parameter 'fichier_pdf' is set
        if ($fichier_pdf === null || (is_array($fichier_pdf) && count($fichier_pdf) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $fichier_pdf when calling verifierPdfAsyncApiV1VerificationVerifierAsyncPost'
            );
        }



        $resourcePath = '/api/v1/verification/verifier-async';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        $formDataProcessor = new FormDataProcessor();

        $formData = $formDataProcessor->prepare([
            'fichier_pdf' => $fichier_pdf,
            'forcer_ocr' => $forcer_ocr,
        ]);

        $formParams = $formDataProcessor->flatten($formData);
        $multipart = $formDataProcessor->has_file;

        $multipart = true;
        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ReponseTache|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'][0])
    {
        list($response) = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0WithHttpInfo($fichier_pdf, $forcer_ocr, $contentType);
        return $response;
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0WithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ReponseTache|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0WithHttpInfo($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'][0])
    {
        $request = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0Request($fichier_pdf, $forcer_ocr, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 202:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\ReponseTache',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\ReponseTache',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 202:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ReponseTache',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0Async
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0Async($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'][0])
    {
        return $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0AsyncWithHttpInfo($fichier_pdf, $forcer_ocr, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0AsyncWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (asynchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0AsyncWithHttpInfo($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ReponseTache';
        $request = $this->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0Request($fichier_pdf, $forcer_ocr, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  bool|null $forcer_ocr Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif (optional, default to false)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0Request($fichier_pdf, $forcer_ocr = false, string $contentType = self::contentTypes['verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'][0])
    {

        // verify the required parameter 'fichier_pdf' is set
        if ($fichier_pdf === null || (is_array($fichier_pdf) && count($fichier_pdf) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $fichier_pdf when calling verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0'
            );
        }



        $resourcePath = '/api/v1/verification/verifier-async';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        $formDataProcessor = new FormDataProcessor();

        $formData = $formDataProcessor->prepare([
            'fichier_pdf' => $fichier_pdf,
            'forcer_ocr' => $forcer_ocr,
        ]);

        $formParams = $formDataProcessor->flatten($formData);
        $multipart = $formDataProcessor->has_file;

        $multipart = true;
        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPost
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ReponseVerificationSucces|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'][0])
    {
        list($response) = $this->verifierPdfSyncApiV1VerificationVerifierPostWithHttpInfo($fichier_pdf, $contentType);
        return $response;
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPostWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ReponseVerificationSucces|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifierPdfSyncApiV1VerificationVerifierPostWithHttpInfo($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'][0])
    {
        $request = $this->verifierPdfSyncApiV1VerificationVerifierPostRequest($fichier_pdf, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\ReponseVerificationSucces',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\APIError',
                        $request,
                        $response,
                    );
                case 413:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\APIError',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\ReponseVerificationSucces',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ReponseVerificationSucces',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\APIError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 413:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\APIError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPostAsync
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfSyncApiV1VerificationVerifierPostAsync($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'][0])
    {
        return $this->verifierPdfSyncApiV1VerificationVerifierPostAsyncWithHttpInfo($fichier_pdf, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPostAsyncWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfSyncApiV1VerificationVerifierPostAsyncWithHttpInfo($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ReponseVerificationSucces';
        $request = $this->verifierPdfSyncApiV1VerificationVerifierPostRequest($fichier_pdf, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'verifierPdfSyncApiV1VerificationVerifierPost'
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifierPdfSyncApiV1VerificationVerifierPostRequest($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost'][0])
    {

        // verify the required parameter 'fichier_pdf' is set
        if ($fichier_pdf === null || (is_array($fichier_pdf) && count($fichier_pdf) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $fichier_pdf when calling verifierPdfSyncApiV1VerificationVerifierPost'
            );
        }


        $resourcePath = '/api/v1/verification/verifier';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        $formDataProcessor = new FormDataProcessor();

        $formData = $formDataProcessor->prepare([
            'fichier_pdf' => $fichier_pdf,
        ]);

        $formParams = $formDataProcessor->flatten($formData);
        $multipart = $formDataProcessor->has_file;

        $multipart = true;
        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPost_0
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ReponseVerificationSucces|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost_0($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'][0])
    {
        list($response) = $this->verifierPdfSyncApiV1VerificationVerifierPost_0WithHttpInfo($fichier_pdf, $contentType);
        return $response;
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPost_0WithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ReponseVerificationSucces|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\APIError|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost_0WithHttpInfo($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'][0])
    {
        $request = $this->verifierPdfSyncApiV1VerificationVerifierPost_0Request($fichier_pdf, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\ReponseVerificationSucces',
                        $request,
                        $response,
                    );
                case 400:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\APIError',
                        $request,
                        $response,
                    );
                case 413:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\APIError',
                        $request,
                        $response,
                    );
                case 422:
                    return $this->handleResponseWithDataType(
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\FactPulse\SDK\Model\ReponseVerificationSucces',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ReponseVerificationSucces',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\APIError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 413:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\APIError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 422:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\HTTPValidationError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPost_0Async
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost_0Async($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'][0])
    {
        return $this->verifierPdfSyncApiV1VerificationVerifierPost_0AsyncWithHttpInfo($fichier_pdf, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation verifierPdfSyncApiV1VerificationVerifierPost_0AsyncWithHttpInfo
     *
     * Vérifier la conformité PDF/XML Factur-X (synchrone)
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost_0AsyncWithHttpInfo($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ReponseVerificationSucces';
        $request = $this->verifierPdfSyncApiV1VerificationVerifierPost_0Request($fichier_pdf, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'verifierPdfSyncApiV1VerificationVerifierPost_0'
     *
     * @param  \SplFileObject $fichier_pdf Fichier PDF Factur-X à vérifier (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function verifierPdfSyncApiV1VerificationVerifierPost_0Request($fichier_pdf, string $contentType = self::contentTypes['verifierPdfSyncApiV1VerificationVerifierPost_0'][0])
    {

        // verify the required parameter 'fichier_pdf' is set
        if ($fichier_pdf === null || (is_array($fichier_pdf) && count($fichier_pdf) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $fichier_pdf when calling verifierPdfSyncApiV1VerificationVerifierPost_0'
            );
        }


        $resourcePath = '/api/v1/verification/verifier';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // form params
        $formDataProcessor = new FormDataProcessor();

        $formData = $formDataProcessor->prepare([
            'fichier_pdf' => $fichier_pdf,
        ]);

        $formParams = $formDataProcessor->flatten($formData);
        $multipart = $formDataProcessor->has_file;

        $multipart = true;
        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires Bearer authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        if ($this->config->getCertFile()) {
            $options[RequestOptions::CERT] = $this->config->getCertFile();
        }

        if ($this->config->getKeyFile()) {
            $options[RequestOptions::SSL_KEY] = $this->config->getKeyFile();
        }

        return $options;
    }

    private function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response
    ): array {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    private function responseWithinRangeCode(
        string $rangeCode,
        int $statusCode
    ): bool {
        $left = (int) ($rangeCode[0].'00');
        $right = (int) ($rangeCode[0].'99');

        return $statusCode >= $left && $statusCode <= $right;
    }
}
