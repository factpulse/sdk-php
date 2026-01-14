# FactPulse\SDK\HealthApi

## Endpoints de santé  Vérification de la disponibilité et du bon fonctionnement des services.  ### Endpoints  - &#x60;GET /&#x60; : Vérification rapide du statut API - &#x60;GET /healthcheck&#x60; : Healthcheck Docker/Kubernetes

All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**healthcheckHealthcheckGet()**](HealthApi.md#healthcheckHealthcheckGet) | **GET** /healthcheck | Docker healthcheck endpoint |
| [**rootGet()**](HealthApi.md#rootGet) | **GET** / | Check API status |


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
