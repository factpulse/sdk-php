# FactPulse\SDK\AFNORPDPPAFlowServiceApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()**](AFNORPDPPAFlowServiceApi.md#downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet) | **GET** /api/v1/afnor/flow/v1/flows/{flowId} | Télécharger un flux |
| [**flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()**](AFNORPDPPAFlowServiceApi.md#flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet) | **GET** /api/v1/afnor/flow/v1/healthcheck | Healthcheck Flow Service |
| [**searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost()**](AFNORPDPPAFlowServiceApi.md#searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost) | **POST** /api/v1/afnor/flow/v1/flows/search | Rechercher des flux |
| [**submitFlowProxyApiV1AfnorFlowV1FlowsPost()**](AFNORPDPPAFlowServiceApi.md#submitFlowProxyApiV1AfnorFlowV1FlowsPost) | **POST** /api/v1/afnor/flow/v1/flows | Soumettre un flux de facturation |


## `downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()`

```php
downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet($flow_id): mixed
```

Télécharger un flux

Télécharger le fichier PDF/A-3 d'un flux de facturation (utilise le client_uid du JWT)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$flow_id = 'flow_id_example'; // string

try {
    $result = $apiInstance->downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet($flow_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **flow_id** | **string**|  | |

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/pdf`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()`

```php
flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet(): mixed
```

Healthcheck Flow Service

Vérifier la disponibilité du Flow Service

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet: ', $e->getMessage(), PHP_EOL;
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

## `searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost()`

```php
searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost(): mixed
```

Rechercher des flux

Rechercher des flux de facturation selon des critères (utilise le client_uid du JWT)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost: ', $e->getMessage(), PHP_EOL;
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

## `submitFlowProxyApiV1AfnorFlowV1FlowsPost()`

```php
submitFlowProxyApiV1AfnorFlowV1FlowsPost(): mixed
```

Soumettre un flux de facturation

Soumet une facture électronique à une Plateforme de Dématérialisation Partenaire (PDP) conformément à la norme AFNOR XP Z12-013

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->submitFlowProxyApiV1AfnorFlowV1FlowsPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->submitFlowProxyApiV1AfnorFlowV1FlowsPost: ', $e->getMessage(), PHP_EOL;
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
