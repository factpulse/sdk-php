# FactPulse\SDK\AFNORPDPPAApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAfnorCredentialsApiV1AfnorCredentialsGet()**](AFNORPDPPAApi.md#getAfnorCredentialsApiV1AfnorCredentialsGet) | **GET** /api/v1/afnor/credentials | Récupérer les credentials AFNOR stockés |
| [**getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet()**](AFNORPDPPAApi.md#getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet) | **GET** /api/v1/afnor/flux-entrants/{flow_id} | Récupérer et extraire une facture entrante |
| [**oauthTokenProxyApiV1AfnorOauthTokenPost()**](AFNORPDPPAApi.md#oauthTokenProxyApiV1AfnorOauthTokenPost) | **POST** /api/v1/afnor/oauth/token | Endpoint OAuth2 pour authentification AFNOR |


## `getAfnorCredentialsApiV1AfnorCredentialsGet()`

```php
getAfnorCredentialsApiV1AfnorCredentialsGet(): mixed
```

Récupérer les credentials AFNOR stockés

Récupère les credentials AFNOR/PDP stockés pour le client_uid du JWT. Cet endpoint est utilisé par le SDK en mode 'stored' pour récupérer les credentials avant de faire l'OAuth AFNOR lui-même.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getAfnorCredentialsApiV1AfnorCredentialsGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAApi->getAfnorCredentialsApiV1AfnorCredentialsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet()`

```php
getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet($flow_id, $include_document): \FactPulse\SDK\Model\FactureEntrante
```

Récupérer et extraire une facture entrante

Télécharge un flux entrant depuis la PDP AFNOR et extrait les métadonnées de la facture vers un format JSON unifié. Supporte les formats Factur-X, CII et UBL.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$flow_id = 'flow_id_example'; // string
$include_document = false; // bool

try {
    $result = $apiInstance->getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet($flow_id, $include_document);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAApi->getFluxEntrantApiV1AfnorFluxEntrantsFlowIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **flow_id** | **string**|  | |
| **include_document** | **bool**|  | [optional] [default to false] |

### Return type

[**\FactPulse\SDK\Model\FactureEntrante**](../Model/FactureEntrante.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `oauthTokenProxyApiV1AfnorOauthTokenPost()`

```php
oauthTokenProxyApiV1AfnorOauthTokenPost(): mixed
```

Endpoint OAuth2 pour authentification AFNOR

Endpoint proxy OAuth2 pour obtenir un token d'accès AFNOR. Fait proxy vers le mock AFNOR (sandbox) ou la vraie PDP selon MOCK_AFNOR_BASE_URL. Cet endpoint est public (pas d'auth Django requise) car il est appelé par le SDK AFNOR.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->oauthTokenProxyApiV1AfnorOauthTokenPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAApi->oauthTokenProxyApiV1AfnorOauthTokenPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
