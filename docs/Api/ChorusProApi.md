# FactPulse\SDK\ChorusProApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**ajouterFichierApiV1ChorusProTransversesAjouterFichierPost()**](ChorusProApi.md#ajouterFichierApiV1ChorusProTransversesAjouterFichierPost) | **POST** /api/v1/chorus-pro/transverses/ajouter-fichier | Add an attachment |
| [**completerFactureApiV1ChorusProFacturesCompleterPost()**](ChorusProApi.md#completerFactureApiV1ChorusProFacturesCompleterPost) | **POST** /api/v1/chorus-pro/factures/completer | Complete a suspended invoice (Supplier) |
| [**consulterFactureApiV1ChorusProFacturesConsulterPost()**](ChorusProApi.md#consulterFactureApiV1ChorusProFacturesConsulterPost) | **POST** /api/v1/chorus-pro/factures/consulter | Consult invoice status |
| [**consulterStructureApiV1ChorusProStructuresConsulterPost()**](ChorusProApi.md#consulterStructureApiV1ChorusProStructuresConsulterPost) | **POST** /api/v1/chorus-pro/structures/consulter | Consult structure details |
| [**listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet()**](ChorusProApi.md#listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet) | **GET** /api/v1/chorus-pro/structures/{id_structure_cpp}/services | List structure services |
| [**obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost()**](ChorusProApi.md#obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost) | **POST** /api/v1/chorus-pro/structures/obtenir-id-depuis-siret | Utility: Get Chorus Pro ID from SIRET |
| [**rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost()**](ChorusProApi.md#rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost) | **POST** /api/v1/chorus-pro/factures/rechercher-destinataire | Search received invoices (Recipient) |
| [**rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost()**](ChorusProApi.md#rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost) | **POST** /api/v1/chorus-pro/factures/rechercher-fournisseur | Search issued invoices (Supplier) |
| [**rechercherStructuresApiV1ChorusProStructuresRechercherPost()**](ChorusProApi.md#rechercherStructuresApiV1ChorusProStructuresRechercherPost) | **POST** /api/v1/chorus-pro/structures/rechercher | Search Chorus Pro structures |
| [**recyclerFactureApiV1ChorusProFacturesRecyclerPost()**](ChorusProApi.md#recyclerFactureApiV1ChorusProFacturesRecyclerPost) | **POST** /api/v1/chorus-pro/factures/recycler | Recycle an invoice (Supplier) |
| [**soumettreFactureApiV1ChorusProFacturesSoumettrePost()**](ChorusProApi.md#soumettreFactureApiV1ChorusProFacturesSoumettrePost) | **POST** /api/v1/chorus-pro/factures/soumettre | Submit an invoice to Chorus Pro |
| [**telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost()**](ChorusProApi.md#telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost) | **POST** /api/v1/chorus-pro/factures/telecharger-groupe | Download a group of invoices |
| [**traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost()**](ChorusProApi.md#traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost) | **POST** /api/v1/chorus-pro/factures/traiter-facture-recue | Process a received invoice (Recipient) |
| [**valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost()**](ChorusProApi.md#valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost) | **POST** /api/v1/chorus-pro/factures/valideur/consulter | Consult an invoice (Validator) |
| [**valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost()**](ChorusProApi.md#valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost) | **POST** /api/v1/chorus-pro/factures/valideur/rechercher | Search invoices to validate (Validator) |
| [**valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost()**](ChorusProApi.md#valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost) | **POST** /api/v1/chorus-pro/factures/valideur/traiter | Validate or reject an invoice (Validator) |


## `ajouterFichierApiV1ChorusProTransversesAjouterFichierPost()`

```php
ajouterFichierApiV1ChorusProTransversesAjouterFichierPost($request_body): mixed
```

Add an attachment

Add an attachment to the current user account.      **Max size**: 10 MB per file      **Example payload**:     ```json     {       \"pieceJointeFichier\": \"JVBERi0xLjQKJeLjz9MKNSAwIG9iago8P...\",       \"pieceJointeNom\": \"purchase_order.pdf\",       \"pieceJointeTypeMime\": \"application/pdf\",       \"pieceJointeExtension\": \"PDF\"     }     ```      **Returns**: The attachment ID (`pieceJointeIdFichier`) to use in `/factures/completer`.      **Accepted extensions**: PDF, JPG, PNG, ZIP, XML, etc.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->ajouterFichierApiV1ChorusProTransversesAjouterFichierPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->ajouterFichierApiV1ChorusProTransversesAjouterFichierPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `completerFactureApiV1ChorusProFacturesCompleterPost()`

```php
completerFactureApiV1ChorusProFacturesCompleterPost($request_body): mixed
```

Complete a suspended invoice (Supplier)

Complete a SUSPENDUE status invoice by adding attachments or a comment.      **Required status**: SUSPENDUE      **Possible actions**:     - Add attachments (supporting documents, purchase orders, etc.)     - Modify comment      **Example payload**:     ```json     {       \"identifiantFactureCPP\": 12345,       \"commentaire\": \"Here are the requested documents\",       \"listePiecesJointes\": [         {           \"pieceJointeIdFichier\": 98765,           \"pieceJointeNom\": \"purchase_order.pdf\"         }       ]     }     ```      **Note**: Attachments must first be uploaded via `/transverses/ajouter-fichier`.      **After completion**: The invoice returns to MISE_A_DISPOSITION status.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->completerFactureApiV1ChorusProFacturesCompleterPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->completerFactureApiV1ChorusProFacturesCompleterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `consulterFactureApiV1ChorusProFacturesConsulterPost()`

```php
consulterFactureApiV1ChorusProFacturesConsulterPost($get_invoice_request): \FactPulse\SDK\Model\GetInvoiceResponse
```

Consult invoice status

Retrieves the information and current status of an invoice submitted to Chorus Pro.      **Returns**:     - Invoice number and date     - Total gross amount     - **Current status**: SOUMISE, VALIDEE, REJETEE, SUSPENDUE, MANDATEE, MISE_EN_PAIEMENT, etc.     - Recipient structure      **Use cases**:     - Track the processing progress of an invoice     - Check if an invoice has been validated or rejected     - Get the payment date      **Polling**: Call this endpoint regularly to track status changes.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_invoice_request = new \FactPulse\SDK\Model\GetInvoiceRequest(); // \FactPulse\SDK\Model\GetInvoiceRequest

try {
    $result = $apiInstance->consulterFactureApiV1ChorusProFacturesConsulterPost($get_invoice_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->consulterFactureApiV1ChorusProFacturesConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_invoice_request** | [**\FactPulse\SDK\Model\GetInvoiceRequest**](../Model/GetInvoiceRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GetInvoiceResponse**](../Model/GetInvoiceResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `consulterStructureApiV1ChorusProStructuresConsulterPost()`

```php
consulterStructureApiV1ChorusProStructuresConsulterPost($get_structure_request): \FactPulse\SDK\Model\GetStructureResponse
```

Consult structure details

Retrieves detailed information about a Chorus Pro structure.       **Returns**:     - Company name     - Intra-EU VAT number     - Contact email     - **Required parameters**: Indicates if service code and/or engagement number are required to submit an invoice      **Typical step**: Called after `search-structures` to know which fields are mandatory before submitting an invoice.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_structure_request = new \FactPulse\SDK\Model\GetStructureRequest(); // \FactPulse\SDK\Model\GetStructureRequest

try {
    $result = $apiInstance->consulterStructureApiV1ChorusProStructuresConsulterPost($get_structure_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->consulterStructureApiV1ChorusProStructuresConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_structure_request** | [**\FactPulse\SDK\Model\GetStructureRequest**](../Model/GetStructureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GetStructureResponse**](../Model/GetStructureResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet()`

```php
listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet($id_structure_cpp): \FactPulse\SDK\Model\SearchServicesResponse
```

List structure services

Retrieves the list of active services for a public structure.      **Use cases**:     - List available services for an administration     - Verify that a service code exists before submitting an invoice      **Returns**:     - List of services with their code, label, and status (active/inactive)

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_structure_cpp = 56; // int | Chorus Pro structure ID (idStructureCPP)

try {
    $result = $apiInstance->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet($id_structure_cpp);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_structure_cpp** | **int**| Chorus Pro structure ID (idStructureCPP) | |

### Return type

[**\FactPulse\SDK\Model\SearchServicesResponse**](../Model/SearchServicesResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost()`

```php
obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost($get_chorus_pro_id_request): \FactPulse\SDK\Model\GetChorusProIdResponse
```

Utility: Get Chorus Pro ID from SIRET

**Convenient utility** to get a structure's Chorus Pro ID from its SIRET.       This wrapper function combines:     1. Searching for the structure by SIRET     2. Extracting the `id_structure_cpp` if a single structure is found      **Returns**:     - `id_structure_cpp`: Chorus Pro ID (0 if not found or multiple results)     - `designation_structure`: Structure name (if found)     - `message`: Explanatory message      **Use cases**:     - Shortcut to directly get the Chorus Pro ID before submitting an invoice     - Simplified alternative to `search-structures` + manual ID extraction      **Note**: If multiple structures match the SIRET (rare), returns 0 and an error message.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$get_chorus_pro_id_request = new \FactPulse\SDK\Model\GetChorusProIdRequest(); // \FactPulse\SDK\Model\GetChorusProIdRequest

try {
    $result = $apiInstance->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost($get_chorus_pro_id_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **get_chorus_pro_id_request** | [**\FactPulse\SDK\Model\GetChorusProIdRequest**](../Model/GetChorusProIdRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GetChorusProIdResponse**](../Model/GetChorusProIdResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost()`

```php
rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost($request_body): mixed
```

Search received invoices (Recipient)

Search invoices received by the connected recipient.      **Filters**:     - Downloaded / not downloaded     - Reception dates     - Status (MISE_A_DISPOSITION, SUSPENDUE, etc.)     - Supplier      **Useful indicator**: `factureTelechargeeParDestinataire` indicates whether the invoice has already been downloaded.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost()`

```php
rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost($request_body): mixed
```

Search issued invoices (Supplier)

Search invoices issued by the connected supplier.      **Available filters**:     - Invoice number     - Dates (start/end)     - Status     - Recipient structure     - Amount      **Use cases**:     - Track issued invoices     - Verify statuses     - Export for accounting

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherStructuresApiV1ChorusProStructuresRechercherPost()`

```php
rechercherStructuresApiV1ChorusProStructuresRechercherPost($search_structure_request): \FactPulse\SDK\Model\SearchStructureResponse
```

Search Chorus Pro structures

Search for structures (companies, administrations) registered on Chorus Pro.      **Use cases**:     - Find the Chorus Pro ID of a structure from its SIRET     - Check if a structure is registered on Chorus Pro     - List structures matching criteria      **Available filters**:     - Identifier (SIRET, SIREN, etc.)     - Company name     - Identifier type     - Private structures only      **Typical step**: Called before `submit-invoice` to get the recipient's `id_structure_cpp`.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$search_structure_request = new \FactPulse\SDK\Model\SearchStructureRequest(); // \FactPulse\SDK\Model\SearchStructureRequest

try {
    $result = $apiInstance->rechercherStructuresApiV1ChorusProStructuresRechercherPost($search_structure_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherStructuresApiV1ChorusProStructuresRechercherPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **search_structure_request** | [**\FactPulse\SDK\Model\SearchStructureRequest**](../Model/SearchStructureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SearchStructureResponse**](../Model/SearchStructureResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recyclerFactureApiV1ChorusProFacturesRecyclerPost()`

```php
recyclerFactureApiV1ChorusProFacturesRecyclerPost($request_body): mixed
```

Recycle an invoice (Supplier)

Recycle an invoice with A_RECYCLER status by modifying routing data.      **Required status**: A_RECYCLER      **Modifiable fields**:     - Recipient (`idStructureCPP`)     - Service code     - Engagement number      **Use cases**:     - Wrong recipient     - Change of billing service     - Update engagement number      **Example payload**:     ```json     {       \"identifiantFactureCPP\": 12345,       \"idStructureCPP\": 67890,       \"codeService\": \"SERVICE_01\",       \"numeroEngagement\": \"ENG2024001\"     }     ```      **Note**: The invoice keeps its number and amounts, only routing fields change.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->recyclerFactureApiV1ChorusProFacturesRecyclerPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->recyclerFactureApiV1ChorusProFacturesRecyclerPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `soumettreFactureApiV1ChorusProFacturesSoumettrePost()`

```php
soumettreFactureApiV1ChorusProFacturesSoumettrePost($submit_invoice_request): \FactPulse\SDK\Model\SubmitInvoiceResponse
```

Submit an invoice to Chorus Pro

Submits an electronic invoice to a public structure via Chorus Pro.       **Complete workflow**:     1. **Upload the Factur-X PDF** via `/transverses/ajouter-fichier` → retrieve `pieceJointeId`     2. **Get the structure ID** via `/structures/rechercher` or `/structures/obtenir-id-depuis-siret`     3. **Check mandatory parameters** via `/structures/consulter`     4. **Submit the invoice** with the `piece_jointe_principale_id` obtained in step 1      **Prerequisites**:     1. Have the recipient's `id_structure_cpp` (via `/structures/rechercher`)     2. Know the mandatory parameters (via `/structures/consulter`):        - Service code if `code_service_doit_etre_renseigne=true`        - Engagement number if `numero_ej_doit_etre_renseigne=true`     3. Have uploaded the Factur-X PDF (via `/transverses/ajouter-fichier`)      **Expected format**:     - `piece_jointe_principale_id`: ID returned by `/transverses/ajouter-fichier`     - Amounts: Strings with 2 decimals (e.g., \"1250.50\")     - Dates: ISO 8601 format (YYYY-MM-DD)      **Returns**:     - `identifiant_facture_cpp`: Chorus Pro ID of the created invoice     - `numero_flux_depot`: Deposit tracking number      **Possible statuses after submission**:     - SOUMISE: Pending validation     - VALIDEE: Validated by recipient     - REJETEE: Rejected (data error or business refusal)     - SUSPENDUE: Pending additional information      **Note**: Use `/factures/consulter` to track status changes.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_invoice_request = new \FactPulse\SDK\Model\SubmitInvoiceRequest(); // \FactPulse\SDK\Model\SubmitInvoiceRequest

try {
    $result = $apiInstance->soumettreFactureApiV1ChorusProFacturesSoumettrePost($submit_invoice_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->soumettreFactureApiV1ChorusProFacturesSoumettrePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_invoice_request** | [**\FactPulse\SDK\Model\SubmitInvoiceRequest**](../Model/SubmitInvoiceRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitInvoiceResponse**](../Model/SubmitInvoiceResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost()`

```php
telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost($request_body): mixed
```

Download a group of invoices

Download one or more invoices (max 10 recommended) with their attachments.      **Available formats**:     - PDF: PDF file only     - XML: XML file only     - ZIP: Archive containing PDF + XML + attachments      **Maximum size**: 120 MB per download      **Example payload**:     ```json     {       \"listeIdentifiantsFactureCPP\": [12345, 12346],       \"inclurePiecesJointes\": true,       \"formatFichier\": \"ZIP\"     }     ```      **Returns**: The file is base64-encoded in the `fichierBase64` field.      **Note**: The `factureTelechargeeParDestinataire` flag is automatically updated.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost()`

```php
traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost($request_body): mixed
```

Process a received invoice (Recipient)

Change the status of a received invoice.      **Possible statuses**:     - MISE_A_DISPOSITION: Invoice accepted     - SUSPENDUE: Pending additional information (reason required)     - REJETEE: Invoice refused (reason required)     - MANDATEE: Invoice mandated     - MISE_EN_PAIEMENT: Invoice being paid     - COMPTABILISEE: Invoice accounted     - MISE_A_DISPOSITION_COMPTABLE: Made available to accounting     - A_RECYCLER: To be recycled     - COMPLETEE: Completed     - SERVICE-FAIT: Service rendered     - PRISE_EN_COMPTE_DESTINATAIRE: Acknowledged     - TRANSMISE_MOA: Transmitted to MOA      **Example payload**:     ```json     {       \"identifiantFactureCPP\": 12345,       \"nouveauStatut\": \"REJETEE\",       \"motifRejet\": \"Duplicate invoice\",       \"commentaire\": \"Invoice already received under reference ABC123\"     }     ```      **Rules**:     - A reason is **required** for SUSPENDUE and REJETEE     - Only certain statuses are allowed depending on the invoice's current status

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost()`

```php
valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost($request_body): mixed
```

Consult an invoice (Validator)

Retrieves detailed information about an invoice for validators.  **Use case**: Called by validators (public sector) to consult invoice details before approving or rejecting it.  **Required payload**: ```json {   \"idFacture\": 123456789 } ```  **Returns**: Complete invoice details including amounts, dates, attachments, and current status.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost()`

```php
valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost($request_body): mixed
```

Search invoices to validate (Validator)

Search invoices pending validation by the connected validator.      **Role**: Validator in the internal validation workflow.      **Filters**: Dates, structure, service, etc.

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost()`

```php
valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost($request_body): mixed
```

Validate or reject an invoice (Validator)

Validate or reject an invoice pending validation.      **Actions**:     - Validate: The invoice moves to the next status in the workflow     - Reject: The invoice is rejected (reason required)

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


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$request_body = NULL; // array<string,mixed>

try {
    $result = $apiInstance->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost($request_body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **request_body** | [**array<string,mixed>**](../Model/mixed.md)|  | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
