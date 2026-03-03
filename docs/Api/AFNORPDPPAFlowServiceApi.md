# FactPulse\SDK\AFNORPDPPAFlowServiceApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createWebhookProxyApiV1AfnorFlowV1WebhooksPost()**](AFNORPDPPAFlowServiceApi.md#createWebhookProxyApiV1AfnorFlowV1WebhooksPost) | **POST** /api/v1/afnor/flow/v1/webhooks | Create a webhook |
| [**deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete()**](AFNORPDPPAFlowServiceApi.md#deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete) | **DELETE** /api/v1/afnor/flow/v1/webhooks/{webhookUid} | Delete a webhook |
| [**downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet()**](AFNORPDPPAFlowServiceApi.md#downloadFlowProxyApiV1AfnorFlowV1FlowsFlowIdGet) | **GET** /api/v1/afnor/flow/v1/flows/{flowId} | Download a flow |
| [**flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet()**](AFNORPDPPAFlowServiceApi.md#flowHealthcheckProxyApiV1AfnorFlowV1HealthcheckGet) | **GET** /api/v1/afnor/flow/v1/healthcheck | Healthcheck Flow Service |
| [**getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet()**](AFNORPDPPAFlowServiceApi.md#getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet) | **GET** /api/v1/afnor/flow/v1/webhooks/{webhookUid} | Get a webhook |
| [**listWebhooksProxyApiV1AfnorFlowV1WebhooksGet()**](AFNORPDPPAFlowServiceApi.md#listWebhooksProxyApiV1AfnorFlowV1WebhooksGet) | **GET** /api/v1/afnor/flow/v1/webhooks | List webhooks |
| [**searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost()**](AFNORPDPPAFlowServiceApi.md#searchFlowsProxyApiV1AfnorFlowV1FlowsSearchPost) | **POST** /api/v1/afnor/flow/v1/flows/search | Search flows |
| [**submitFlowProxyApiV1AfnorFlowV1FlowsPost()**](AFNORPDPPAFlowServiceApi.md#submitFlowProxyApiV1AfnorFlowV1FlowsPost) | **POST** /api/v1/afnor/flow/v1/flows | Submit an invoicing flow |
| [**updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch()**](AFNORPDPPAFlowServiceApi.md#updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch) | **PATCH** /api/v1/afnor/flow/v1/webhooks/{webhookUid} | Update a webhook |


## `createWebhookProxyApiV1AfnorFlowV1WebhooksPost()`

```php
createWebhookProxyApiV1AfnorFlowV1WebhooksPost(): mixed
```

Create a webhook

Register a new webhook subscription (AFNOR XP Z12-013 v1.2.0)

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
    $result = $apiInstance->createWebhookProxyApiV1AfnorFlowV1WebhooksPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->createWebhookProxyApiV1AfnorFlowV1WebhooksPost: ', $e->getMessage(), PHP_EOL;
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

## `deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete()`

```php
deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete($webhook_uid): mixed
```

Delete a webhook

Delete a webhook subscription (AFNOR XP Z12-013 v1.2.0)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$webhook_uid = 'webhook_uid_example'; // string | Webhook unique identifier (UUID)

try {
    $result = $apiInstance->deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete($webhook_uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->deleteWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_uid** | **string**| Webhook unique identifier (UUID) | |

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

## `getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet()`

```php
getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet($webhook_uid): \FactPulse\SDK\Model\AFNORWebhook
```

Get a webhook

Get details of a specific webhook (AFNOR XP Z12-013 v1.2.0)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$webhook_uid = 'webhook_uid_example'; // string | Webhook unique identifier (UUID)

try {
    $result = $apiInstance->getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet($webhook_uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->getWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_uid** | **string**| Webhook unique identifier (UUID) | |

### Return type

[**\FactPulse\SDK\Model\AFNORWebhook**](../Model/AFNORWebhook.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listWebhooksProxyApiV1AfnorFlowV1WebhooksGet()`

```php
listWebhooksProxyApiV1AfnorFlowV1WebhooksGet(): \FactPulse\SDK\Model\AFNORWebhook[]
```

List webhooks

List all registered webhooks (AFNOR XP Z12-013 v1.2.0)

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
    $result = $apiInstance->listWebhooksProxyApiV1AfnorFlowV1WebhooksGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->listWebhooksProxyApiV1AfnorFlowV1WebhooksGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\AFNORWebhook[]**](../Model/AFNORWebhook.md)

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

## `updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch()`

```php
updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch($webhook_uid): \FactPulse\SDK\Model\AFNORWebhook
```

Update a webhook

Partially update a webhook subscription (AFNOR XP Z12-013 v1.2.0)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAFlowServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$webhook_uid = 'webhook_uid_example'; // string | Webhook unique identifier (UUID)

try {
    $result = $apiInstance->updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch($webhook_uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAFlowServiceApi->updateWebhookProxyApiV1AfnorFlowV1WebhooksWebhookUidPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **webhook_uid** | **string**| Webhook unique identifier (UUID) | |

### Return type

[**\FactPulse\SDK\Model\AFNORWebhook**](../Model/AFNORWebhook.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
