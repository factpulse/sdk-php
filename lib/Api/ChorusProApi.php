<?php
/**
 * ChorusProApi
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
 * ChorusProApi Class Doc Comment
 *
 * @category Class
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ChorusProApi
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
        'ajouterFichierApiV1ChorusProTransversesAjouterFichierPost' => [
            'application/json',
        ],
        'completerFactureApiV1ChorusProFacturesCompleterPost' => [
            'application/json',
        ],
        'consulterFactureApiV1ChorusProFacturesConsulterPost' => [
            'application/json',
        ],
        'consulterStructureApiV1ChorusProStructuresConsulterPost' => [
            'application/json',
        ],
        'listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet' => [
            'application/json',
        ],
        'obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost' => [
            'application/json',
        ],
        'rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost' => [
            'application/json',
        ],
        'rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost' => [
            'application/json',
        ],
        'rechercherStructuresApiV1ChorusProStructuresRechercherPost' => [
            'application/json',
        ],
        'recyclerFactureApiV1ChorusProFacturesRecyclerPost' => [
            'application/json',
        ],
        'soumettreFactureApiV1ChorusProFacturesSoumettrePost' => [
            'application/json',
        ],
        'telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost' => [
            'application/json',
        ],
        'traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost' => [
            'application/json',
        ],
        'valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost' => [
            'application/json',
        ],
        'valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost' => [
            'application/json',
        ],
        'valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost' => [
            'application/json',
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
     * Operation ajouterFichierApiV1ChorusProTransversesAjouterFichierPost
     *
     * Ajouter une pièce jointe
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function ajouterFichierApiV1ChorusProTransversesAjouterFichierPost($request_body, string $contentType = self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'][0])
    {
        list($response) = $this->ajouterFichierApiV1ChorusProTransversesAjouterFichierPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation ajouterFichierApiV1ChorusProTransversesAjouterFichierPostWithHttpInfo
     *
     * Ajouter une pièce jointe
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function ajouterFichierApiV1ChorusProTransversesAjouterFichierPostWithHttpInfo($request_body, string $contentType = self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'][0])
    {
        $request = $this->ajouterFichierApiV1ChorusProTransversesAjouterFichierPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation ajouterFichierApiV1ChorusProTransversesAjouterFichierPostAsync
     *
     * Ajouter une pièce jointe
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ajouterFichierApiV1ChorusProTransversesAjouterFichierPostAsync($request_body, string $contentType = self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'][0])
    {
        return $this->ajouterFichierApiV1ChorusProTransversesAjouterFichierPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation ajouterFichierApiV1ChorusProTransversesAjouterFichierPostAsyncWithHttpInfo
     *
     * Ajouter une pièce jointe
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function ajouterFichierApiV1ChorusProTransversesAjouterFichierPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->ajouterFichierApiV1ChorusProTransversesAjouterFichierPostRequest($request_body, $contentType);

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
     * Create request for operation 'ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function ajouterFichierApiV1ChorusProTransversesAjouterFichierPostRequest($request_body, string $contentType = self::contentTypes['ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling ajouterFichierApiV1ChorusProTransversesAjouterFichierPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/transverses/ajouter-fichier';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation completerFactureApiV1ChorusProFacturesCompleterPost
     *
     * Compléter une facture suspendue (Fournisseur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function completerFactureApiV1ChorusProFacturesCompleterPost($request_body, string $contentType = self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'][0])
    {
        list($response) = $this->completerFactureApiV1ChorusProFacturesCompleterPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation completerFactureApiV1ChorusProFacturesCompleterPostWithHttpInfo
     *
     * Compléter une facture suspendue (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function completerFactureApiV1ChorusProFacturesCompleterPostWithHttpInfo($request_body, string $contentType = self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'][0])
    {
        $request = $this->completerFactureApiV1ChorusProFacturesCompleterPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation completerFactureApiV1ChorusProFacturesCompleterPostAsync
     *
     * Compléter une facture suspendue (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function completerFactureApiV1ChorusProFacturesCompleterPostAsync($request_body, string $contentType = self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'][0])
    {
        return $this->completerFactureApiV1ChorusProFacturesCompleterPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation completerFactureApiV1ChorusProFacturesCompleterPostAsyncWithHttpInfo
     *
     * Compléter une facture suspendue (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function completerFactureApiV1ChorusProFacturesCompleterPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->completerFactureApiV1ChorusProFacturesCompleterPostRequest($request_body, $contentType);

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
     * Create request for operation 'completerFactureApiV1ChorusProFacturesCompleterPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function completerFactureApiV1ChorusProFacturesCompleterPostRequest($request_body, string $contentType = self::contentTypes['completerFactureApiV1ChorusProFacturesCompleterPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling completerFactureApiV1ChorusProFacturesCompleterPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/completer';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation consulterFactureApiV1ChorusProFacturesConsulterPost
     *
     * Consulter le statut d&#39;une facture
     *
     * @param  \FactPulse\SDK\Model\ConsulterFactureRequest $consulter_facture_request consulter_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ConsulterFactureResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function consulterFactureApiV1ChorusProFacturesConsulterPost($consulter_facture_request, string $contentType = self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'][0])
    {
        list($response) = $this->consulterFactureApiV1ChorusProFacturesConsulterPostWithHttpInfo($consulter_facture_request, $contentType);
        return $response;
    }

    /**
     * Operation consulterFactureApiV1ChorusProFacturesConsulterPostWithHttpInfo
     *
     * Consulter le statut d&#39;une facture
     *
     * @param  \FactPulse\SDK\Model\ConsulterFactureRequest $consulter_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ConsulterFactureResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function consulterFactureApiV1ChorusProFacturesConsulterPostWithHttpInfo($consulter_facture_request, string $contentType = self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'][0])
    {
        $request = $this->consulterFactureApiV1ChorusProFacturesConsulterPostRequest($consulter_facture_request, $contentType);

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
                        '\FactPulse\SDK\Model\ConsulterFactureResponse',
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
                '\FactPulse\SDK\Model\ConsulterFactureResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ConsulterFactureResponse',
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
     * Operation consulterFactureApiV1ChorusProFacturesConsulterPostAsync
     *
     * Consulter le statut d&#39;une facture
     *
     * @param  \FactPulse\SDK\Model\ConsulterFactureRequest $consulter_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function consulterFactureApiV1ChorusProFacturesConsulterPostAsync($consulter_facture_request, string $contentType = self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'][0])
    {
        return $this->consulterFactureApiV1ChorusProFacturesConsulterPostAsyncWithHttpInfo($consulter_facture_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation consulterFactureApiV1ChorusProFacturesConsulterPostAsyncWithHttpInfo
     *
     * Consulter le statut d&#39;une facture
     *
     * @param  \FactPulse\SDK\Model\ConsulterFactureRequest $consulter_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function consulterFactureApiV1ChorusProFacturesConsulterPostAsyncWithHttpInfo($consulter_facture_request, string $contentType = self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ConsulterFactureResponse';
        $request = $this->consulterFactureApiV1ChorusProFacturesConsulterPostRequest($consulter_facture_request, $contentType);

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
     * Create request for operation 'consulterFactureApiV1ChorusProFacturesConsulterPost'
     *
     * @param  \FactPulse\SDK\Model\ConsulterFactureRequest $consulter_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function consulterFactureApiV1ChorusProFacturesConsulterPostRequest($consulter_facture_request, string $contentType = self::contentTypes['consulterFactureApiV1ChorusProFacturesConsulterPost'][0])
    {

        // verify the required parameter 'consulter_facture_request' is set
        if ($consulter_facture_request === null || (is_array($consulter_facture_request) && count($consulter_facture_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $consulter_facture_request when calling consulterFactureApiV1ChorusProFacturesConsulterPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/consulter';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($consulter_facture_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($consulter_facture_request));
            } else {
                $httpBody = $consulter_facture_request;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation consulterStructureApiV1ChorusProStructuresConsulterPost
     *
     * Consulter les détails d&#39;une structure
     *
     * @param  \FactPulse\SDK\Model\ConsulterStructureRequest $consulter_structure_request consulter_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ConsulterStructureResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function consulterStructureApiV1ChorusProStructuresConsulterPost($consulter_structure_request, string $contentType = self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'][0])
    {
        list($response) = $this->consulterStructureApiV1ChorusProStructuresConsulterPostWithHttpInfo($consulter_structure_request, $contentType);
        return $response;
    }

    /**
     * Operation consulterStructureApiV1ChorusProStructuresConsulterPostWithHttpInfo
     *
     * Consulter les détails d&#39;une structure
     *
     * @param  \FactPulse\SDK\Model\ConsulterStructureRequest $consulter_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ConsulterStructureResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function consulterStructureApiV1ChorusProStructuresConsulterPostWithHttpInfo($consulter_structure_request, string $contentType = self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'][0])
    {
        $request = $this->consulterStructureApiV1ChorusProStructuresConsulterPostRequest($consulter_structure_request, $contentType);

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
                        '\FactPulse\SDK\Model\ConsulterStructureResponse',
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
                '\FactPulse\SDK\Model\ConsulterStructureResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ConsulterStructureResponse',
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
     * Operation consulterStructureApiV1ChorusProStructuresConsulterPostAsync
     *
     * Consulter les détails d&#39;une structure
     *
     * @param  \FactPulse\SDK\Model\ConsulterStructureRequest $consulter_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function consulterStructureApiV1ChorusProStructuresConsulterPostAsync($consulter_structure_request, string $contentType = self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'][0])
    {
        return $this->consulterStructureApiV1ChorusProStructuresConsulterPostAsyncWithHttpInfo($consulter_structure_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation consulterStructureApiV1ChorusProStructuresConsulterPostAsyncWithHttpInfo
     *
     * Consulter les détails d&#39;une structure
     *
     * @param  \FactPulse\SDK\Model\ConsulterStructureRequest $consulter_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function consulterStructureApiV1ChorusProStructuresConsulterPostAsyncWithHttpInfo($consulter_structure_request, string $contentType = self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ConsulterStructureResponse';
        $request = $this->consulterStructureApiV1ChorusProStructuresConsulterPostRequest($consulter_structure_request, $contentType);

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
     * Create request for operation 'consulterStructureApiV1ChorusProStructuresConsulterPost'
     *
     * @param  \FactPulse\SDK\Model\ConsulterStructureRequest $consulter_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function consulterStructureApiV1ChorusProStructuresConsulterPostRequest($consulter_structure_request, string $contentType = self::contentTypes['consulterStructureApiV1ChorusProStructuresConsulterPost'][0])
    {

        // verify the required parameter 'consulter_structure_request' is set
        if ($consulter_structure_request === null || (is_array($consulter_structure_request) && count($consulter_structure_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $consulter_structure_request when calling consulterStructureApiV1ChorusProStructuresConsulterPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/structures/consulter';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($consulter_structure_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($consulter_structure_request));
            } else {
                $httpBody = $consulter_structure_request;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet
     *
     * Lister les services d&#39;une structure
     *
     * @param  int $id_structure_cpp id_structure_cpp (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\RechercherServicesResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet($id_structure_cpp, string $contentType = self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'][0])
    {
        list($response) = $this->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetWithHttpInfo($id_structure_cpp, $contentType);
        return $response;
    }

    /**
     * Operation listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetWithHttpInfo
     *
     * Lister les services d&#39;une structure
     *
     * @param  int $id_structure_cpp (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\RechercherServicesResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetWithHttpInfo($id_structure_cpp, string $contentType = self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'][0])
    {
        $request = $this->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetRequest($id_structure_cpp, $contentType);

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
                        '\FactPulse\SDK\Model\RechercherServicesResponse',
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
                '\FactPulse\SDK\Model\RechercherServicesResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\RechercherServicesResponse',
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
     * Operation listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetAsync
     *
     * Lister les services d&#39;une structure
     *
     * @param  int $id_structure_cpp (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetAsync($id_structure_cpp, string $contentType = self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'][0])
    {
        return $this->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetAsyncWithHttpInfo($id_structure_cpp, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetAsyncWithHttpInfo
     *
     * Lister les services d&#39;une structure
     *
     * @param  int $id_structure_cpp (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetAsyncWithHttpInfo($id_structure_cpp, string $contentType = self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'][0])
    {
        $returnType = '\FactPulse\SDK\Model\RechercherServicesResponse';
        $request = $this->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetRequest($id_structure_cpp, $contentType);

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
     * Create request for operation 'listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'
     *
     * @param  int $id_structure_cpp (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGetRequest($id_structure_cpp, string $contentType = self::contentTypes['listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'][0])
    {

        // verify the required parameter 'id_structure_cpp' is set
        if ($id_structure_cpp === null || (is_array($id_structure_cpp) && count($id_structure_cpp) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id_structure_cpp when calling listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/structures/{id_structure_cpp}/services';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id_structure_cpp !== null) {
            $resourcePath = str_replace(
                '{' . 'id_structure_cpp' . '}',
                ObjectSerializer::toPathValue($id_structure_cpp),
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
     * Operation obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost
     *
     * Utilitaire : Obtenir l&#39;ID Chorus Pro depuis un SIRET
     *
     * @param  \FactPulse\SDK\Model\ObtenirIdChorusProRequest $obtenir_id_chorus_pro_request obtenir_id_chorus_pro_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\ObtenirIdChorusProResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost($obtenir_id_chorus_pro_request, string $contentType = self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'][0])
    {
        list($response) = $this->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostWithHttpInfo($obtenir_id_chorus_pro_request, $contentType);
        return $response;
    }

    /**
     * Operation obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostWithHttpInfo
     *
     * Utilitaire : Obtenir l&#39;ID Chorus Pro depuis un SIRET
     *
     * @param  \FactPulse\SDK\Model\ObtenirIdChorusProRequest $obtenir_id_chorus_pro_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\ObtenirIdChorusProResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostWithHttpInfo($obtenir_id_chorus_pro_request, string $contentType = self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'][0])
    {
        $request = $this->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostRequest($obtenir_id_chorus_pro_request, $contentType);

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
                        '\FactPulse\SDK\Model\ObtenirIdChorusProResponse',
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
                '\FactPulse\SDK\Model\ObtenirIdChorusProResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\ObtenirIdChorusProResponse',
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
     * Operation obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostAsync
     *
     * Utilitaire : Obtenir l&#39;ID Chorus Pro depuis un SIRET
     *
     * @param  \FactPulse\SDK\Model\ObtenirIdChorusProRequest $obtenir_id_chorus_pro_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostAsync($obtenir_id_chorus_pro_request, string $contentType = self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'][0])
    {
        return $this->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostAsyncWithHttpInfo($obtenir_id_chorus_pro_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostAsyncWithHttpInfo
     *
     * Utilitaire : Obtenir l&#39;ID Chorus Pro depuis un SIRET
     *
     * @param  \FactPulse\SDK\Model\ObtenirIdChorusProRequest $obtenir_id_chorus_pro_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostAsyncWithHttpInfo($obtenir_id_chorus_pro_request, string $contentType = self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\ObtenirIdChorusProResponse';
        $request = $this->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostRequest($obtenir_id_chorus_pro_request, $contentType);

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
     * Create request for operation 'obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'
     *
     * @param  \FactPulse\SDK\Model\ObtenirIdChorusProRequest $obtenir_id_chorus_pro_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPostRequest($obtenir_id_chorus_pro_request, string $contentType = self::contentTypes['obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'][0])
    {

        // verify the required parameter 'obtenir_id_chorus_pro_request' is set
        if ($obtenir_id_chorus_pro_request === null || (is_array($obtenir_id_chorus_pro_request) && count($obtenir_id_chorus_pro_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $obtenir_id_chorus_pro_request when calling obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/structures/obtenir-id-depuis-siret';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($obtenir_id_chorus_pro_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($obtenir_id_chorus_pro_request));
            } else {
                $httpBody = $obtenir_id_chorus_pro_request;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost
     *
     * Rechercher factures reçues (Destinataire)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost($request_body, string $contentType = self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'][0])
    {
        list($response) = $this->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostWithHttpInfo
     *
     * Rechercher factures reçues (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostWithHttpInfo($request_body, string $contentType = self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'][0])
    {
        $request = $this->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostAsync
     *
     * Rechercher factures reçues (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostAsync($request_body, string $contentType = self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'][0])
    {
        return $this->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostAsyncWithHttpInfo
     *
     * Rechercher factures reçues (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'][0])
    {
        $returnType = 'mixed';
        $request = $this->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostRequest($request_body, $contentType);

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
     * Create request for operation 'rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePostRequest($request_body, string $contentType = self::contentTypes['rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/rechercher-destinataire';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost
     *
     * Rechercher factures émises (Fournisseur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost($request_body, string $contentType = self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'][0])
    {
        list($response) = $this->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostWithHttpInfo
     *
     * Rechercher factures émises (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostWithHttpInfo($request_body, string $contentType = self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'][0])
    {
        $request = $this->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostAsync
     *
     * Rechercher factures émises (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostAsync($request_body, string $contentType = self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'][0])
    {
        return $this->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostAsyncWithHttpInfo
     *
     * Rechercher factures émises (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostRequest($request_body, $contentType);

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
     * Create request for operation 'rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPostRequest($request_body, string $contentType = self::contentTypes['rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/rechercher-fournisseur';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation rechercherStructuresApiV1ChorusProStructuresRechercherPost
     *
     * Rechercher des structures Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\RechercherStructureRequest $rechercher_structure_request rechercher_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\RechercherStructureResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function rechercherStructuresApiV1ChorusProStructuresRechercherPost($rechercher_structure_request, string $contentType = self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'][0])
    {
        list($response) = $this->rechercherStructuresApiV1ChorusProStructuresRechercherPostWithHttpInfo($rechercher_structure_request, $contentType);
        return $response;
    }

    /**
     * Operation rechercherStructuresApiV1ChorusProStructuresRechercherPostWithHttpInfo
     *
     * Rechercher des structures Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\RechercherStructureRequest $rechercher_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\RechercherStructureResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function rechercherStructuresApiV1ChorusProStructuresRechercherPostWithHttpInfo($rechercher_structure_request, string $contentType = self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'][0])
    {
        $request = $this->rechercherStructuresApiV1ChorusProStructuresRechercherPostRequest($rechercher_structure_request, $contentType);

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
                        '\FactPulse\SDK\Model\RechercherStructureResponse',
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
                '\FactPulse\SDK\Model\RechercherStructureResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\RechercherStructureResponse',
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
     * Operation rechercherStructuresApiV1ChorusProStructuresRechercherPostAsync
     *
     * Rechercher des structures Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\RechercherStructureRequest $rechercher_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherStructuresApiV1ChorusProStructuresRechercherPostAsync($rechercher_structure_request, string $contentType = self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'][0])
    {
        return $this->rechercherStructuresApiV1ChorusProStructuresRechercherPostAsyncWithHttpInfo($rechercher_structure_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation rechercherStructuresApiV1ChorusProStructuresRechercherPostAsyncWithHttpInfo
     *
     * Rechercher des structures Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\RechercherStructureRequest $rechercher_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function rechercherStructuresApiV1ChorusProStructuresRechercherPostAsyncWithHttpInfo($rechercher_structure_request, string $contentType = self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\RechercherStructureResponse';
        $request = $this->rechercherStructuresApiV1ChorusProStructuresRechercherPostRequest($rechercher_structure_request, $contentType);

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
     * Create request for operation 'rechercherStructuresApiV1ChorusProStructuresRechercherPost'
     *
     * @param  \FactPulse\SDK\Model\RechercherStructureRequest $rechercher_structure_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function rechercherStructuresApiV1ChorusProStructuresRechercherPostRequest($rechercher_structure_request, string $contentType = self::contentTypes['rechercherStructuresApiV1ChorusProStructuresRechercherPost'][0])
    {

        // verify the required parameter 'rechercher_structure_request' is set
        if ($rechercher_structure_request === null || (is_array($rechercher_structure_request) && count($rechercher_structure_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $rechercher_structure_request when calling rechercherStructuresApiV1ChorusProStructuresRechercherPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/structures/rechercher';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($rechercher_structure_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($rechercher_structure_request));
            } else {
                $httpBody = $rechercher_structure_request;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation recyclerFactureApiV1ChorusProFacturesRecyclerPost
     *
     * Recycler une facture (Fournisseur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function recyclerFactureApiV1ChorusProFacturesRecyclerPost($request_body, string $contentType = self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'][0])
    {
        list($response) = $this->recyclerFactureApiV1ChorusProFacturesRecyclerPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation recyclerFactureApiV1ChorusProFacturesRecyclerPostWithHttpInfo
     *
     * Recycler une facture (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function recyclerFactureApiV1ChorusProFacturesRecyclerPostWithHttpInfo($request_body, string $contentType = self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'][0])
    {
        $request = $this->recyclerFactureApiV1ChorusProFacturesRecyclerPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation recyclerFactureApiV1ChorusProFacturesRecyclerPostAsync
     *
     * Recycler une facture (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function recyclerFactureApiV1ChorusProFacturesRecyclerPostAsync($request_body, string $contentType = self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'][0])
    {
        return $this->recyclerFactureApiV1ChorusProFacturesRecyclerPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation recyclerFactureApiV1ChorusProFacturesRecyclerPostAsyncWithHttpInfo
     *
     * Recycler une facture (Fournisseur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function recyclerFactureApiV1ChorusProFacturesRecyclerPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->recyclerFactureApiV1ChorusProFacturesRecyclerPostRequest($request_body, $contentType);

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
     * Create request for operation 'recyclerFactureApiV1ChorusProFacturesRecyclerPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function recyclerFactureApiV1ChorusProFacturesRecyclerPostRequest($request_body, string $contentType = self::contentTypes['recyclerFactureApiV1ChorusProFacturesRecyclerPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling recyclerFactureApiV1ChorusProFacturesRecyclerPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/recycler';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation soumettreFactureApiV1ChorusProFacturesSoumettrePost
     *
     * Soumettre une facture à Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\SoumettreFactureRequest $soumettre_facture_request soumettre_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \FactPulse\SDK\Model\SoumettreFactureResponse|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function soumettreFactureApiV1ChorusProFacturesSoumettrePost($soumettre_facture_request, string $contentType = self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'][0])
    {
        list($response) = $this->soumettreFactureApiV1ChorusProFacturesSoumettrePostWithHttpInfo($soumettre_facture_request, $contentType);
        return $response;
    }

    /**
     * Operation soumettreFactureApiV1ChorusProFacturesSoumettrePostWithHttpInfo
     *
     * Soumettre une facture à Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\SoumettreFactureRequest $soumettre_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \FactPulse\SDK\Model\SoumettreFactureResponse|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function soumettreFactureApiV1ChorusProFacturesSoumettrePostWithHttpInfo($soumettre_facture_request, string $contentType = self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'][0])
    {
        $request = $this->soumettreFactureApiV1ChorusProFacturesSoumettrePostRequest($soumettre_facture_request, $contentType);

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
                        '\FactPulse\SDK\Model\SoumettreFactureResponse',
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
                '\FactPulse\SDK\Model\SoumettreFactureResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\FactPulse\SDK\Model\SoumettreFactureResponse',
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
     * Operation soumettreFactureApiV1ChorusProFacturesSoumettrePostAsync
     *
     * Soumettre une facture à Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\SoumettreFactureRequest $soumettre_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function soumettreFactureApiV1ChorusProFacturesSoumettrePostAsync($soumettre_facture_request, string $contentType = self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'][0])
    {
        return $this->soumettreFactureApiV1ChorusProFacturesSoumettrePostAsyncWithHttpInfo($soumettre_facture_request, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation soumettreFactureApiV1ChorusProFacturesSoumettrePostAsyncWithHttpInfo
     *
     * Soumettre une facture à Chorus Pro
     *
     * @param  \FactPulse\SDK\Model\SoumettreFactureRequest $soumettre_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function soumettreFactureApiV1ChorusProFacturesSoumettrePostAsyncWithHttpInfo($soumettre_facture_request, string $contentType = self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'][0])
    {
        $returnType = '\FactPulse\SDK\Model\SoumettreFactureResponse';
        $request = $this->soumettreFactureApiV1ChorusProFacturesSoumettrePostRequest($soumettre_facture_request, $contentType);

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
     * Create request for operation 'soumettreFactureApiV1ChorusProFacturesSoumettrePost'
     *
     * @param  \FactPulse\SDK\Model\SoumettreFactureRequest $soumettre_facture_request (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function soumettreFactureApiV1ChorusProFacturesSoumettrePostRequest($soumettre_facture_request, string $contentType = self::contentTypes['soumettreFactureApiV1ChorusProFacturesSoumettrePost'][0])
    {

        // verify the required parameter 'soumettre_facture_request' is set
        if ($soumettre_facture_request === null || (is_array($soumettre_facture_request) && count($soumettre_facture_request) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $soumettre_facture_request when calling soumettreFactureApiV1ChorusProFacturesSoumettrePost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/soumettre';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($soumettre_facture_request)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($soumettre_facture_request));
            } else {
                $httpBody = $soumettre_facture_request;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost
     *
     * Télécharger un groupe de factures
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost($request_body, string $contentType = self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'][0])
    {
        list($response) = $this->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostWithHttpInfo
     *
     * Télécharger un groupe de factures
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostWithHttpInfo($request_body, string $contentType = self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'][0])
    {
        $request = $this->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostAsync
     *
     * Télécharger un groupe de factures
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostAsync($request_body, string $contentType = self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'][0])
    {
        return $this->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostAsyncWithHttpInfo
     *
     * Télécharger un groupe de factures
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'][0])
    {
        $returnType = 'mixed';
        $request = $this->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostRequest($request_body, $contentType);

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
     * Create request for operation 'telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePostRequest($request_body, string $contentType = self::contentTypes['telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/telecharger-groupe';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost
     *
     * Traiter une facture reçue (Destinataire)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost($request_body, string $contentType = self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'][0])
    {
        list($response) = $this->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostWithHttpInfo
     *
     * Traiter une facture reçue (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostWithHttpInfo($request_body, string $contentType = self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'][0])
    {
        $request = $this->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostAsync
     *
     * Traiter une facture reçue (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostAsync($request_body, string $contentType = self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'][0])
    {
        return $this->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostAsyncWithHttpInfo
     *
     * Traiter une facture reçue (Destinataire)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'][0])
    {
        $returnType = 'mixed';
        $request = $this->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostRequest($request_body, $contentType);

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
     * Create request for operation 'traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePostRequest($request_body, string $contentType = self::contentTypes['traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/traiter-facture-recue';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost
     *
     * Consulter une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost($request_body, string $contentType = self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'][0])
    {
        list($response) = $this->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostWithHttpInfo
     *
     * Consulter une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'][0])
    {
        $request = $this->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostAsync
     *
     * Consulter une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostAsync($request_body, string $contentType = self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'][0])
    {
        return $this->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostAsyncWithHttpInfo
     *
     * Consulter une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostRequest($request_body, $contentType);

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
     * Create request for operation 'valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPostRequest($request_body, string $contentType = self::contentTypes['valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/valideur/consulter';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost
     *
     * Rechercher factures à valider (Valideur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost($request_body, string $contentType = self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'][0])
    {
        list($response) = $this->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostWithHttpInfo
     *
     * Rechercher factures à valider (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'][0])
    {
        $request = $this->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostAsync
     *
     * Rechercher factures à valider (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostAsync($request_body, string $contentType = self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'][0])
    {
        return $this->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostAsyncWithHttpInfo
     *
     * Rechercher factures à valider (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostRequest($request_body, $contentType);

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
     * Create request for operation 'valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPostRequest($request_body, string $contentType = self::contentTypes['valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/valideur/rechercher';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
     * Operation valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost
     *
     * Valider ou refuser une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return mixed|\FactPulse\SDK\Model\HTTPValidationError
     */
    public function valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost($request_body, string $contentType = self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'][0])
    {
        list($response) = $this->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostWithHttpInfo($request_body, $contentType);
        return $response;
    }

    /**
     * Operation valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostWithHttpInfo
     *
     * Valider ou refuser une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'] to see the possible values for this operation
     *
     * @throws \FactPulse\SDK\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of mixed|\FactPulse\SDK\Model\HTTPValidationError, HTTP status code, HTTP response headers (array of strings)
     */
    public function valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'][0])
    {
        $request = $this->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostRequest($request_body, $contentType);

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
                        'mixed',
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
                'mixed',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        'mixed',
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
     * Operation valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostAsync
     *
     * Valider ou refuser une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostAsync($request_body, string $contentType = self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'][0])
    {
        return $this->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostAsyncWithHttpInfo($request_body, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostAsyncWithHttpInfo
     *
     * Valider ou refuser une facture (Valideur)
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostAsyncWithHttpInfo($request_body, string $contentType = self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'][0])
    {
        $returnType = 'mixed';
        $request = $this->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostRequest($request_body, $contentType);

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
     * Create request for operation 'valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'
     *
     * @param  array<string,mixed> $request_body (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPostRequest($request_body, string $contentType = self::contentTypes['valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'][0])
    {

        // verify the required parameter 'request_body' is set
        if ($request_body === null || (is_array($request_body) && count($request_body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $request_body when calling valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost'
            );
        }


        $resourcePath = '/api/v1/chorus-pro/factures/valideur/traiter';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($request_body)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($request_body));
            } else {
                $httpBody = $request_body;
            }
        } elseif (count($formParams) > 0) {
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
