# FactPulse\SDK\PDFXMLVerificationApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet()**](PDFXMLVerificationApi.md#getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet) | **GET** /api/v1/verification/verify-async/{task_id}/status | Get status of an asynchronous verification |
| [**getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0()**](PDFXMLVerificationApi.md#getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0) | **GET** /api/v1/verification/verify-async/{task_id}/status | Get status of an asynchronous verification |
| [**verifyPdfAsyncApiV1VerificationVerifyAsyncPost()**](PDFXMLVerificationApi.md#verifyPdfAsyncApiV1VerificationVerifyAsyncPost) | **POST** /api/v1/verification/verify-async | Verify PDF/XML Factur-X compliance (asynchronous) |
| [**verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0()**](PDFXMLVerificationApi.md#verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0) | **POST** /api/v1/verification/verify-async | Verify PDF/XML Factur-X compliance (asynchronous) |
| [**verifyPdfSyncApiV1VerificationVerifyPost()**](PDFXMLVerificationApi.md#verifyPdfSyncApiV1VerificationVerifyPost) | **POST** /api/v1/verification/verify | Verify PDF/XML Factur-X compliance (synchronous) |
| [**verifyPdfSyncApiV1VerificationVerifyPost_0()**](PDFXMLVerificationApi.md#verifyPdfSyncApiV1VerificationVerifyPost_0) | **POST** /api/v1/verification/verify | Verify PDF/XML Factur-X compliance (synchronous) |


## `getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet()`

```php
getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet($task_id): \FactPulse\SDK\Model\TaskStatus
```

Get status of an asynchronous verification

Retrieves the status and result of an asynchronous verification task.  **Possible statuses:** - `PENDING`: Task waiting in queue - `STARTED`: Task currently running - `SUCCESS`: Task completed successfully (see `result`) - `FAILURE`: System error (unhandled exception)  **Note:** The `result.status` field can be \"SUCCESS\" or \"ERROR\" independently of Celery status (which will always be SUCCESS if the task ran).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string

try {
    $result = $apiInstance->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\TaskStatus**](../Model/TaskStatus.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0()`

```php
getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0($task_id): \FactPulse\SDK\Model\TaskStatus
```

Get status of an asynchronous verification

Retrieves the status and result of an asynchronous verification task.  **Possible statuses:** - `PENDING`: Task waiting in queue - `STARTED`: Task currently running - `SUCCESS`: Task completed successfully (see `result`) - `FAILURE`: System error (unhandled exception)  **Note:** The `result.status` field can be \"SUCCESS\" or \"ERROR\" independently of Celery status (which will always be SUCCESS if the task ran).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string

try {
    $result = $apiInstance->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\TaskStatus**](../Model/TaskStatus.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPdfAsyncApiV1VerificationVerifyAsyncPost()`

```php
verifyPdfAsyncApiV1VerificationVerifyAsyncPost($pdf_file, $force_ocr): \FactPulse\SDK\Model\TaskResponse
```

Verify PDF/XML Factur-X compliance (asynchronous)

Verifies PDF/XML Factur-X compliance asynchronously.  **IMPORTANT**: Only Factur-X PDFs (with embedded XML) are accepted. PDFs without Factur-X XML will return a `NOT_FACTURX` error in the result.  This version uses a Celery task and can call the OCR service if the PDF is an image or if `force_ocr=true`.  **Returns immediately** a task ID. Use `/verify-async/{task_id}/status` to retrieve the result.  **Verification principle (Factur-X 1.08):** - Principle #2: XML can only contain info present in the PDF - Principle #4: All XML info must be present and compliant in the PDF  **Verified fields:** - Identification: BT-1 (invoice #), BT-2 (date), BT-3 (type), BT-5 (currency), BT-23 (framework) - Seller: BT-27 (name), BT-29 (SIRET), BT-30 (SIREN), BT-31 (VAT) - Buyer: BT-44 (name), BT-46 (SIRET), BT-47 (SIREN), BT-48 (VAT) - Amounts: BT-109 (excl. tax), BT-110 (VAT), BT-112 (incl. tax), BT-115 (amount due) - VAT breakdown: BT-116, BT-117, BT-118, BT-119 - Invoice lines: BT-153, BT-129, BT-146, BT-131 - Mandatory notes: PMT, PMD, AAB - Rule BR-FR-09: SIRET/SIREN consistency  **Advantages over synchronous version:** - OCR support for image PDFs (via DocTR service) - Longer timeout for large documents - Doesn't block the server

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pdf_file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF file to verify
$force_ocr = false; // bool | Force OCR usage even if PDF contains native text

try {
    $result = $apiInstance->verifyPdfAsyncApiV1VerificationVerifyAsyncPost($pdf_file, $force_ocr);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->verifyPdfAsyncApiV1VerificationVerifyAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **pdf_file** | **\SplFileObject****\SplFileObject**| Factur-X PDF file to verify | |
| **force_ocr** | **bool**| Force OCR usage even if PDF contains native text | [optional] [default to false] |

### Return type

[**\FactPulse\SDK\Model\TaskResponse**](../Model/TaskResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0()`

```php
verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0($pdf_file, $force_ocr): \FactPulse\SDK\Model\TaskResponse
```

Verify PDF/XML Factur-X compliance (asynchronous)

Verifies PDF/XML Factur-X compliance asynchronously.  **IMPORTANT**: Only Factur-X PDFs (with embedded XML) are accepted. PDFs without Factur-X XML will return a `NOT_FACTURX` error in the result.  This version uses a Celery task and can call the OCR service if the PDF is an image or if `force_ocr=true`.  **Returns immediately** a task ID. Use `/verify-async/{task_id}/status` to retrieve the result.  **Verification principle (Factur-X 1.08):** - Principle #2: XML can only contain info present in the PDF - Principle #4: All XML info must be present and compliant in the PDF  **Verified fields:** - Identification: BT-1 (invoice #), BT-2 (date), BT-3 (type), BT-5 (currency), BT-23 (framework) - Seller: BT-27 (name), BT-29 (SIRET), BT-30 (SIREN), BT-31 (VAT) - Buyer: BT-44 (name), BT-46 (SIRET), BT-47 (SIREN), BT-48 (VAT) - Amounts: BT-109 (excl. tax), BT-110 (VAT), BT-112 (incl. tax), BT-115 (amount due) - VAT breakdown: BT-116, BT-117, BT-118, BT-119 - Invoice lines: BT-153, BT-129, BT-146, BT-131 - Mandatory notes: PMT, PMD, AAB - Rule BR-FR-09: SIRET/SIREN consistency  **Advantages over synchronous version:** - OCR support for image PDFs (via DocTR service) - Longer timeout for large documents - Doesn't block the server

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pdf_file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF file to verify
$force_ocr = false; // bool | Force OCR usage even if PDF contains native text

try {
    $result = $apiInstance->verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0($pdf_file, $force_ocr);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->verifyPdfAsyncApiV1VerificationVerifyAsyncPost_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **pdf_file** | **\SplFileObject****\SplFileObject**| Factur-X PDF file to verify | |
| **force_ocr** | **bool**| Force OCR usage even if PDF contains native text | [optional] [default to false] |

### Return type

[**\FactPulse\SDK\Model\TaskResponse**](../Model/TaskResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPdfSyncApiV1VerificationVerifyPost()`

```php
verifyPdfSyncApiV1VerificationVerifyPost($pdf_file): \FactPulse\SDK\Model\VerificationSuccessResponse
```

Verify PDF/XML Factur-X compliance (synchronous)

Verifies compliance between the PDF and its embedded Factur-X XML.  **IMPORTANT**: Only Factur-X PDFs (with embedded XML) are accepted. PDFs without Factur-X XML will be rejected with a 400 error.  This synchronous version uses only native PDF extraction (pdfplumber). For image PDFs requiring OCR, use the `/verify-async` endpoint.  **Verification principle (Factur-X 1.08):** - Principle #2: XML can only contain info present in the PDF - Principle #4: All XML info must be present and compliant in the PDF  **Verified fields:** - Identification: BT-1 (invoice #), BT-2 (date), BT-3 (type), BT-5 (currency), BT-23 (framework) - Seller: BT-27 (name), BT-29 (SIRET), BT-30 (SIREN), BT-31 (VAT) - Buyer: BT-44 (name), BT-46 (SIRET), BT-47 (SIREN), BT-48 (VAT) - Amounts: BT-109 (excl. tax), BT-110 (VAT), BT-112 (incl. tax), BT-115 (amount due) - VAT breakdown: BT-116, BT-117, BT-118, BT-119 - Invoice lines: BT-153, BT-129, BT-146, BT-131 - Mandatory notes: PMT, PMD, AAB - Rule BR-FR-09: SIRET/SIREN consistency

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pdf_file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF file to verify

try {
    $result = $apiInstance->verifyPdfSyncApiV1VerificationVerifyPost($pdf_file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->verifyPdfSyncApiV1VerificationVerifyPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **pdf_file** | **\SplFileObject****\SplFileObject**| Factur-X PDF file to verify | |

### Return type

[**\FactPulse\SDK\Model\VerificationSuccessResponse**](../Model/VerificationSuccessResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifyPdfSyncApiV1VerificationVerifyPost_0()`

```php
verifyPdfSyncApiV1VerificationVerifyPost_0($pdf_file): \FactPulse\SDK\Model\VerificationSuccessResponse
```

Verify PDF/XML Factur-X compliance (synchronous)

Verifies compliance between the PDF and its embedded Factur-X XML.  **IMPORTANT**: Only Factur-X PDFs (with embedded XML) are accepted. PDFs without Factur-X XML will be rejected with a 400 error.  This synchronous version uses only native PDF extraction (pdfplumber). For image PDFs requiring OCR, use the `/verify-async` endpoint.  **Verification principle (Factur-X 1.08):** - Principle #2: XML can only contain info present in the PDF - Principle #4: All XML info must be present and compliant in the PDF  **Verified fields:** - Identification: BT-1 (invoice #), BT-2 (date), BT-3 (type), BT-5 (currency), BT-23 (framework) - Seller: BT-27 (name), BT-29 (SIRET), BT-30 (SIREN), BT-31 (VAT) - Buyer: BT-44 (name), BT-46 (SIRET), BT-47 (SIREN), BT-48 (VAT) - Amounts: BT-109 (excl. tax), BT-110 (VAT), BT-112 (incl. tax), BT-115 (amount due) - VAT breakdown: BT-116, BT-117, BT-118, BT-119 - Invoice lines: BT-153, BT-129, BT-146, BT-131 - Mandatory notes: PMT, PMD, AAB - Rule BR-FR-09: SIRET/SIREN consistency

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\PDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pdf_file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF file to verify

try {
    $result = $apiInstance->verifyPdfSyncApiV1VerificationVerifyPost_0($pdf_file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling PDFXMLVerificationApi->verifyPdfSyncApiV1VerificationVerifyPost_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **pdf_file** | **\SplFileObject****\SplFileObject**| Factur-X PDF file to verify | |

### Return type

[**\FactPulse\SDK\Model\VerificationSuccessResponse**](../Model/VerificationSuccessResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
