# FactPulse\SDK\FacturXConversionApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**convertDocumentAsyncApiV1ConvertAsyncPost()**](FacturXConversionApi.md#convertDocumentAsyncApiV1ConvertAsyncPost) | **POST** /api/v1/convert/async | Convert a document to Factur-X (async mode) |
| [**downloadFileApiV1ConvertConversionIdDownloadFilenameGet()**](FacturXConversionApi.md#downloadFileApiV1ConvertConversionIdDownloadFilenameGet) | **GET** /api/v1/convert/{conversion_id}/download/{filename} | Download a generated file |
| [**getConversionStatusApiV1ConvertConversionIdStatusGet()**](FacturXConversionApi.md#getConversionStatusApiV1ConvertConversionIdStatusGet) | **GET** /api/v1/convert/{conversion_id}/status | Check conversion status |
| [**resumeConversionApiV1ConvertConversionIdResumePost()**](FacturXConversionApi.md#resumeConversionApiV1ConvertConversionIdResumePost) | **POST** /api/v1/convert/{conversion_id}/resume | Resume a conversion with corrections |


## `convertDocumentAsyncApiV1ConvertAsyncPost()`

```php
convertDocumentAsyncApiV1ConvertAsyncPost($file, $output, $callback_url, $webhook_mode): mixed
```

Convert a document to Factur-X (async mode)

Launch an asynchronous conversion via Celery.  ## Workflow  1. **Upload**: Document is sent as multipart/form-data 2. **Celery Task**: Task is queued for processing 3. **Callback**: Webhook notification on completion  ## Possible responses  - **202**: Task accepted, processing - **400**: Invalid file

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


$apiInstance = new FactPulse\SDK\Api\FacturXConversionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = '/path/to/file.txt'; // \SplFileObject | Document to convert (PDF, DOCX, XLSX, JPG, PNG)
$output = 'pdf'; // string | Output format: pdf, xml, both
$callback_url = 'callback_url_example'; // string
$webhook_mode = 'inline'; // string | Content delivery mode: 'inline' (base64 in webhook) or 'download_url' (temporary URL, 1h TTL)

try {
    $result = $apiInstance->convertDocumentAsyncApiV1ConvertAsyncPost($file, $output, $callback_url, $webhook_mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXConversionApi->convertDocumentAsyncApiV1ConvertAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file** | **\SplFileObject****\SplFileObject**| Document to convert (PDF, DOCX, XLSX, JPG, PNG) | |
| **output** | **string**| Output format: pdf, xml, both | [optional] [default to &#39;pdf&#39;] |
| **callback_url** | **string**|  | [optional] |
| **webhook_mode** | **string**| Content delivery mode: &#39;inline&#39; (base64 in webhook) or &#39;download_url&#39; (temporary URL, 1h TTL) | [optional] [default to &#39;inline&#39;] |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `downloadFileApiV1ConvertConversionIdDownloadFilenameGet()`

```php
downloadFileApiV1ConvertConversionIdDownloadFilenameGet($conversion_id, $filename): mixed
```

Download a generated file

Download the generated Factur-X PDF or XML file.  ## Available files  - `facturx.pdf`: PDF/A-3 with embedded XML - `facturx.xml`: XML CII only (Cross Industry Invoice)  Files are available for 24 hours after generation.

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


$apiInstance = new FactPulse\SDK\Api\FacturXConversionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$conversion_id = 'conversion_id_example'; // string | Conversion ID returned by POST /convert (UUID format)
$filename = 'filename_example'; // string | File to download: 'facturx.pdf' or 'facturx.xml'

try {
    $result = $apiInstance->downloadFileApiV1ConvertConversionIdDownloadFilenameGet($conversion_id, $filename);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXConversionApi->downloadFileApiV1ConvertConversionIdDownloadFilenameGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **conversion_id** | **string**| Conversion ID returned by POST /convert (UUID format) | |
| **filename** | **string**| File to download: &#39;facturx.pdf&#39; or &#39;facturx.xml&#39; | |

### Return type

**mixed**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getConversionStatusApiV1ConvertConversionIdStatusGet()`

```php
getConversionStatusApiV1ConvertConversionIdStatusGet($conversion_id): array<string,mixed>
```

Check conversion status

Returns the current status of an asynchronous conversion.

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


$apiInstance = new FactPulse\SDK\Api\FacturXConversionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$conversion_id = 'conversion_id_example'; // string | Conversion ID returned by POST /convert (UUID format)

try {
    $result = $apiInstance->getConversionStatusApiV1ConvertConversionIdStatusGet($conversion_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXConversionApi->getConversionStatusApiV1ConvertConversionIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **conversion_id** | **string**| Conversion ID returned by POST /convert (UUID format) | |

### Return type

**array<string,mixed>**

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `resumeConversionApiV1ConvertConversionIdResumePost()`

```php
resumeConversionApiV1ConvertConversionIdResumePost($conversion_id, $convert_resume_request): \FactPulse\SDK\Model\ConvertSuccessResponse
```

Resume a conversion with corrections

Resume a conversion after completing missing data or correcting errors.  The OCR extraction is preserved, data is updated with corrections, then a new Schematron validation is performed.

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


$apiInstance = new FactPulse\SDK\Api\FacturXConversionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$conversion_id = 'conversion_id_example'; // string | Conversion ID returned by POST /convert (UUID format)
$convert_resume_request = new \FactPulse\SDK\Model\ConvertResumeRequest(); // \FactPulse\SDK\Model\ConvertResumeRequest

try {
    $result = $apiInstance->resumeConversionApiV1ConvertConversionIdResumePost($conversion_id, $convert_resume_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXConversionApi->resumeConversionApiV1ConvertConversionIdResumePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **conversion_id** | **string**| Conversion ID returned by POST /convert (UUID format) | |
| **convert_resume_request** | [**\FactPulse\SDK\Model\ConvertResumeRequest**](../Model/ConvertResumeRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ConvertSuccessResponse**](../Model/ConvertSuccessResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
