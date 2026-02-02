# FactPulse\SDK\HealthApi

## 🏥 Health &amp; Status  **Endpoints for checking service availability and health.**  ### Endpoints  - &#x60;GET /&#x60;: Quick API status check - &#x60;GET /healthcheck&#x60;: Docker/Kubernetes healthcheck - &#x60;GET /api/v1/me&#x60;: Current user info and quota

All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getUserInfoApiV1MeGet()**](HealthApi.md#getUserInfoApiV1MeGet) | **GET** /api/v1/me | Get current user information |
| [**healthcheckHealthcheckGet()**](HealthApi.md#healthcheckHealthcheckGet) | **GET** /healthcheck | Docker healthcheck endpoint |
| [**rootGet()**](HealthApi.md#rootGet) | **GET** / | Check API status |


## `getUserInfoApiV1MeGet()`

```php
getUserInfoApiV1MeGet(): mixed
```

Get current user information

Returns information about the authenticated user.  This endpoint allows you to: - Verify that authentication works - Get connected account details - Test JWT token validity - Check your consumption quota  **Requires valid authentication.**

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


$apiInstance = new FactPulse\SDK\Api\HealthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getUserInfoApiV1MeGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HealthApi->getUserInfoApiV1MeGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `healthcheckHealthcheckGet()`

```php
healthcheckHealthcheckGet(): mixed
```

Docker healthcheck endpoint

Healthcheck endpoint for Docker and load balancers.  Useful for: - Docker healthcheck - Kubernetes liveness/readiness probes - Load balancers (Nginx, HAProxy) - Availability monitoring - Zero downtime deployment  Returns a 200 code if the API is operational.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\HealthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->healthcheckHealthcheckGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HealthApi->healthcheckHealthcheckGet: ', $e->getMessage(), PHP_EOL;
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

## `rootGet()`

```php
rootGet(): mixed
```

Check API status

Health check endpoint to verify the API is responding.  Useful for: - Availability monitoring - Integration tests - Load balancers

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\HealthApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->rootGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling HealthApi->rootGet: ', $e->getMessage(), PHP_EOL;
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
