# FactPulse\SDK\Flux10EReportingApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost()**](Flux10EReportingApi.md#generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost) | **POST** /api/v1/ereporting/generate-aggregated | Generate aggregated e-reporting XML (PPF-compliant) |
| [**generateEreportingApiV1EreportingGeneratePost()**](Flux10EReportingApi.md#generateEreportingApiV1EreportingGeneratePost) | **POST** /api/v1/ereporting/generate | Generate e-reporting XML |
| [**generateEreportingDownloadApiV1EreportingGenerateDownloadPost()**](Flux10EReportingApi.md#generateEreportingDownloadApiV1EreportingGenerateDownloadPost) | **POST** /api/v1/ereporting/generate/download | Generate and download e-reporting XML |
| [**listCategoryCodesApiV1EreportingCategoryCodesGet()**](Flux10EReportingApi.md#listCategoryCodesApiV1EreportingCategoryCodesGet) | **GET** /api/v1/ereporting/category-codes | List PPF-compliant category codes |
| [**listFlowTypesApiV1EreportingFlowTypesGet()**](Flux10EReportingApi.md#listFlowTypesApiV1EreportingFlowTypesGet) | **GET** /api/v1/ereporting/flow-types | List available flow types |
| [**submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost()**](Flux10EReportingApi.md#submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost) | **POST** /api/v1/ereporting/submit-aggregated | Submit aggregated e-reporting to PA/PDP |
| [**submitEreportingApiV1EreportingSubmitPost()**](Flux10EReportingApi.md#submitEreportingApiV1EreportingSubmitPost) | **POST** /api/v1/ereporting/submit | Submit e-reporting to PA/PDP |
| [**submitXmlEreportingApiV1EreportingSubmitXmlPost()**](Flux10EReportingApi.md#submitXmlEreportingApiV1EreportingSubmitXmlPost) | **POST** /api/v1/ereporting/submit-xml | Submit pre-generated e-reporting XML |
| [**validateAggregatedEreportingApiV1EreportingValidateAggregatedPost()**](Flux10EReportingApi.md#validateAggregatedEreportingApiV1EreportingValidateAggregatedPost) | **POST** /api/v1/ereporting/validate-aggregated | Validate aggregated e-reporting data |
| [**validateEreportingApiV1EreportingValidatePost()**](Flux10EReportingApi.md#validateEreportingApiV1EreportingValidatePost) | **POST** /api/v1/ereporting/validate | Validate e-reporting data |
| [**validateXmlEreportingApiV1EreportingValidateXmlPost()**](Flux10EReportingApi.md#validateXmlEreportingApiV1EreportingValidateXmlPost) | **POST** /api/v1/ereporting/validate-xml | Validate e-reporting XML (PPF Annexe 6 v1.9 compliant) |


## `generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost()`

```php
generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost($create_aggregated_report_request): \FactPulse\SDK\Model\GenerateAggregatedReportResponse
```

Generate aggregated e-reporting XML (PPF-compliant)

Generate a PPF-compliant aggregated e-reporting XML containing multiple flux types in a single file.  This endpoint creates a Report XML that can contain: - **TransactionsReport**: Invoice (10.1) AND/OR Transactions (10.3) - **PaymentsReport**: Invoice payments (10.2) AND/OR Transaction payments (10.4)  The AFNOR FlowType is automatically determined based on content: - Single type → Specific FlowType (e.g., AggregatedCustomerTransactionReport) - Multiple types → MultiFlowReport  **CategoryCode (TT-81)** must use PPF-compliant values: - TLB1: Goods deliveries - TPS1: Service provisions - TNT1: Non-taxed transactions - TMA1: Mixed transactions

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_aggregated_report_request = new \FactPulse\SDK\Model\CreateAggregatedReportRequest(); // \FactPulse\SDK\Model\CreateAggregatedReportRequest

try {
    $result = $apiInstance->generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost($create_aggregated_report_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->generateAggregatedEreportingApiV1EreportingGenerateAggregatedPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_aggregated_report_request** | [**\FactPulse\SDK\Model\CreateAggregatedReportRequest**](../Model/CreateAggregatedReportRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GenerateAggregatedReportResponse**](../Model/GenerateAggregatedReportResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `generateEreportingApiV1EreportingGeneratePost()`

```php
generateEreportingApiV1EreportingGeneratePost($create_e_reporting_request): \FactPulse\SDK\Model\GenerateEReportingResponse
```

Generate e-reporting XML

Generate e-reporting XML (FRR format) from structured data.  Supports all four flow types: - **10.1**: Unitary B2B international transactions (use `invoices` field) - **10.2**: Payments for B2B international invoices (use `invoicePayments` field) - **10.3**: Aggregated B2C transactions (use `transactions` field) - **10.4**: Aggregated B2C payments (use `aggregatedPayments` field)  The generated XML is compliant with DGFIP specifications and ready for submission to a PA (Plateforme Agréée).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_e_reporting_request = new \FactPulse\SDK\Model\CreateEReportingRequest(); // \FactPulse\SDK\Model\CreateEReportingRequest

try {
    $result = $apiInstance->generateEreportingApiV1EreportingGeneratePost($create_e_reporting_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->generateEreportingApiV1EreportingGeneratePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_e_reporting_request** | [**\FactPulse\SDK\Model\CreateEReportingRequest**](../Model/CreateEReportingRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GenerateEReportingResponse**](../Model/GenerateEReportingResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `generateEreportingDownloadApiV1EreportingGenerateDownloadPost()`

```php
generateEreportingDownloadApiV1EreportingGenerateDownloadPost($create_e_reporting_request, $filename)
```

Generate and download e-reporting XML

Generate e-reporting XML and return as downloadable file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_e_reporting_request = new \FactPulse\SDK\Model\CreateEReportingRequest(); // \FactPulse\SDK\Model\CreateEReportingRequest
$filename = 'filename_example'; // string | Output filename (default: ereporting_{reportId}.xml)

try {
    $apiInstance->generateEreportingDownloadApiV1EreportingGenerateDownloadPost($create_e_reporting_request, $filename);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->generateEreportingDownloadApiV1EreportingGenerateDownloadPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_e_reporting_request** | [**\FactPulse\SDK\Model\CreateEReportingRequest**](../Model/CreateEReportingRequest.md)|  | |
| **filename** | **string**| Output filename (default: ereporting_{reportId}.xml) | [optional] |

### Return type

void (empty response body)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listCategoryCodesApiV1EreportingCategoryCodesGet()`

```php
listCategoryCodesApiV1EreportingCategoryCodesGet(): array<string,mixed>
```

List PPF-compliant category codes

Returns the list of valid CategoryCode values (TT-81) for e-reporting transactions.  Source: Annexe 6 - Format sémantique FE e-reporting v1.9

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listCategoryCodesApiV1EreportingCategoryCodesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->listCategoryCodesApiV1EreportingCategoryCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**array<string,mixed>**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listFlowTypesApiV1EreportingFlowTypesGet()`

```php
listFlowTypesApiV1EreportingFlowTypesGet(): array<string,mixed>
```

List available flow types

Returns the list of supported e-reporting flow types with descriptions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);

try {
    $result = $apiInstance->listFlowTypesApiV1EreportingFlowTypesGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->listFlowTypesApiV1EreportingFlowTypesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**array<string,mixed>**

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost()`

```php
submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost($submit_aggregated_report_request): \FactPulse\SDK\Model\SubmitEReportingResponse
```

Submit aggregated e-reporting to PA/PDP

Generate and submit a PPF-compliant aggregated e-reporting to a PA/PDP.  Combines generation and submission in a single call. Automatically determines the AFNOR FlowType based on content.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_aggregated_report_request = new \FactPulse\SDK\Model\SubmitAggregatedReportRequest(); // \FactPulse\SDK\Model\SubmitAggregatedReportRequest

try {
    $result = $apiInstance->submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost($submit_aggregated_report_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->submitAggregatedEreportingApiV1EreportingSubmitAggregatedPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_aggregated_report_request** | [**\FactPulse\SDK\Model\SubmitAggregatedReportRequest**](../Model/SubmitAggregatedReportRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitEReportingResponse**](../Model/SubmitEReportingResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitEreportingApiV1EreportingSubmitPost()`

```php
submitEreportingApiV1EreportingSubmitPost($submit_e_reporting_request): \FactPulse\SDK\Model\SubmitEReportingResponse
```

Submit e-reporting to PA/PDP

Generate and submit e-reporting to a PA (Plateforme Agréée).  Authentication strategies (same as invoices): 1. **JWT with client_uid** (recommended): PDP credentials fetched from backend 2. **Zero-storage**: Provide pdpFlowServiceUrl, pdpClientId, pdpClientSecret in request  The e-reporting is submitted using the AFNOR Flow Service API with syntax=FRR (FRench Reporting).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_e_reporting_request = new \FactPulse\SDK\Model\SubmitEReportingRequest(); // \FactPulse\SDK\Model\SubmitEReportingRequest

try {
    $result = $apiInstance->submitEreportingApiV1EreportingSubmitPost($submit_e_reporting_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->submitEreportingApiV1EreportingSubmitPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_e_reporting_request** | [**\FactPulse\SDK\Model\SubmitEReportingRequest**](../Model/SubmitEReportingRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitEReportingResponse**](../Model/SubmitEReportingResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitXmlEreportingApiV1EreportingSubmitXmlPost()`

```php
submitXmlEreportingApiV1EreportingSubmitXmlPost($xml_file, $tracking_id, $skip_validation, $pdp_flow_service_url, $pdp_token_url, $pdp_client_id, $pdp_client_secret): \FactPulse\SDK\Model\SubmitEReportingResponse
```

Submit pre-generated e-reporting XML

Submit a pre-generated e-reporting XML file directly to a PA/PDP.  This endpoint is designed for clients who generate their own PPF-compliant XML and only need FactPulse for the PDP submission.  **Process:** 1. Validates the XML against PPF XSD schemas 2. Determines the appropriate AFNOR FlowType 3. Submits to the configured PDP/PA 4. Returns the flowId for tracking  **Authentication:** Same strategies as /submit endpoint (JWT or zero-storage credentials).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xml_file = '/path/to/file.txt'; // \SplFileObject | E-reporting XML file
$tracking_id = 'tracking_id_example'; // string
$skip_validation = false; // bool | Skip XSD validation
$pdp_flow_service_url = 'pdp_flow_service_url_example'; // string
$pdp_token_url = 'pdp_token_url_example'; // string
$pdp_client_id = 'pdp_client_id_example'; // string
$pdp_client_secret = 'pdp_client_secret_example'; // string

try {
    $result = $apiInstance->submitXmlEreportingApiV1EreportingSubmitXmlPost($xml_file, $tracking_id, $skip_validation, $pdp_flow_service_url, $pdp_token_url, $pdp_client_id, $pdp_client_secret);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->submitXmlEreportingApiV1EreportingSubmitXmlPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xml_file** | **\SplFileObject****\SplFileObject**| E-reporting XML file | |
| **tracking_id** | **string**|  | [optional] |
| **skip_validation** | **bool**| Skip XSD validation | [optional] [default to false] |
| **pdp_flow_service_url** | **string**|  | [optional] |
| **pdp_token_url** | **string**|  | [optional] |
| **pdp_client_id** | **string**|  | [optional] |
| **pdp_client_secret** | **string**|  | [optional] |

### Return type

[**\FactPulse\SDK\Model\SubmitEReportingResponse**](../Model/SubmitEReportingResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateAggregatedEreportingApiV1EreportingValidateAggregatedPost()`

```php
validateAggregatedEreportingApiV1EreportingValidateAggregatedPost($create_aggregated_report_request): array<string,mixed>
```

Validate aggregated e-reporting data

Validates aggregated e-reporting data without generating XML.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$create_aggregated_report_request = new \FactPulse\SDK\Model\CreateAggregatedReportRequest(); // \FactPulse\SDK\Model\CreateAggregatedReportRequest

try {
    $result = $apiInstance->validateAggregatedEreportingApiV1EreportingValidateAggregatedPost($create_aggregated_report_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->validateAggregatedEreportingApiV1EreportingValidateAggregatedPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **create_aggregated_report_request** | [**\FactPulse\SDK\Model\CreateAggregatedReportRequest**](../Model/CreateAggregatedReportRequest.md)|  | |

### Return type

**array<string,mixed>**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateEreportingApiV1EreportingValidatePost()`

```php
validateEreportingApiV1EreportingValidatePost($validate_e_reporting_request): \FactPulse\SDK\Model\ValidateEReportingResponse
```

Validate e-reporting data

Validate e-reporting data without generating or submitting.  Performs: - Schema validation - Business rule validation (correct flux type vs data) - Data consistency checks (tax totals, dates, etc.)  Returns validation errors and warnings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$validate_e_reporting_request = new \FactPulse\SDK\Model\ValidateEReportingRequest(); // \FactPulse\SDK\Model\ValidateEReportingRequest

try {
    $result = $apiInstance->validateEreportingApiV1EreportingValidatePost($validate_e_reporting_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->validateEreportingApiV1EreportingValidatePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **validate_e_reporting_request** | [**\FactPulse\SDK\Model\ValidateEReportingRequest**](../Model/ValidateEReportingRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ValidateEReportingResponse**](../Model/ValidateEReportingResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validateXmlEreportingApiV1EreportingValidateXmlPost()`

```php
validateXmlEreportingApiV1EreportingValidateXmlPost($xml_file, $validate_coherence, $validate_period): array<string,mixed>
```

Validate e-reporting XML (PPF Annexe 6 v1.9 compliant)

Validates an e-reporting XML file against PPF specifications (Annexe 6 v1.9):  **Validation levels:** 1. **XSD (REJ_SEMAN)**: Structure, types, cardinality 2. **Semantic (REJ_SEMAN)**: Authorized values from codelists 3. **Coherence (REJ_COH)**: Data consistency (totals = sum of breakdowns) 4. **Period (REJ_PER)**: Transaction dates within declared period  **Validated codes:** - SchemeID (ISO 6523): 0002=SIREN, 0009=SIRET, 0224=RoutingCode, etc. - RoleCode (UNCL 3035): SE=Seller, BY=Buyer, WK=Working party - CategoryCode (TT-81): TLB1, TPS1, TNT1, TMA1 - TaxCategoryCode (UNTDID 5305): S, Z, E, AE, K, G, O - Currency (ISO 4217), Country (ISO 3166-1)  Returns structured validation errors with PPF rejection codes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\Flux10EReportingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$xml_file = '/path/to/file.txt'; // \SplFileObject | E-reporting XML file to validate
$validate_coherence = true; // bool | Validate data coherence (REJ_COH)
$validate_period = true; // bool | Validate period coherence (REJ_PER)

try {
    $result = $apiInstance->validateXmlEreportingApiV1EreportingValidateXmlPost($xml_file, $validate_coherence, $validate_period);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling Flux10EReportingApi->validateXmlEreportingApiV1EreportingValidateXmlPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **xml_file** | **\SplFileObject****\SplFileObject**| E-reporting XML file to validate | |
| **validate_coherence** | **bool**| Validate data coherence (REJ_COH) | [optional] [default to true] |
| **validate_period** | **bool**| Validate period coherence (REJ_PER) | [optional] [default to true] |

### Return type

**array<string,mixed>**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
