# FactPulse\SDK\AFNORPDPPADirectoryServiceApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet()**](AFNORPDPPADirectoryServiceApi.md#directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet) | **GET** /api/v1/afnor/directory/v1/healthcheck | Healthcheck Directory Service |
| [**getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet()**](AFNORPDPPADirectoryServiceApi.md#getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet) | **GET** /api/v1/afnor/directory/v1/companies/{siren} | Récupérer une entreprise |
| [**searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost) | **POST** /api/v1/afnor/directory/v1/companies/search | Rechercher des entreprises |


## `directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet()`

```php
directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet(): mixed
```

Healthcheck Directory Service

Vérifier la disponibilité du Directory Service

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet: ', $e->getMessage(), PHP_EOL;
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

## `getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet()`

```php
getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet($siren): mixed
```

Récupérer une entreprise

Récupérer les informations d'une entreprise par son SIREN

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siren = 'siren_example'; // string

try {
    $result = $apiInstance->getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet($siren);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getCompanyProxyApiV1AfnorDirectoryV1CompaniesSirenGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siren** | **string**|  | |

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

## `searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost()`

```php
searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost(): mixed
```

Rechercher des entreprises

Rechercher des entreprises dans l'annuaire AFNOR

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->searchCompaniesProxyApiV1AfnorDirectoryV1CompaniesSearchPost: ', $e->getMessage(), PHP_EOL;
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
