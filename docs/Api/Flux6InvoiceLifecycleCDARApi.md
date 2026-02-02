# FactPulse\SDK\Flux6InvoiceLifecycleCDARApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**generateCdarApiV1CdarGeneratePost()**](Flux6InvoiceLifecycleCDARApi.md#generateCdarApiV1CdarGeneratePost) | **POST** /api/v1/cdar/generate | Generate a CDAR message |
| [**getActionCodesApiV1CdarActionCodesGet()**](Flux6InvoiceLifecycleCDARApi.md#getActionCodesApiV1CdarActionCodesGet) | **GET** /api/v1/cdar/action-codes | List of CDAR action codes |
| [**getReasonCodesApiV1CdarReasonCodesGet()**](Flux6InvoiceLifecycleCDARApi.md#getReasonCodesApiV1CdarReasonCodesGet) | **GET** /api/v1/cdar/reason-codes | List of CDAR reason codes |
| [**getStatusCodesApiV1CdarStatusCodesGet()**](Flux6InvoiceLifecycleCDARApi.md#getStatusCodesApiV1CdarStatusCodesGet) | **GET** /api/v1/cdar/status-codes | List of CDAR status codes |
| [**submitCdarApiV1CdarSubmitPost()**](Flux6InvoiceLifecycleCDARApi.md#submitCdarApiV1CdarSubmitPost) | **POST** /api/v1/cdar/submit | Generate and submit a CDAR message |
| [**submitCdarXmlApiV1CdarSubmitXmlPost()**](Flux6InvoiceLifecycleCDARApi.md#submitCdarXmlApiV1CdarSubmitXmlPost) | **POST** /api/v1/cdar/submit-xml | Submit a pre-generated CDAR XML |
| [**submitEncaisseeApiV1CdarEncaisseePost()**](Flux6InvoiceLifecycleCDARApi.md#submitEncaisseeApiV1CdarEncaisseePost) | **POST** /api/v1/cdar/encaissee | [Simplified] Submit PAID status (212) - Issued invoice |
| [**submitRefuseeApiV1CdarRefuseePost()**](Flux6InvoiceLifecycleCDARApi.md#submitRefuseeApiV1CdarRefuseePost) | **POST** /api/v1/cdar/refusee | [Simplified] Submit REFUSED status (210) - Received invoice |
| [**validateCdarApiV1CdarValidatePost()**](Flux6InvoiceLifecycleCDARApi.md#validateCdarApiV1CdarValidatePost) | **POST** /api/v1/cdar/validate | Validate CDAR structured data |
| [**validateXmlCdarApiV1CdarValidateXmlPost()**](Flux6InvoiceLifecycleCDARApi.md#validateXmlCdarApiV1CdarValidateXmlPost) | **POST** /api/v1/cdar/validate-xml | Validate CDAR XML against XSD and Schematron BR-FR-CDV |


## `generateCdarApiV1CdarGeneratePost()`

```php
generateCdarApiV1CdarGeneratePost($create_cdar_request): \FactPulse\SDK\Model\GenerateCDARResponse
```

Generate a CDAR message

Generate a CDAR XML message (Cross Domain Acknowledgement and Response) to communicate the status of an invoice.  **Message types:** - **23** (Processing): Standard lifecycle message - **305** (Transmission): Inter-platform transmission message  **Business rules:** - BR-FR-CDV-14: Status 212 (PAID) requires a paid amount - BR-FR-CDV-15: Statuses 206/207/208/210/213/501 require a reason code

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


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_cdar_request = new \FactPulse\SDK\Model\CreateCDARRequest(); // \FactPulse\SDK\Model\CreateCDARRequest

try {
    $result = $apiInstance->generateCdarApiV1CdarGeneratePost($create_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->generateCdarApiV1CdarGeneratePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_cdar_request** | [**\FactPulse\SDK\Model\CreateCDARRequest**](../Model/CreateCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GenerateCDARResponse**](../Model/GenerateCDARResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getActionCodesApiV1CdarActionCodesGet()`

```php
getActionCodesApiV1CdarActionCodesGet(): \FactPulse\SDK\Model\ActionCodesResponse
```

List of CDAR action codes

Returns the complete list of action codes (BR-FR-CDV-CL-10).  These codes indicate the requested action on the invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getActionCodesApiV1CdarActionCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->getActionCodesApiV1CdarActionCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\ActionCodesResponse**](../Model/ActionCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getReasonCodesApiV1CdarReasonCodesGet()`

```php
getReasonCodesApiV1CdarReasonCodesGet(): \FactPulse\SDK\Model\ReasonCodesResponse
```

List of CDAR reason codes

Returns the complete list of status reason codes (BR-FR-CDV-CL-09).  These codes explain the reason for a particular status.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getReasonCodesApiV1CdarReasonCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->getReasonCodesApiV1CdarReasonCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\ReasonCodesResponse**](../Model/ReasonCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getStatusCodesApiV1CdarStatusCodesGet()`

```php
getStatusCodesApiV1CdarStatusCodesGet(): \FactPulse\SDK\Model\StatusCodesResponse
```

List of CDAR status codes

Returns the complete list of invoice status codes (BR-FR-CDV-CL-06).  These codes indicate the lifecycle state of an invoice.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->getStatusCodesApiV1CdarStatusCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->getStatusCodesApiV1CdarStatusCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\FactPulse\SDK\Model\StatusCodesResponse**](../Model/StatusCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitCdarApiV1CdarSubmitPost()`

```php
submitCdarApiV1CdarSubmitPost($submit_cdar_request): \FactPulse\SDK\Model\SubmitCDARResponse
```

Generate and submit a CDAR message

Generate a CDAR message and submit it to the PA/PDP platform.  **Authentication strategies:** 1. **JWT with client_uid** (recommended): PDP credentials retrieved from backend 2. **Zero-storage**: Provide pdpFlowServiceUrl, pdpClientId, pdpClientSecret in the request  **Flow types (flowType):** - `CustomerInvoiceLC`: Client-side lifecycle (buyer) - `SupplierInvoiceLC`: Supplier-side lifecycle (seller)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_cdar_request = new \FactPulse\SDK\Model\SubmitCDARRequest(); // \FactPulse\SDK\Model\SubmitCDARRequest

try {
    $result = $apiInstance->submitCdarApiV1CdarSubmitPost($submit_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->submitCdarApiV1CdarSubmitPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_cdar_request** | [**\FactPulse\SDK\Model\SubmitCDARRequest**](../Model/SubmitCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitCDARResponse**](../Model/SubmitCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitCdarXmlApiV1CdarSubmitXmlPost()`

```php
submitCdarXmlApiV1CdarSubmitXmlPost($submit_cdarxml_request): \FactPulse\SDK\Model\SubmitCDARResponse
```

Submit a pre-generated CDAR XML

Submit a pre-generated CDAR XML message to the PA/PDP platform.  Useful for submitting XML generated by other systems.  **Validation:** The XML is validated against XSD and Schematron BR-FR-CDV rules BEFORE submission. Invalid XML will be rejected with detailed error messages.  **Authentication strategies:** 1. **JWT with client_uid** (recommended): PDP credentials retrieved from backend 2. **Zero-storage**: Provide pdpFlowServiceUrl, pdpClientId, pdpClientSecret in the request

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_cdarxml_request = new \FactPulse\SDK\Model\SubmitCDARXMLRequest(); // \FactPulse\SDK\Model\SubmitCDARXMLRequest

try {
    $result = $apiInstance->submitCdarXmlApiV1CdarSubmitXmlPost($submit_cdarxml_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->submitCdarXmlApiV1CdarSubmitXmlPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_cdarxml_request** | [**\FactPulse\SDK\Model\SubmitCDARXMLRequest**](../Model/SubmitCDARXMLRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitCDARResponse**](../Model/SubmitCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitEncaisseeApiV1CdarEncaisseePost()`

```php
submitEncaisseeApiV1CdarEncaisseePost($encaissee_request): \FactPulse\SDK\Model\SimplifiedCDARResponse
```

[Simplified] Submit PAID status (212) - Issued invoice

**Simplified endpoint for OD** - Submit a PAID status (212) for an **ISSUED** invoice.  This status is **mandatory for PPF** (BR-FR-CDV-14 requires the paid amount).  **Use case:** The **seller** confirms payment receipt for an invoice they issued.  **Who issues this status?** - **Issuer (IssuerTradeParty):** The seller (SE = Seller) who received payment - **Recipient (RecipientTradeParty):** The buyer (BY = Buyer) who paid  **Reference:** XP Z12-014 Annex B, example UC1_F202500003_07-CDV-212_Encaissee.xml  **Authentication:** JWT Bearer (recommended) or PDP credentials in request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$encaissee_request = new \FactPulse\SDK\Model\EncaisseeRequest(); // \FactPulse\SDK\Model\EncaisseeRequest

try {
    $result = $apiInstance->submitEncaisseeApiV1CdarEncaisseePost($encaissee_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->submitEncaisseeApiV1CdarEncaisseePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **encaissee_request** | [**\FactPulse\SDK\Model\EncaisseeRequest**](../Model/EncaisseeRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SimplifiedCDARResponse**](../Model/SimplifiedCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitRefuseeApiV1CdarRefuseePost()`

```php
submitRefuseeApiV1CdarRefuseePost($refusee_request): \FactPulse\SDK\Model\SimplifiedCDARResponse
```

[Simplified] Submit REFUSED status (210) - Received invoice

**Simplified endpoint for OD** - Submit a REFUSED status (210) for a **RECEIVED** invoice.  This status is **mandatory for PPF** (BR-FR-CDV-15 requires a reason code).  **Use case:** The **buyer** refuses an invoice they received.  **Who issues this status?** - **Issuer (IssuerTradeParty):** The buyer (BY = Buyer) refusing the invoice - **Recipient (RecipientTradeParty):** The seller (SE = Seller) who issued the invoice  **Reference:** XP Z12-014 Annex B, example UC3_F202500005_04-CDV-210_Refusee.xml  **Allowed reason codes (BR-FR-CDV-CL-09):** - `TX_TVA_ERR`: Incorrect VAT rate - `MONTANTTOTAL_ERR`: Incorrect total amount - `CALCUL_ERR`: Calculation error - `NON_CONFORME`: Non-compliant - `DOUBLON`: Duplicate - `DEST_ERR`: Wrong recipient - `TRANSAC_INC`: Incomplete transaction - `EMMET_INC`: Unknown issuer - `CONTRAT_TERM`: Contract terminated - `DOUBLE_FACT`: Double billing - `CMD_ERR`: Order error - `ADR_ERR`: Address error - `REF_CT_ABSENT`: Missing contract reference  **Authentication:** JWT Bearer (recommended) or PDP credentials in request.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$refusee_request = new \FactPulse\SDK\Model\RefuseeRequest(); // \FactPulse\SDK\Model\RefuseeRequest

try {
    $result = $apiInstance->submitRefuseeApiV1CdarRefuseePost($refusee_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->submitRefuseeApiV1CdarRefuseePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **refusee_request** | [**\FactPulse\SDK\Model\RefuseeRequest**](../Model/RefuseeRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SimplifiedCDARResponse**](../Model/SimplifiedCDARResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateCdarApiV1CdarValidatePost()`

```php
validateCdarApiV1CdarValidatePost($validate_cdar_request): \FactPulse\SDK\Model\ValidateCDARResponse
```

Validate CDAR structured data

Validate CDAR structured data without generating XML.  **Note:** This endpoint validates structured data fields only. Use `/validate-xml` to validate a pre-generated CDAR XML file against XSD and Schematron.  Checks: - Field formats (SIREN, dates, etc.) - Enum codes (status, reason, action) - Business rules BR-FR-CDV-*

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


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$validate_cdar_request = new \FactPulse\SDK\Model\ValidateCDARRequest(); // \FactPulse\SDK\Model\ValidateCDARRequest

try {
    $result = $apiInstance->validateCdarApiV1CdarValidatePost($validate_cdar_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->validateCdarApiV1CdarValidatePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **validate_cdar_request** | [**\FactPulse\SDK\Model\ValidateCDARRequest**](../Model/ValidateCDARRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ValidateCDARResponse**](../Model/ValidateCDARResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateXmlCdarApiV1CdarValidateXmlPost()`

```php
validateXmlCdarApiV1CdarValidateXmlPost($xml_file): array<string,mixed>
```

Validate CDAR XML against XSD and Schematron BR-FR-CDV

Validates a CDAR XML file against:  1. **XSD schema**: UN/CEFACT D22B CrossDomainAcknowledgementAndResponse 2. **Schematron BR-FR-CDV**: French business rules for invoice lifecycle  Returns validation status and detailed error messages if invalid.  **Note:** Use `/validate` to validate structured data fields (JSON).

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


$apiInstance = new FactPulse\SDK\Api\Flux6InvoiceLifecycleCDARApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xml_file = '/path/to/file.txt'; // \SplFileObject | CDAR XML file to validate

try {
    $result = $apiInstance->validateXmlCdarApiV1CdarValidateXmlPost($xml_file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux6InvoiceLifecycleCDARApi->validateXmlCdarApiV1CdarValidateXmlPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xml_file** | **\SplFileObject****\SplFileObject**| CDAR XML file to validate | |

### Return type

**array<string,mixed>**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
