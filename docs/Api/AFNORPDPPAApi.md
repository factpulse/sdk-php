# FactPulse\SDK\AFNORPDPPAApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getAfnorCredentialsApiV1AfnorCredentialsGet()**](AFNORPDPPAApi.md#getAfnorCredentialsApiV1AfnorCredentialsGet) | **GET** /api/v1/afnor/credentials | Retrieve stored AFNOR credentials |
| [**getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet()**](AFNORPDPPAApi.md#getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet) | **GET** /api/v1/afnor/incoming-flows/{flow_id} | Retrieve and extract an incoming invoice |
| [**oauthTokenProxyApiV1AfnorOauthTokenPost()**](AFNORPDPPAApi.md#oauthTokenProxyApiV1AfnorOauthTokenPost) | **POST** /api/v1/afnor/oauth/token | OAuth2 endpoint for AFNOR authentication |


## `getAfnorCredentialsApiV1AfnorCredentialsGet()`

```php
getAfnorCredentialsApiV1AfnorCredentialsGet(): mixed
```

Retrieve stored AFNOR credentials

Retrieves stored AFNOR/PDP credentials for the JWT's client_uid. This endpoint is used by the SDK in 'stored' mode to retrieve credentials before performing AFNOR OAuth itself.

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

## `getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet()`

```php
getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet($flow_id, $include_document): \FactPulse\SDK\Model\IncomingInvoice
```

Retrieve and extract an incoming invoice

Downloads an incoming flow from the AFNOR PDP and extracts invoice metadata into a unified JSON format. Supports Factur-X, CII, and UBL formats.

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
$flow_id = 'flow_id_example'; // string | AFNOR flow ID (UUID format)
$include_document = false; // bool | Include base64-encoded document in response

try {
    $result = $apiInstance->getFluxEntrantApiV1AfnorIncomingFlowsFlowIdGet($flow_id, $include_document);
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

### Return type

[**\FactPulse\SDK\Model\IncomingInvoice**](../Model/IncomingInvoice.md)

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

OAuth2 endpoint for AFNOR authentication

OAuth2 proxy endpoint to obtain an AFNOR access token. Proxies to AFNOR mock (sandbox) or real PDP depending on MOCK_AFNOR_BASE_URL. This endpoint is public (no Django auth required) as it is called by the AFNOR SDK.

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
