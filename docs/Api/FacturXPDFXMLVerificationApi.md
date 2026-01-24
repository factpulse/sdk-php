# FactPulse\SDK\FacturXPDFXMLVerificationApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet()**](FacturXPDFXMLVerificationApi.md#getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet) | **GET** /api/v1/verification/verify-async/{task_id}/status | Get status of an asynchronous verification |
| [**verifyPdfAsyncApiV1VerificationVerifyAsyncPost()**](FacturXPDFXMLVerificationApi.md#verifyPdfAsyncApiV1VerificationVerifyAsyncPost) | **POST** /api/v1/verification/verify-async | Verify PDF/XML Factur-X compliance (asynchronous) |
| [**verifyPdfSyncApiV1VerificationVerifyPost()**](FacturXPDFXMLVerificationApi.md#verifyPdfSyncApiV1VerificationVerifyPost) | **POST** /api/v1/verification/verify | Verify PDF/XML Factur-X compliance (synchronous) |


## `getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet()`

```php
getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet($task_id): \FactPulse\SDK\Model\AsyncTaskStatus
```

Get status of an asynchronous verification

Retrieves the status and result of an asynchronous verification task.  **Possible statuses:** - `PENDING`: Task waiting in queue - `STARTED`: Task currently running - `SUCCESS`: Task completed successfully (see `result`) - `FAILURE`: System error (unhandled exception)  **Note:** The `result.status` field can be \"SUCCESS\" or \"ERROR\" independently of Celery status (which will always be SUCCESS if the task ran).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\FacturXPDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string | Celery task ID returned by /verify-async endpoint

try {
    $result = $apiInstance->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXPDFXMLVerificationApi->getVerificationStatusApiV1VerificationVerifyAsyncTaskIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**| Celery task ID returned by /verify-async endpoint | |

### Return type

[**\FactPulse\SDK\Model\AsyncTaskStatus**](../Model/AsyncTaskStatus.md)

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
verifyPdfAsyncApiV1VerificationVerifyAsyncPost($pdf_file, $force_ocr, $callback_url, $webhook_mode): \FactPulse\SDK\Model\TaskResponse
```

Verify PDF/XML Factur-X compliance (asynchronous)

Verifies PDF/XML Factur-X compliance asynchronously.  **IMPORTANT**: Only Factur-X PDFs (with embedded XML) are accepted. PDFs without Factur-X XML will return a `NOT_FACTURX` error in the result.  This version uses a Celery task and can call the OCR service if the PDF is an image or if `force_ocr=true`.  **Returns immediately** a task ID. Use `/verify-async/{task_id}/status` to retrieve the result.  **Verification principle (Factur-X 1.08):** - Principle #2: XML can only contain info present in the PDF - Principle #4: All XML info must be present and compliant in the PDF  **Verified fields:** - Identification: BT-1 (invoice #), BT-2 (date), BT-3 (type), BT-5 (currency), BT-23 (framework) - Seller: BT-27 (name), BT-29 (SIRET), BT-30 (SIREN), BT-31 (VAT) - Buyer: BT-44 (name), BT-46 (SIRET), BT-47 (SIREN), BT-48 (VAT) - Amounts: BT-109 (excl. tax), BT-110 (VAT), BT-112 (incl. tax), BT-115 (amount due) - VAT breakdown: BT-116, BT-117, BT-118, BT-119 - Invoice lines: BT-153, BT-129, BT-146, BT-131 - Mandatory notes: PMT, PMD, AAB - Rule BR-FR-09: SIRET/SIREN consistency  **Advantages over synchronous version:** - OCR support for image PDFs (via DocTR service) - Longer timeout for large documents - Doesn't block the server  ## Webhook notification (recommended)  Instead of polling, you can receive a webhook notification when verification completes:  ``` callback_url=https://your-server.com/webhook ```  The webhook will POST a JSON payload with: - `event_type`: `verification.completed` or `verification.failed` - `data.is_compliant`: Whether the PDF/XML are consistent - `data.compliance_score`: Compliance score (0-1) - `X-Webhook-Signature` header for HMAC verification

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\FacturXPDFXMLVerificationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$pdf_file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF file to verify
$force_ocr = false; // bool | Force OCR usage even if PDF contains native text
$callback_url = 'callback_url_example'; // string
$webhook_mode = 'inline'; // string | Webhook content delivery: 'inline' (base64 in payload) or 'download_url' (temporary URL, 1h TTL)

try {
    $result = $apiInstance->verifyPdfAsyncApiV1VerificationVerifyAsyncPost($pdf_file, $force_ocr, $callback_url, $webhook_mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXPDFXMLVerificationApi->verifyPdfAsyncApiV1VerificationVerifyAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **pdf_file** | **\SplFileObject****\SplFileObject**| Factur-X PDF file to verify | |
| **force_ocr** | **bool**| Force OCR usage even if PDF contains native text | [optional] [default to false] |
| **callback_url** | **string**|  | [optional] |
| **webhook_mode** | **string**| Webhook content delivery: &#39;inline&#39; (base64 in payload) or &#39;download_url&#39; (temporary URL, 1h TTL) | [optional] [default to &#39;inline&#39;] |

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


$apiInstance = new FactPulse\SDK\Api\FacturXPDFXMLVerificationApi(
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
    echo 'Exception when calling FacturXPDFXMLVerificationApi->verifyPdfSyncApiV1VerificationVerifyPost: ', $e->getMessage(), PHP_EOL;
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
