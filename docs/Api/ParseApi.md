# FactPulse\SDK\ParseApi

## 🔍 Invoice Parsing  **Parse CII XML, UBL XML, or Factur-X PDF files to extract structured invoice data.**  ### Features  - **Multi-format**: Accepts CII (Factur-X) XML, UBL 2.1 XML, or Factur-X PDF - **Auto-detection**: Automatically detects the input format - **Structured output**: Returns a complete FacturXInvoice object - **Profile detection**: Identifies the Factur-X profile (MINIMUM, BASIC, EN16931, EXTENDED) - **Async support**: Available in synchronous and asynchronous modes

All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost()**](ParseApi.md#parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost) | **POST** /api/v1/processing/parse-facturx/async | Parse Factur-X XML or PDF (async) |
| [**parseFacturxSyncApiV1ProcessingParseFacturxPost()**](ParseApi.md#parseFacturxSyncApiV1ProcessingParseFacturxPost) | **POST** /api/v1/processing/parse-facturx | Parse CII, UBL or Factur-X PDF (sync) |


## `parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost()`

```php
parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost($file, $callback_url): \FactPulse\SDK\Model\TaskResponse
```

Parse Factur-X XML or PDF (async)

Parse a Factur-X file asynchronously using a Celery task.  **Use case:** For large files or when you want non-blocking processing.  **Workflow:** 1. Submit file with this endpoint -> receive `task_id` 2. Poll `/tasks/{task_id}/status` for result 3. Result contains `invoice` and `detected_profile`  **Optional:** Provide `callback_url` to receive a webhook when parsing completes.

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


$apiInstance = new FactPulse\SDK\Api\ParseApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF or XML file to parse
$callback_url = 'callback_url_example'; // string

try {
    $result = $apiInstance->parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost($file, $callback_url);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParseApi->parseFacturxAsyncApiV1ProcessingParseFacturxAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file** | **\SplFileObject****\SplFileObject**| Factur-X PDF or XML file to parse | |
| **callback_url** | **string**|  | [optional] |

### Return type

[**\FactPulse\SDK\Model\TaskResponse**](../Model/TaskResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `parseFacturxSyncApiV1ProcessingParseFacturxPost()`

```php
parseFacturxSyncApiV1ProcessingParseFacturxPost($file): \FactPulse\SDK\Model\ParseFacturXResponse
```

Parse CII, UBL or Factur-X PDF (sync)

Parse a CII XML, UBL XML, or Factur-X PDF and extract the invoice data as a FacturXInvoice model.  **Use cases:** - Extract invoice data from received invoices (any format) - Round-trip: parse an existing invoice, modify it, and regenerate in another format - Convert between CII and UBL via the FacturXInvoice pivot model  **Supported formats:** - Factur-X PDF (PDF/A-3 with embedded CII XML) - CII XML (UN/CEFACT Cross-Industry Invoice) - UBL 2.1 XML (OASIS Invoice or CreditNote)  **Returns:** - `invoice`: Complete FacturXInvoice data (can be used with /generate-invoice) - `detected_profile`: Factur-X profile (MINIMUM, BASIC, EN16931, EXTENDED)

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


$apiInstance = new FactPulse\SDK\Api\ParseApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = '/path/to/file.txt'; // \SplFileObject | Factur-X PDF or XML file to parse

try {
    $result = $apiInstance->parseFacturxSyncApiV1ProcessingParseFacturxPost($file);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ParseApi->parseFacturxSyncApiV1ProcessingParseFacturxPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file** | **\SplFileObject****\SplFileObject**| Factur-X PDF or XML file to parse | |

### Return type

[**\FactPulse\SDK\Model\ParseFacturXResponse**](../Model/ParseFacturXResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
