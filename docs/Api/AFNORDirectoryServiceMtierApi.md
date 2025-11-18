# FactPulse\SDK\AFNORDirectoryServiceMtierApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getSirenMetierApiV1AfnorDirectorySirenSirenGet()**](AFNORDirectoryServiceMtierApi.md#getSirenMetierApiV1AfnorDirectorySirenSirenGet) | **GET** /api/v1/afnor/directory/siren/{siren} | Récupérer une entreprise par SIREN (multi-tenant) |
| [**getSiretMetierApiV1AfnorDirectorySiretSiretGet()**](AFNORDirectoryServiceMtierApi.md#getSiretMetierApiV1AfnorDirectorySiretSiretGet) | **GET** /api/v1/afnor/directory/siret/{siret} | Récupérer un établissement par SIRET (multi-tenant) |
| [**searchSirenMetierApiV1AfnorDirectorySirenSearchPost()**](AFNORDirectoryServiceMtierApi.md#searchSirenMetierApiV1AfnorDirectorySirenSearchPost) | **POST** /api/v1/afnor/directory/siren/search | Rechercher des entreprises (multi-tenant) |
| [**searchSiretMetierApiV1AfnorDirectorySiretSearchPost()**](AFNORDirectoryServiceMtierApi.md#searchSiretMetierApiV1AfnorDirectorySiretSearchPost) | **POST** /api/v1/afnor/directory/siret/search | Rechercher des établissements (multi-tenant) |


## `getSirenMetierApiV1AfnorDirectorySirenSirenGet()`

```php
getSirenMetierApiV1AfnorDirectorySirenSirenGet($siren, $pdp_credentials): mixed
```

Récupérer une entreprise par SIREN (multi-tenant)

Récupère les informations d'une entreprise dans le Directory Service AFNOR. Les credentials PDP sont récupérés automatiquement via le client_uid du JWT, ou peuvent être fournis directement dans le body (zero-storage).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORDirectoryServiceMtierApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$siren = 'siren_example'; // string
$pdp_credentials = new \FactPulse\SDK\Model\PDPCredentials(); // \FactPulse\SDK\Model\PDPCredentials

try {
    $result = $apiInstance->getSirenMetierApiV1AfnorDirectorySirenSirenGet($siren, $pdp_credentials);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORDirectoryServiceMtierApi->getSirenMetierApiV1AfnorDirectorySirenSirenGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siren** | **string**|  | |
| **pdp_credentials** | [**\FactPulse\SDK\Model\PDPCredentials**](../Model/PDPCredentials.md)|  | [optional] |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSiretMetierApiV1AfnorDirectorySiretSiretGet()`

```php
getSiretMetierApiV1AfnorDirectorySiretSiretGet($siret, $pdp_credentials): mixed
```

Récupérer un établissement par SIRET (multi-tenant)

Récupère les informations d'un établissement dans le Directory Service AFNOR. Les credentials PDP sont récupérés automatiquement via le client_uid du JWT, ou peuvent être fournis directement dans le body (zero-storage).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORDirectoryServiceMtierApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$siret = 'siret_example'; // string
$pdp_credentials = new \FactPulse\SDK\Model\PDPCredentials(); // \FactPulse\SDK\Model\PDPCredentials

try {
    $result = $apiInstance->getSiretMetierApiV1AfnorDirectorySiretSiretGet($siret, $pdp_credentials);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORDirectoryServiceMtierApi->getSiretMetierApiV1AfnorDirectorySiretSiretGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **siret** | **string**|  | |
| **pdp_credentials** | [**\FactPulse\SDK\Model\PDPCredentials**](../Model/PDPCredentials.md)|  | [optional] |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchSirenMetierApiV1AfnorDirectorySirenSearchPost()`

```php
searchSirenMetierApiV1AfnorDirectorySirenSearchPost($body_search_siren_metier_api_v1_afnor_directory_siren_search_post): mixed
```

Rechercher des entreprises (multi-tenant)

Recherche multi-critères d'entreprises dans le Directory Service AFNOR. Les credentials PDP sont récupérés automatiquement via le client_uid du JWT, ou peuvent être fournis directement dans le body (zero-storage).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORDirectoryServiceMtierApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_search_siren_metier_api_v1_afnor_directory_siren_search_post = new \FactPulse\SDK\Model\BodySearchSirenMetierApiV1AfnorDirectorySirenSearchPost(); // \FactPulse\SDK\Model\BodySearchSirenMetierApiV1AfnorDirectorySirenSearchPost

try {
    $result = $apiInstance->searchSirenMetierApiV1AfnorDirectorySirenSearchPost($body_search_siren_metier_api_v1_afnor_directory_siren_search_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORDirectoryServiceMtierApi->searchSirenMetierApiV1AfnorDirectorySirenSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_search_siren_metier_api_v1_afnor_directory_siren_search_post** | [**\FactPulse\SDK\Model\BodySearchSirenMetierApiV1AfnorDirectorySirenSearchPost**](../Model/BodySearchSirenMetierApiV1AfnorDirectorySirenSearchPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `searchSiretMetierApiV1AfnorDirectorySiretSearchPost()`

```php
searchSiretMetierApiV1AfnorDirectorySiretSearchPost($body_search_siret_metier_api_v1_afnor_directory_siret_search_post): mixed
```

Rechercher des établissements (multi-tenant)

Recherche multi-critères d'établissements dans le Directory Service AFNOR. Les credentials PDP sont récupérés automatiquement via le client_uid du JWT, ou peuvent être fournis directement dans le body (zero-storage).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\AFNORDirectoryServiceMtierApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_search_siret_metier_api_v1_afnor_directory_siret_search_post = new \FactPulse\SDK\Model\BodySearchSiretMetierApiV1AfnorDirectorySiretSearchPost(); // \FactPulse\SDK\Model\BodySearchSiretMetierApiV1AfnorDirectorySiretSearchPost

try {
    $result = $apiInstance->searchSiretMetierApiV1AfnorDirectorySiretSearchPost($body_search_siret_metier_api_v1_afnor_directory_siret_search_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORDirectoryServiceMtierApi->searchSiretMetierApiV1AfnorDirectorySiretSearchPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_search_siret_metier_api_v1_afnor_directory_siret_search_post** | [**\FactPulse\SDK\Model\BodySearchSiretMetierApiV1AfnorDirectorySiretSearchPost**](../Model/BodySearchSiretMetierApiV1AfnorDirectorySiretSearchPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
