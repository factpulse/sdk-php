# FactPulse\SDK\CDARCycleDeVieApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**generateCdarApiV1CdarGeneratePost()**](CDARCycleDeVieApi.md#generateCdarApiV1CdarGeneratePost) | **POST** /api/v1/cdar/generate | Générer un message CDAR |
| [**getActionCodesApiV1CdarActionCodesGet()**](CDARCycleDeVieApi.md#getActionCodesApiV1CdarActionCodesGet) | **GET** /api/v1/cdar/action-codes | Liste des codes action CDAR |
| [**getReasonCodesApiV1CdarReasonCodesGet()**](CDARCycleDeVieApi.md#getReasonCodesApiV1CdarReasonCodesGet) | **GET** /api/v1/cdar/reason-codes | Liste des codes motif CDAR |
| [**getStatusCodesApiV1CdarStatusCodesGet()**](CDARCycleDeVieApi.md#getStatusCodesApiV1CdarStatusCodesGet) | **GET** /api/v1/cdar/status-codes | Liste des codes statut CDAR |
| [**submitCdarApiV1CdarSubmitPost()**](CDARCycleDeVieApi.md#submitCdarApiV1CdarSubmitPost) | **POST** /api/v1/cdar/submit | Générer et soumettre un message CDAR |
| [**submitCdarXmlApiV1CdarSubmitXmlPost()**](CDARCycleDeVieApi.md#submitCdarXmlApiV1CdarSubmitXmlPost) | **POST** /api/v1/cdar/submit-xml | Soumettre un XML CDAR pré-généré |
| [**submitEncaisseeApiV1CdarEncaisseePost()**](CDARCycleDeVieApi.md#submitEncaisseeApiV1CdarEncaisseePost) | **POST** /api/v1/cdar/encaissee | [Simplifié] Soumettre un statut ENCAISSÉE (212) |
| [**submitRefuseeApiV1CdarRefuseePost()**](CDARCycleDeVieApi.md#submitRefuseeApiV1CdarRefuseePost) | **POST** /api/v1/cdar/refusee | [Simplifié] Soumettre un statut REFUSÉE (210) |
| [**validateCdarApiV1CdarValidatePost()**](CDARCycleDeVieApi.md#validateCdarApiV1CdarValidatePost) | **POST** /api/v1/cdar/validate | Valider des données CDAR |


## `generateCdarApiV1CdarGeneratePost()`

```php
generateCdarApiV1CdarGeneratePost($create_cdar_request): \FactPulse\SDK\Model\GenerateCDARResponse
```

Générer un message CDAR

Génère un message XML CDAR (Cross Domain Acknowledgement and Response) pour communiquer le statut d'une facture.  **Types de messages:** - **23** (Traitement): Message de cycle de vie standard - **305** (Transmission): Message de transmission entre plateformes  **Règles métier:** - BR-FR-CDV-14: Le statut 212 (ENCAISSEE) requiert un montant encaissé - BR-FR-CDV-15: Les statuts 206/207/208/210/213/501 requièrent un code motif

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_cdar_request = new \FactPulse\SDK\Model\CreateCDARRequest(); // \FactPulse\SDK\Model\CreateCDARRequest

try {
    $result = $apiInstance->generateCdarApiV1CdarGeneratePost($create_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->generateCdarApiV1CdarGeneratePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_cdar_request** | [**\FactPulse\SDK\Model\CreateCDARRequest**](../Model/CreateCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GenerateCDARResponse**](../Model/GenerateCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getActionCodesApiV1CdarActionCodesGet()`

```php
getActionCodesApiV1CdarActionCodesGet(): \FactPulse\SDK\Model\ActionCodesResponse
```

Liste des codes action CDAR

Retourne la liste complète des codes action (BR-FR-CDV-CL-10).  Ces codes indiquent l'action demandée sur la facture.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getActionCodesApiV1CdarActionCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->getActionCodesApiV1CdarActionCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\ActionCodesResponse**](../Model/ActionCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getReasonCodesApiV1CdarReasonCodesGet()`

```php
getReasonCodesApiV1CdarReasonCodesGet(): \FactPulse\SDK\Model\ReasonCodesResponse
```

Liste des codes motif CDAR

Retourne la liste complète des codes motif de statut (BR-FR-CDV-CL-09).  Ces codes expliquent la raison d'un statut particulier.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getReasonCodesApiV1CdarReasonCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->getReasonCodesApiV1CdarReasonCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\ReasonCodesResponse**](../Model/ReasonCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStatusCodesApiV1CdarStatusCodesGet()`

```php
getStatusCodesApiV1CdarStatusCodesGet(): \FactPulse\SDK\Model\StatusCodesResponse
```

Liste des codes statut CDAR

Retourne la liste complète des codes statut de facture (BR-FR-CDV-CL-06).  Ces codes indiquent l'état du cycle de vie d'une facture.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getStatusCodesApiV1CdarStatusCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->getStatusCodesApiV1CdarStatusCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\StatusCodesResponse**](../Model/StatusCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitCdarApiV1CdarSubmitPost()`

```php
submitCdarApiV1CdarSubmitPost($submit_cdar_request): \FactPulse\SDK\Model\SubmitCDARResponse
```

Générer et soumettre un message CDAR

Génère un message CDAR et le soumet à la plateforme PA/PDP.  **Stratégies d'authentification:** 1. **JWT avec client_uid** (recommandé): credentials PDP récupérés du backend 2. **Zero-storage**: Fournir pdpFlowServiceUrl, pdpClientId, pdpClientSecret dans la requête  **Types de flux (flowType):** - `CustomerInvoiceLC`: Cycle de vie côté client (acheteur) - `SupplierInvoiceLC`: Cycle de vie côté fournisseur (vendeur)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_cdar_request = new \FactPulse\SDK\Model\SubmitCDARRequest(); // \FactPulse\SDK\Model\SubmitCDARRequest

try {
    $result = $apiInstance->submitCdarApiV1CdarSubmitPost($submit_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->submitCdarApiV1CdarSubmitPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_cdar_request** | [**\FactPulse\SDK\Model\SubmitCDARRequest**](../Model/SubmitCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitCDARResponse**](../Model/SubmitCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitCdarXmlApiV1CdarSubmitXmlPost()`

```php
submitCdarXmlApiV1CdarSubmitXmlPost($submit_cdarxml_request): \FactPulse\SDK\Model\SubmitCDARResponse
```

Soumettre un XML CDAR pré-généré

Soumet un message XML CDAR pré-généré à la plateforme PA/PDP.  Utile pour soumettre des XML générés par d'autres systèmes.  **Stratégies d'authentification:** 1. **JWT avec client_uid** (recommandé): credentials PDP récupérés du backend 2. **Zero-storage**: Fournir pdpFlowServiceUrl, pdpClientId, pdpClientSecret dans la requête

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_cdarxml_request = new \FactPulse\SDK\Model\SubmitCDARXMLRequest(); // \FactPulse\SDK\Model\SubmitCDARXMLRequest

try {
    $result = $apiInstance->submitCdarXmlApiV1CdarSubmitXmlPost($submit_cdarxml_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->submitCdarXmlApiV1CdarSubmitXmlPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_cdarxml_request** | [**\FactPulse\SDK\Model\SubmitCDARXMLRequest**](../Model/SubmitCDARXMLRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitCDARResponse**](../Model/SubmitCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitEncaisseeApiV1CdarEncaisseePost()`

```php
submitEncaisseeApiV1CdarEncaisseePost($encaissee_request): \FactPulse\SDK\Model\SimplifiedCDARResponse
```

[Simplifié] Soumettre un statut ENCAISSÉE (212)

**Endpoint simplifié pour OD** - Soumet un statut ENCAISSÉE (212) pour une facture.  Ce statut est **obligatoire pour le PPF** (BR-FR-CDV-14 requiert le montant encaissé).  **Cas d'usage:** L'acheteur confirme le paiement d'une facture.  **Authentification:** JWT Bearer (recommandé) ou credentials PDP dans la requête.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$encaissee_request = new \FactPulse\SDK\Model\EncaisseeRequest(); // \FactPulse\SDK\Model\EncaisseeRequest

try {
    $result = $apiInstance->submitEncaisseeApiV1CdarEncaisseePost($encaissee_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->submitEncaisseeApiV1CdarEncaisseePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **encaissee_request** | [**\FactPulse\SDK\Model\EncaisseeRequest**](../Model/EncaisseeRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SimplifiedCDARResponse**](../Model/SimplifiedCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitRefuseeApiV1CdarRefuseePost()`

```php
submitRefuseeApiV1CdarRefuseePost($refusee_request): \FactPulse\SDK\Model\SimplifiedCDARResponse
```

[Simplifié] Soumettre un statut REFUSÉE (210)

**Endpoint simplifié pour OD** - Soumet un statut REFUSÉE (210) pour une facture.  Ce statut est **obligatoire pour le PPF** (BR-FR-CDV-15 requiert un code motif).  **Cas d'usage:** L'acheteur refuse une facture reçue.  **Codes motif autorisés (BR-FR-CDV-CL-09):** - `TX_TVA_ERR`: Taux de TVA erroné - `MONTANTTOTAL_ERR`: Montant total erroné - `CALCUL_ERR`: Erreur de calcul - `NON_CONFORME`: Non conforme - `DOUBLON`: Doublon - `DEST_ERR`: Destinataire erroné - `TRANSAC_INC`: Transaction incomplète - `EMMET_INC`: Émetteur inconnu - `CONTRAT_TERM`: Contrat terminé - `DOUBLE_FACT`: Double facturation - `CMD_ERR`: Commande erronée - `ADR_ERR`: Adresse erronée - `REF_CT_ABSENT`: Référence contrat absente  **Authentification:** JWT Bearer (recommandé) ou credentials PDP dans la requête.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$refusee_request = new \FactPulse\SDK\Model\RefuseeRequest(); // \FactPulse\SDK\Model\RefuseeRequest

try {
    $result = $apiInstance->submitRefuseeApiV1CdarRefuseePost($refusee_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->submitRefuseeApiV1CdarRefuseePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **refusee_request** | [**\FactPulse\SDK\Model\RefuseeRequest**](../Model/RefuseeRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SimplifiedCDARResponse**](../Model/SimplifiedCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateCdarApiV1CdarValidatePost()`

```php
validateCdarApiV1CdarValidatePost($validate_cdar_request): \FactPulse\SDK\Model\ValidateCDARResponse
```

Valider des données CDAR

Valide les données CDAR sans générer le XML.  Vérifie: - Les formats des champs (SIREN, dates, etc.) - Les codes enums (statut, motif, action) - Les règles métier BR-FR-CDV-*

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\CDARCycleDeVieApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$validate_cdar_request = new \FactPulse\SDK\Model\ValidateCDARRequest(); // \FactPulse\SDK\Model\ValidateCDARRequest

try {
    $result = $apiInstance->validateCdarApiV1CdarValidatePost($validate_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CDARCycleDeVieApi->validateCdarApiV1CdarValidatePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **validate_cdar_request** | [**\FactPulse\SDK\Model\ValidateCDARRequest**](../Model/ValidateCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ValidateCDARResponse**](../Model/ValidateCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
