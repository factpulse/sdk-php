# FactPulse\SDK\AFNORPDPPAFlowServiceApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()**](AFNORPDPPAFlowServiceApi.md#downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet) | **GET** /api/v1/afnor/flow/v1/flows/{flowId} | Download a flow |
| [**flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()**](AFNORPDPPAFlowServiceApi.md#flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet) | **GET** /api/v1/afnor/flow/v1/healthcheck | Healthcheck Flow Service |
| [**searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost()**](AFNORPDPPAFlowServiceApi.md#searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost) | **POST** /api/v1/afnor/flow/v1/flows/search | Search flows |
| [**submitFlowProxyApiV1AfnorFlowV1FlowsPost()**](AFNORPDPPAFlowServiceApi.md#submitFlowProxyApiV1AfnorFlowV1FlowsPost) | **POST** /api/v1/afnor/flow/v1/flows | Submit an invoicing flow |


## `downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()`

```php
downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet($flow_id, $doc_type): \FactPulse\SDK\Model\AFNORFlow
```

Download a flow

Download a file related to a given flow (AFNOR XP Z12-013 compliant): - Metadata [Default]: provides the flow metadata as JSON - Original: the document initially sent by the emitter - Converted: the document optionally converted by the system - ReadableView: the document optionally generated as readable file

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$flow_id = 'flow_id_example'; // string | AFNOR flow identifier (UUID)
$doc_type = new \FactPulse\SDK\Model\\FactPulseSDKModelDocType(); // \FactPulseSDKModelDocType | Type of file to download: Metadata (default, JSON), Original, Converted, or ReadableView

try {
    $result = $apiInstance->downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet($flow_id, $doc_type);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **flow_id** | **string**| AFNOR flow identifier (UUID) | |
| **doc_type** | [**\FactPulseSDKModelDocType**](../Model/.md)| Type of file to download: Metadata (default, JSON), Original, Converted, or ReadableView | [optional] |

### Return type

[**\FactPulse\SDK\Model\AFNORFlow**](../Model/AFNORFlow.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`, `application/pdf`, `application/xml`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()`

```php
flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet(): object
```

Healthcheck Flow Service

Check Flow Service availability (AFNOR XP Z12-013 compliant)

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

**object**

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
searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost($afnor_search_flow_params): \FactPulse\SDK\Model\AFNORSearchFlowContent
```

Search flows

Search invoicing flows by criteria (AFNOR XP Z12-013 compliant)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$afnor_search_flow_params = new \FactPulse\SDK\Model\AFNORSearchFlowParams(); // \FactPulse\SDK\Model\AFNORSearchFlowParams

try {
    $result = $apiInstance->searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost($afnor_search_flow_params);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **afnor_search_flow_params** | [**\FactPulse\SDK\Model\AFNORSearchFlowParams**](../Model/AFNORSearchFlowParams.md)|  | |

### Return type

[**\FactPulse\SDK\Model\AFNORSearchFlowContent**](../Model/AFNORSearchFlowContent.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitFlowProxyApiV1AfnorFlowV1FlowsPost()`

```php
submitFlowProxyApiV1AfnorFlowV1FlowsPost($flow_info, $file): mixed
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
$flow_info = new \FactPulse\SDK\Model\AFNORFlowInfo(); // \FactPulse\SDK\Model\AFNORFlowInfo
$file = '/path/to/file.txt'; // \SplFileObject | Flow file (PDF/A-3 with embedded XML or XML)

try {
    $result = $apiInstance->submitFlowProxyApiV1AfnorFlowV1FlowsPost($flow_info, $file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->submitFlowProxyApiV1AfnorFlowV1FlowsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **flow_info** | [**\FactPulse\SDK\Model\AFNORFlowInfo**](../Model/AFNORFlowInfo.md)|  | |
| **file** | **\SplFileObject****\SplFileObject**| Flow file (PDF/A-3 with embedded XML or XML) | |

### Return type

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
