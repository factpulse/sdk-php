# FactPulse\SDK\AsyncTasksApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet()**](AsyncTasksApi.md#getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet) | **GET** /api/v1/processing/tasks/{task_id}/generation-status | Get typed generation task status |
| [**getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet()**](AsyncTasksApi.md#getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet) | **GET** /api/v1/processing/tasks/{task_id}/signature-status | Get typed signature task status |
| [**getTaskStatusApiV1ProcessingTasksTaskIdStatusGet()**](AsyncTasksApi.md#getTaskStatusApiV1ProcessingTasksTaskIdStatusGet) | **GET** /api/v1/processing/tasks/{task_id}/status | Get task generation status |
| [**getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet()**](AsyncTasksApi.md#getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet) | **GET** /api/v1/processing/tasks/{task_id}/validation-status | Get typed validation task status |


## `getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet()`

```php
getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet($task_id): \FactPulse\SDK\Model\GenerationTaskStatus
```

Get typed generation task status

Typed status endpoint for invoice generation tasks.  Returns a strongly-typed `result` (discriminated on `result.status`): - **SUCCESS**: `GenerationSuccessResult` with `content_b64` / `xml_content` - **ERROR**: `TaskErrorResult` in AFNOR format

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


$apiInstance = new FactPulse\SDK\Api\AsyncTasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string | Celery task ID returned by /generate-invoice

try {
    $result = $apiInstance->getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AsyncTasksApi->getGenerationTaskStatusApiV1ProcessingTasksTaskIdGenerationStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**| Celery task ID returned by /generate-invoice | |

### Return type

[**\FactPulse\SDK\Model\GenerationTaskStatus**](../Model/GenerationTaskStatus.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet()`

```php
getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet($task_id): \FactPulse\SDK\Model\SignatureTaskStatus
```

Get typed signature task status

Typed status endpoint for PDF signing tasks.  Returns a strongly-typed `result` (discriminated on `result.status`): - **SUCCESS**: `SignatureSuccessResult` with `content_b64`, `signer_cn`, etc. - **ERROR**: `TaskErrorResult` in AFNOR format

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


$apiInstance = new FactPulse\SDK\Api\AsyncTasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string | Celery task ID returned by /sign-pdf-async

try {
    $result = $apiInstance->getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AsyncTasksApi->getSignatureTaskStatusApiV1ProcessingTasksTaskIdSignatureStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**| Celery task ID returned by /sign-pdf-async | |

### Return type

[**\FactPulse\SDK\Model\SignatureTaskStatus**](../Model/SignatureTaskStatus.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getTaskStatusApiV1ProcessingTasksTaskIdStatusGet()`

```php
getTaskStatusApiV1ProcessingTasksTaskIdStatusGet($task_id): \FactPulse\SDK\Model\AsyncTaskStatus
```

Get task generation status

Retrieves the progress status of an invoice generation task.  ## Possible states  The `status` field uses the `CeleryStatus` enum with values: - **PENDING, STARTED, SUCCESS, FAILURE, RETRY**  See the `CeleryStatus` schema documentation for details.  ## Business result  When `status=\"SUCCESS\"`, the `result` field contains: - `status`: \"SUCCESS\" or \"ERROR\" (business result) - `content_b64`: Base64 encoded content (if success) - `errorCode`, `errorMessage`, `details`: AFNOR format (if business error)  ## Usage  Poll this endpoint every 2-3 seconds until `status` is `SUCCESS` or `FAILURE`.

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


$apiInstance = new FactPulse\SDK\Api\AsyncTasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string | Celery task ID returned by async endpoints (UUID format)

try {
    $result = $apiInstance->getTaskStatusApiV1ProcessingTasksTaskIdStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AsyncTasksApi->getTaskStatusApiV1ProcessingTasksTaskIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**| Celery task ID returned by async endpoints (UUID format) | |

### Return type

[**\FactPulse\SDK\Model\AsyncTaskStatus**](../Model/AsyncTaskStatus.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet()`

```php
getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet($task_id): \FactPulse\SDK\Model\ValidationTaskStatus
```

Get typed validation task status

Typed status endpoint for Factur-X PDF validation tasks.  Returns a strongly-typed `result` (discriminated on `result.status`): - **SUCCESS**: `ValidationSuccessTaskResult` with `validation_result` - **ERROR**: `TaskErrorResult` in AFNOR format

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


$apiInstance = new FactPulse\SDK\Api\AsyncTasksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$task_id = 'task_id_example'; // string | Celery task ID returned by /validate-pdf

try {
    $result = $apiInstance->getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet($task_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AsyncTasksApi->getValidationTaskStatusApiV1ProcessingTasksTaskIdValidationStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **task_id** | **string**| Celery task ID returned by /validate-pdf | |

### Return type

[**\FactPulse\SDK\Model\ValidationTaskStatus**](../Model/ValidationTaskStatus.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
