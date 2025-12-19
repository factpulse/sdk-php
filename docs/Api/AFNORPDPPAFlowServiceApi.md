# FactPulse\SDK\AFNORPDPPAFlowServiceApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()**](AFNORPDPPAFlowServiceApi.md#downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet) | **GET** /api/v1/afnor/flow/v1/flows/{flowId} | Download a flow |
| [**flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()**](AFNORPDPPAFlowServiceApi.md#flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet) | **GET** /api/v1/afnor/flow/v1/healthcheck | Healthcheck Flow Service |
| [**searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost()**](AFNORPDPPAFlowServiceApi.md#searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost) | **POST** /api/v1/afnor/flow/v1/flows/search | Search flows |
| [**submitFlowProxyApiV1AfnorFlowV1FlowsPost()**](AFNORPDPPAFlowServiceApi.md#submitFlowProxyApiV1AfnorFlowV1FlowsPost) | **POST** /api/v1/afnor/flow/v1/flows | Submit an invoicing flow |


## `downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()`

```php
downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet($flow_id): mixed
```

Download a flow

Download the PDF/A-3 file of an invoicing flow (uses JWT client_uid)

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

Check Flow Service availability

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

Search flows

Search invoicing flows by criteria (uses JWT client_uid)

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

Submit an invoicing flow

Submits an electronic invoice to a Partner Dematerialization Platform (PDP) in compliance with the AFNOR XP Z12-013 standard

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
