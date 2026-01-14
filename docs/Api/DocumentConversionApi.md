# FactPulse\SDK\DocumentConversionApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**convertDocumentAsyncApiV1ConvertAsyncPost()**](DocumentConversionApi.md#convertDocumentAsyncApiV1ConvertAsyncPost) | **POST** /api/v1/convert/async | Convertir un document en Factur-X (mode asynchrone) |
| [**downloadFileApiV1ConvertConversionIdDownloadFilenameGet()**](DocumentConversionApi.md#downloadFileApiV1ConvertConversionIdDownloadFilenameGet) | **GET** /api/v1/convert/{conversion_id}/download/{filename} | Télécharger un fichier généré |
| [**getConversionStatusApiV1ConvertConversionIdStatusGet()**](DocumentConversionApi.md#getConversionStatusApiV1ConvertConversionIdStatusGet) | **GET** /api/v1/convert/{conversion_id}/status | Vérifier le statut d&#39;une conversion |
| [**resumeConversionApiV1ConvertConversionIdResumePost()**](DocumentConversionApi.md#resumeConversionApiV1ConvertConversionIdResumePost) | **POST** /api/v1/convert/{conversion_id}/resume | Reprendre une conversion avec corrections |


## `convertDocumentAsyncApiV1ConvertAsyncPost()`

```php
convertDocumentAsyncApiV1ConvertAsyncPost($file, $output, $callback_url, $webhook_mode): mixed
```

Convertir un document en Factur-X (mode asynchrone)

Lance une conversion asynchrone via Celery.  ## Workflow  1. **Upload** : Le document est envoyé en multipart/form-data 2. **Task Celery** : La tâche est mise en file d'attente 3. **Callback** : Notification par webhook à la fin  ## Réponses possibles  - **202** : Tâche acceptée, en cours de traitement - **400** : Fichier invalide

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\DocumentConversionApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$file = '/path/to/file.txt'; // \SplFileObject | Document à convertir (PDF, DOCX, XLSX, JPG, PNG)
$output = 'pdf'; // string | Format de sortie: pdf, xml, both
$callback_url = 'callback_url_example'; // string
$webhook_mode = 'inline'; // string | Mode de livraison du contenu: 'inline' (base64 dans webhook) ou 'download_url' (URL temporaire 1h)

try {
    $result = $apiInstance->convertDocumentAsyncApiV1ConvertAsyncPost($file, $output, $callback_url, $webhook_mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentConversionApi->convertDocumentAsyncApiV1ConvertAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **file** | **\SplFileObject****\SplFileObject**| Document à convertir (PDF, DOCX, XLSX, JPG, PNG) | |
| **output** | **string**| Format de sortie: pdf, xml, both | [optional] [default to &#39;pdf&#39;] |
| **callback_url** | **string**|  | [optional] |
| **webhook_mode** | **string**| Mode de livraison du contenu: &#39;inline&#39; (base64 dans webhook) ou &#39;download_url&#39; (URL temporaire 1h) | [optional] [default to &#39;inline&#39;] |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

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

Télécharger un fichier généré

Télécharge le fichier Factur-X PDF ou XML généré.  ## Fichiers disponibles  - `facturx.pdf` : PDF/A-3 avec XML embarqué - `facturx.xml` : XML CII seul (Cross Industry Invoice)  Les fichiers sont disponibles pendant 24 heures après génération.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\DocumentConversionApi(
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
    echo 'Exception when calling DocumentConversionApi->downloadFileApiV1ConvertConversionIdDownloadFilenameGet: ', $e->getMessage(), PHP_EOL;
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

[HTTPBearer](../../README.md#HTTPBearer)

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

Vérifier le statut d'une conversion

Retourne le statut actuel d'une conversion asynchrone.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\DocumentConversionApi(
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
    echo 'Exception when calling DocumentConversionApi->getConversionStatusApiV1ConvertConversionIdStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **conversion_id** | **string**| Conversion ID returned by POST /convert (UUID format) | |

### Return type

**array<string,mixed>**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

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

Reprendre une conversion avec corrections

Reprend une conversion après complétion des données manquantes ou correction des erreurs.  L'extraction OCR est conservée, les données sont mises à jour avec les corrections, puis une nouvelle validation Schematron est effectuée.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\DocumentConversionApi(
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
    echo 'Exception when calling DocumentConversionApi->resumeConversionApiV1ConvertConversionIdResumePost: ', $e->getMessage(), PHP_EOL;
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

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
