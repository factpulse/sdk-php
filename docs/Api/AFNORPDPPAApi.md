# FactPulse\SDK\AFNORPDPPAApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet()**](AFNORPDPPAApi.md#getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet) | **GET** /api/v1/afnor/incoming-flows/{flow_id} | Retrieve and extract an incoming invoice |
| [**oauthTokenProxyApiV1AfnorOauthTokenPost()**](AFNORPDPPAApi.md#oauthTokenProxyApiV1AfnorOauthTokenPost) | **POST** /api/v1/afnor/oauth/token | Test PDP OAuth2 credentials |


## `getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet()`

```php
getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet($flow_id, $include_document, $x_encryption_key): \FactPulse\SDK\Model\IncomingInvoice
```

Retrieve and extract an incoming invoice

Downloads an incoming flow from the AFNOR PDP and extracts invoice metadata into a unified JSON format. Supports Factur-X, CII, and UBL formats.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORPDPPAApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$flow_id = 'flow_id_example'; // string | AFNOR flow ID (UUID format)
$include_document = false; // bool | Include base64-encoded document in response
$x_encryption_key = 'x_encryption_key_example'; // string | Client encryption key for double encryption mode. Must be a base64-encoded AES-256 key (32 bytes). Required only when accessing resources encrypted with encryption_mode='double'.

try {
    $result = $apiInstance->getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet($flow_id, $include_document, $x_encryption_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPAApi->getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **flow_id** | **string**| AFNOR flow ID (UUID format) | |
| **include_document** | **bool**| Include base64-encoded document in response | [optional] [default to false] |
| **x_encryption_key** | **string**| Client encryption key for double encryption mode. Must be a base64-encoded AES-256 key (32 bytes). Required only when accessing resources encrypted with encryption_mode&#x3D;&#39;double&#39;. | [optional] |

### Return type

[**\FactPulse\SDK\Model\IncomingInvoice**](../Model/IncomingInvoice.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

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

Test PDP OAuth2 credentials

OAuth2 proxy to validate PDP credentials. Use this endpoint to verify that OAuth credentials (client_id, client_secret) are valid before saving a PDP configuration. This endpoint is public (no authentication required).

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
