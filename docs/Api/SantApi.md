# FactPulse\SDK\SantApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**healthcheckHealthcheckGet()**](SantApi.md#healthcheckHealthcheckGet) | **GET** /healthcheck | Endpoint de healthcheck pour Docker |
| [**racineGet()**](SantApi.md#racineGet) | **GET** / | Vérifier l&#39;état de l&#39;API |


## `healthcheckHealthcheckGet()`

```php
healthcheckHealthcheckGet(): mixed
```

Endpoint de healthcheck pour Docker

Endpoint de healthcheck pour Docker et les load balancers.  Utile pour : - Docker healthcheck - Kubernetes liveness/readiness probes - Load balancers (Nginx, HAProxy) - Monitoring de disponibilité - Déploiement zero downtime  Retourne un code 200 si l'API est opérationnelle.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\SantApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->healthcheckHealthcheckGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SantApi->healthcheckHealthcheckGet: ', $e->getMessage(), PHP_EOL;
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

## `racineGet()`

```php
racineGet(): mixed
```

Vérifier l'état de l'API

Endpoint de health check pour vérifier que l'API répond.  Utile pour : - Monitoring de disponibilité - Tests d'intégration - Load balancers

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\SantApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->racineGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SantApi->racineGet: ', $e->getMessage(), PHP_EOL;
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
