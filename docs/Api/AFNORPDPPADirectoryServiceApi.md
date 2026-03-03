# FactPulse\SDK\AFNORPDPPADirectoryServiceApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet()**](AFNORPDPPADirectoryServiceApi.md#directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet) | **GET** /api/v1/afnor/directory/v1/healthcheck | Healthcheck Directory Service |
| [**getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet()**](AFNORPDPPADirectoryServiceApi.md#getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet) | **GET** /api/v1/afnor/directory/v1/directory-line/code:{addressing_identifier} | Get a directory line. |
| [**getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet()**](AFNORPDPPADirectoryServiceApi.md#getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet) | **GET** /api/v1/afnor/directory/v1/routing-code/siret:{siret}/code:{routing_identifier} | Get a routing code by SIRET and routing identifier |
| [**getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet()**](AFNORPDPPADirectoryServiceApi.md#getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet) | **GET** /api/v1/afnor/directory/v1/siren/code-insee:{siren} | Consult a siren (legal unit) by SIREN number |
| [**getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet()**](AFNORPDPPADirectoryServiceApi.md#getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet) | **GET** /api/v1/afnor/directory/v1/siret/code-insee:{siret} | Gets a siret (facility) by SIRET number |
| [**searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost) | **POST** /api/v1/afnor/directory/v1/directory-line/search | Search for a directory line |
| [**searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost) | **POST** /api/v1/afnor/directory/v1/routing-code/search | Search for a routing code |
| [**searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost) | **POST** /api/v1/afnor/directory/v1/siren/search | SIREN search (or legal unit) |
| [**searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost) | **POST** /api/v1/afnor/directory/v1/siret/search | Search for a SIRET (facility) |


## `directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet()`

```php
directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet(): object
```

Healthcheck Directory Service

Check Directory Service availability (AFNOR XP Z12-013 compliant)

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

**object**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet()`

```php
getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet($addressing_identifier): \FactPulse\SDK\Model\AFNORDirectoryLinePayloadLegalUnitFacilityRoutingCode
```

Get a directory line.

Retrieve the data from the directory line corresponding to the identifier passed in parameters.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$addressing_identifier = 'addressing_identifier_example'; // string | Addressing identifier (SIREN, SIRET or routing code)

try {
    $result = $apiInstance->getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet($addressing_identifier);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **addressing_identifier** | **string**| Addressing identifier (SIREN, SIRET or routing code) | |

### Return type

[**\FactPulse\SDK\Model\AFNORDirectoryLinePayloadLegalUnitFacilityRoutingCode**](../Model/AFNORDirectoryLinePayloadLegalUnitFacilityRoutingCode.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet()`

```php
getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet($siret, $routing_identifier): \FactPulse\SDK\Model\AFNORRoutingCodePayloadHistoryLegalUnitFacility
```

Get a routing code by SIRET and routing identifier

Retrieve the Routing Code data corresponding to the identifier passed in parameters.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siret = 'siret_example'; // string | 14-digit SIRET number (INSEE establishment identifier)
$routing_identifier = 'routing_identifier_example'; // string | Routing code identifier

try {
    $result = $apiInstance->getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet($siret, $routing_identifier);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siret** | **string**| 14-digit SIRET number (INSEE establishment identifier) | |
| **routing_identifier** | **string**| Routing code identifier | |

### Return type

[**\FactPulse\SDK\Model\AFNORRoutingCodePayloadHistoryLegalUnitFacility**](../Model/AFNORRoutingCodePayloadHistoryLegalUnitFacility.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet()`

```php
getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet($siren): \FactPulse\SDK\Model\AFNORLegalUnitPayloadHistory
```

Consult a siren (legal unit) by SIREN number

Returns the details of a company (legal unit) identified by the SIREN number passed as a parameter.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siren = 'siren_example'; // string | 9-digit SIREN number (INSEE company identifier)

try {
    $result = $apiInstance->getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet($siren);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siren** | **string**| 9-digit SIREN number (INSEE company identifier) | |

### Return type

[**\FactPulse\SDK\Model\AFNORLegalUnitPayloadHistory**](../Model/AFNORLegalUnitPayloadHistory.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet()`

```php
getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet($siret): \FactPulse\SDK\Model\AFNORFacilityPayloadHistory
```

Gets a siret (facility) by SIRET number

Returns the details of a facility associated to a SIRET.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siret = 'siret_example'; // string | 14-digit SIRET number (INSEE establishment identifier)

try {
    $result = $apiInstance->getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet($siret);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siret** | **string**| 14-digit SIRET number (INSEE establishment identifier) | |

### Return type

[**\FactPulse\SDK\Model\AFNORFacilityPayloadHistory**](../Model/AFNORFacilityPayloadHistory.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost()`

```php
searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost(): \FactPulse\SDK\Model\AFNORDirectoryLineSearchPost200Response
```

Search for a directory line

Search for directory lines that meet all the criteria passed as parameters and return the results in the desired format.

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
    $result = $apiInstance->searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\AFNORDirectoryLineSearchPost200Response**](../Model/AFNORDirectoryLineSearchPost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost()`

```php
searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost(): \FactPulse\SDK\Model\AFNORRoutingCodeSearchPost200Response
```

Search for a routing code

Search for routing codes that meet all the criteria passed as parameters and return the routing codes in the desired format.

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
    $result = $apiInstance->searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\AFNORRoutingCodeSearchPost200Response**](../Model/AFNORRoutingCodeSearchPost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost()`

```php
searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost(): \FactPulse\SDK\Model\AFNORSirenSearchPost200Response
```

SIREN search (or legal unit)

Multi-criteria company search.

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
    $result = $apiInstance->searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\AFNORSirenSearchPost200Response**](../Model/AFNORSirenSearchPost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost()`

```php
searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost(): \FactPulse\SDK\Model\AFNORSiretSearchPost200Response
```

Search for a SIRET (facility)

Multi-criteria search for facilities.

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
    $result = $apiInstance->searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\AFNORSiretSearchPost200Response**](../Model/AFNORSiretSearchPost200Response.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
