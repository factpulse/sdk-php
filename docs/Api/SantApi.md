# FactPulse\SDK\SantApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**racineGet()**](SantApi.md#racineGet) | **GET** / | Vérifier l&#39;état de l&#39;API |


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
