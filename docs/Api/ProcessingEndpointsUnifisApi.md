# FactPulse\SDK\ProcessingEndpointsUnifisApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost()**](ProcessingEndpointsUnifisApi.md#soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost) | **POST** /api/v1/traitement/factures/soumettre-complete | Soumettre une facture complète (génération + signature + soumission) |
| [**soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost()**](ProcessingEndpointsUnifisApi.md#soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost) | **POST** /api/v1/traitement/factures/soumettre-complete-async | Soumettre une facture complète (asynchrone avec Celery) |


## `soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost()`

```php
soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost($soumettre_facture_complete_request): \FactPulse\SDK\Model\SoumettreFactureCompleteResponse
```

Soumettre une facture complète (génération + signature + soumission)

Endpoint unifié pour soumettre une facture complète vers différentes destinations.      **Workflow automatisé :**     1. **Auto-enrichissement** (optionnel) : récupère les données via APIs publiques et Chorus Pro/AFNOR     2. **Génération PDF Factur-X** : crée un PDF/A-3 avec XML embarqué     3. **Signature électronique** (optionnelle) : signe le PDF avec un certificat     4. **Soumission** : envoie vers la destination choisie (Chorus Pro ou AFNOR PDP)      **Destinations supportées :**     - **Chorus Pro** : plateforme B2G française (factures vers secteur public)     - **AFNOR PDP** : Plateformes de Dématérialisation Partenaires      **Credentials de destination - 2 modes disponibles :**      **Mode 1 - Récupération via JWT (recommandé) :**     - Les credentials sont récupérés automatiquement via le `client_uid` du JWT     - Ne pas fournir le champ `credentials` dans `destination`     - Architecture 0-trust : aucun secret dans le payload     - Exemple : `\"destination\": {\"type\": \"chorus_pro\"}`      **Mode 2 - Credentials dans le payload :**     - Fournir les credentials directement dans le payload     - Utile pour tests ou intégrations tierces     - Exemple : `\"destination\": {\"type\": \"chorus_pro\", \"credentials\": {...}}`       **Signature électronique (optionnelle) - 2 modes disponibles :**      **Mode 1 - Certificat stocké (recommandé) :**     - Le certificat est récupéré automatiquement via le `client_uid` du JWT     - Aucune clé à fournir dans le payload     - Signature PAdES-B-LT avec horodatage (conforme eIDAS)     - Exemple : `\"signature\": {\"raison\": \"Conformité Factur-X\"}`      **Mode 2 - Clés dans le payload (pour tests) :**     - Fournir `key_pem` et `cert_pem` directement     - Format PEM accepté : brut ou base64     - Utile pour tests ou cas spéciaux sans certificat stocké     - Exemple : `\"signature\": {\"key_pem\": \"-----BEGIN...\", \"cert_pem\": \"-----BEGIN...\"}`      Si `key_pem` et `cert_pem` sont fournis → Mode 2     Sinon → Mode 1 (certificat récupéré via `client_uid`)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ProcessingEndpointsUnifisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$soumettre_facture_complete_request = new \FactPulse\SDK\Model\SoumettreFactureCompleteRequest(); // \FactPulse\SDK\Model\SoumettreFactureCompleteRequest

try {
    $result = $apiInstance->soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost($soumettre_facture_complete_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProcessingEndpointsUnifisApi->soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **soumettre_facture_complete_request** | [**\FactPulse\SDK\Model\SoumettreFactureCompleteRequest**](../Model/SoumettreFactureCompleteRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SoumettreFactureCompleteResponse**](../Model/SoumettreFactureCompleteResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost()`

```php
soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost($soumettre_facture_complete_request): \FactPulse\SDK\Model\ReponseTache
```

Soumettre une facture complète (asynchrone avec Celery)

Version asynchrone de l'endpoint `/factures/soumettre-complete` utilisant Celery pour le traitement en arrière-plan.      **Workflow automatisé (identique à la version synchrone) :**     1. **Auto-enrichissement** (optionnel) : récupère les données via APIs publiques et Chorus Pro/AFNOR     2. **Génération PDF Factur-X** : crée un PDF/A-3 avec XML embarqué     3. **Signature électronique** (optionnelle) : signe le PDF avec un certificat     4. **Soumission** : envoie vers la destination choisie (Chorus Pro ou AFNOR PDP)      **Destinations supportées :**     - **Chorus Pro** : plateforme B2G française (factures vers secteur public)     - **AFNOR PDP** : Plateformes de Dématérialisation Partenaires      **Différences avec la version synchrone :**     - ✅ **Non-bloquant** : Retourne immédiatement un `id_tache` (HTTP 202 Accepted)     - ✅ **Traitement en arrière-plan** : La facture est traitée par un worker Celery     - ✅ **Suivi d'avancement** : Utilisez `/taches/{id_tache}/statut` pour suivre le statut     - ✅ **Idéal pour gros volumes** : Permet de traiter de nombreuses factures en parallèle      **Comment utiliser :**     1. **Soumission** : Appelez cet endpoint avec vos données de facture     2. **Retour immédiat** : Vous recevez un `id_tache` (ex: \"abc123-def456\")     3. **Suivi** : Appelez `/taches/{id_tache}/statut` pour vérifier l'avancement     4. **Résultat** : Quand `statut = \"SUCCESS\"`, le champ `resultat` contient la réponse complète      **Credentials et signature** : Mêmes modes que la version synchrone (JWT ou payload).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ProcessingEndpointsUnifisApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$soumettre_facture_complete_request = new \FactPulse\SDK\Model\SoumettreFactureCompleteRequest(); // \FactPulse\SDK\Model\SoumettreFactureCompleteRequest

try {
    $result = $apiInstance->soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost($soumettre_facture_complete_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ProcessingEndpointsUnifisApi->soumettreFactureCompleteAsyncApiV1TraitementFacturesSoumettreCompleteAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **soumettre_facture_complete_request** | [**\FactPulse\SDK\Model\SoumettreFactureCompleteRequest**](../Model/SoumettreFactureCompleteRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ReponseTache**](../Model/ReponseTache.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
