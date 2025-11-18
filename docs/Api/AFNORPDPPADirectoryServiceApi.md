# FactPulse\SDK\AFNORPDPPADirectoryServiceApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost()**](AFNORPDPPADirectoryServiceApi.md#createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost) | **POST** /api/v1/afnor/directory/v1/directory-line | Creating a directory line |
| [**createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost()**](AFNORPDPPADirectoryServiceApi.md#createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost) | **POST** /api/v1/afnor/directory/v1/routing-code | Create a routing code |
| [**deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete()**](AFNORPDPPADirectoryServiceApi.md#deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete) | **DELETE** /api/v1/afnor/directory/v1/directory-line/id-instance:{id_instance} | Delete a directory line |
| [**directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet()**](AFNORPDPPADirectoryServiceApi.md#directoryHealthcheckProxyApiV1AfnorDirectoryV1HealthcheckGet) | **GET** /api/v1/afnor/directory/v1/healthcheck | Healthcheck Directory Service |
| [**getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet()**](AFNORPDPPADirectoryServiceApi.md#getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet) | **GET** /api/v1/afnor/directory/v1/directory-line/code:{addressing_identifier} | Get a directory line |
| [**getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet()**](AFNORPDPPADirectoryServiceApi.md#getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet) | **GET** /api/v1/afnor/directory/v1/directory-line/id-instance:{id_instance} | Get a directory line |
| [**getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet()**](AFNORPDPPADirectoryServiceApi.md#getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet) | **GET** /api/v1/afnor/directory/v1/routing-code/id-instance:{id_instance} | Get a routing code by instance-id |
| [**getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet()**](AFNORPDPPADirectoryServiceApi.md#getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet) | **GET** /api/v1/afnor/directory/v1/routing-code/siret:{siret}/code:{routing_identifier} | Get a routing code by SIRET and routing identifier |
| [**getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet()**](AFNORPDPPADirectoryServiceApi.md#getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet) | **GET** /api/v1/afnor/directory/v1/siren/code-insee:{siren} | Consult a siren (legal unit) by SIREN number |
| [**getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet()**](AFNORPDPPADirectoryServiceApi.md#getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet) | **GET** /api/v1/afnor/directory/v1/siren/id-instance:{id_instance} | Gets a siren (legal unit) by instance ID |
| [**getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet()**](AFNORPDPPADirectoryServiceApi.md#getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet) | **GET** /api/v1/afnor/directory/v1/siret/code-insee:{siret} | Gets a siret (facility) by SIRET number |
| [**getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet()**](AFNORPDPPADirectoryServiceApi.md#getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet) | **GET** /api/v1/afnor/directory/v1/siret/id-instance:{id_instance} | Gets a siret (facility) by id-instance |
| [**patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch()**](AFNORPDPPADirectoryServiceApi.md#patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch) | **PATCH** /api/v1/afnor/directory/v1/directory-line/id-instance:{id_instance} | Partially updates a directory line |
| [**patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch()**](AFNORPDPPADirectoryServiceApi.md#patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch) | **PATCH** /api/v1/afnor/directory/v1/routing-code/id-instance:{id_instance} | Partially update a private routing code |
| [**putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut()**](AFNORPDPPADirectoryServiceApi.md#putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut) | **PUT** /api/v1/afnor/directory/v1/routing-code/id-instance:{id_instance} | Completely update a private routing code |
| [**searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost) | **POST** /api/v1/afnor/directory/v1/directory-line/search | Search for a directory line |
| [**searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost) | **POST** /api/v1/afnor/directory/v1/routing-code/search | Search for a routing code |
| [**searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost) | **POST** /api/v1/afnor/directory/v1/siren/search | SIREN search (or legal unit) |
| [**searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost()**](AFNORPDPPADirectoryServiceApi.md#searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost) | **POST** /api/v1/afnor/directory/v1/siret/search | Search for a SIRET (facility) |


## `createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost()`

```php
createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost(): mixed
```

Creating a directory line

Créer une ligne dans l'annuaire

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
    $result = $apiInstance->createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->createDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLinePost: ', $e->getMessage(), PHP_EOL;
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

## `createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost()`

```php
createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost(): mixed
```

Create a routing code

Créer un code de routage dans l'annuaire

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
    $result = $apiInstance->createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->createRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodePost: ', $e->getMessage(), PHP_EOL;
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

## `deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete()`

```php
deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete($id_instance): mixed
```

Delete a directory line

Supprimer une ligne d'annuaire

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->deleteDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet()`

```php
getDirectoryLineByCodeProxyApiV1AfnorDirectoryV1DirectoryLineCodeAddressingIdentifierGet($addressing_identifier): mixed
```

Get a directory line

Obtenir une ligne d'annuaire identifiée par un identifiant d'adressage

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$addressing_identifier = 'addressing_identifier_example'; // string

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
| **addressing_identifier** | **string**|  | |

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

## `getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet()`

```php
getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet($id_instance): mixed
```

Get a directory line

Obtenir une ligne d'annuaire identifiée par son idInstance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getDirectoryLineByIdInstanceProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstanceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet()`

```php
getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet($id_instance): mixed
```

Get a routing code by instance-id

Obtenir un code de routage identifié par son idInstance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getRoutingCodeByIdInstanceProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstanceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet()`

```php
getRoutingCodeBySiretAndCodeProxyApiV1AfnorDirectoryV1RoutingCodeSiretSiretCodeRoutingIdentifierGet($siret, $routing_identifier): mixed
```

Get a routing code by SIRET and routing identifier

Consulter un code de routage identifié par SIRET et identifiant de routage

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siret = 'siret_example'; // string
$routing_identifier = 'routing_identifier_example'; // string

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
| **siret** | **string**|  | |
| **routing_identifier** | **string**|  | |

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

## `getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet()`

```php
getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet($siren): mixed
```

Consult a siren (legal unit) by SIREN number

Retourne les détails d'une entreprise (unité légale) identifiée par son numéro SIREN

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
    $result = $apiInstance->getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet($siren);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getSirenByCodeInseeProxyApiV1AfnorDirectoryV1SirenCodeInseeSirenGet: ', $e->getMessage(), PHP_EOL;
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

## `getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet()`

```php
getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet($id_instance): mixed
```

Gets a siren (legal unit) by instance ID

Obtenir une entreprise (unité légale) identifiée par son idInstance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getSirenByIdInstanceProxyApiV1AfnorDirectoryV1SirenIdInstanceIdInstanceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet()`

```php
getSiretByCodeInseeProxyApiV1AfnorDirectoryV1SiretCodeInseeSiretGet($siret): mixed
```

Gets a siret (facility) by SIRET number

Obtenir un établissement identifié par son numéro SIRET

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$siret = 'siret_example'; // string

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
| **siret** | **string**|  | |

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

## `getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet()`

```php
getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet($id_instance): mixed
```

Gets a siret (facility) by id-instance

Obtenir un établissement identifié par son idInstance

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->getSiretByIdInstanceProxyApiV1AfnorDirectoryV1SiretIdInstanceIdInstanceGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch()`

```php
patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch($id_instance): mixed
```

Partially updates a directory line

Mettre à jour partiellement une ligne d'annuaire

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->patchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineIdInstanceIdInstancePatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch()`

```php
patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch($id_instance): mixed
```

Partially update a private routing code

Mettre à jour partiellement un code de routage privé

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->patchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut()`

```php
putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut($id_instance): mixed
```

Completely update a private routing code

Mettre à jour complètement un code de routage privé

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\AFNORPDPPADirectoryServiceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$id_instance = 'id_instance_example'; // string

try {
    $result = $apiInstance->putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut($id_instance);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AFNORPDPPADirectoryServiceApi->putRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeIdInstanceIdInstancePut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_instance** | **string**|  | |

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

## `searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost()`

```php
searchDirectoryLineProxyApiV1AfnorDirectoryV1DirectoryLineSearchPost(): mixed
```

Search for a directory line

Rechercher des lignes d'annuaire selon des critères

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

**mixed**

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
searchRoutingCodeProxyApiV1AfnorDirectoryV1RoutingCodeSearchPost(): mixed
```

Search for a routing code

Rechercher des codes de routage selon des critères

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

**mixed**

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
searchSirenProxyApiV1AfnorDirectoryV1SirenSearchPost(): mixed
```

SIREN search (or legal unit)

Recherche multi-critères d'entreprises (unités légales)

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

**mixed**

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
searchSiretProxyApiV1AfnorDirectoryV1SiretSearchPost(): mixed
```

Search for a SIRET (facility)

Recherche multi-critères d'établissements

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

**mixed**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
