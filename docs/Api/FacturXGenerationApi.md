# FactPulse\SDK\FacturXGenerationApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**generateInvoiceApiV1ProcessingGenerateInvoicePost()**](FacturXGenerationApi.md#generateInvoiceApiV1ProcessingGenerateInvoicePost) | **POST** /api/v1/processing/generate-invoice | Generate a Factur-X invoice |
| [**submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost()**](FacturXGenerationApi.md#submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost) | **POST** /api/v1/processing/invoices/submit-complete | Submit a complete invoice (generation + signature + submission) |
| [**submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost()**](FacturXGenerationApi.md#submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost) | **POST** /api/v1/processing/invoices/submit-complete-async | Submit a complete invoice (asynchronous with Celery) |


## `generateInvoiceApiV1ProcessingGenerateInvoicePost()`

```php
generateInvoiceApiV1ProcessingGenerateInvoicePost($invoice_data, $profile, $output_format, $auto_enrich, $source_pdf, $callback_url, $webhook_mode, $skip_br_fr): \FactPulse\SDK\Model\TaskResponse
```

Generate a Factur-X invoice

Generates an electronic invoice in Factur-X format compliant with European standards.  ## Applied Standards  - **Factur-X** (France): FNFE-MPE standard (Forum National de la Facture Électronique) - **ZUGFeRD** (Germany): German format compatible with Factur-X - **EN 16931**: European semantic standard for electronic invoicing - **ISO 19005-3** (PDF/A-3): Long-term electronic archiving - **Cross Industry Invoice (CII)**: UN/CEFACT XML syntax  ## 🆕 New: Simplified format with auto-enrichment (P0.1)  You can now create an invoice by providing only: - An invoice number - A supplier SIRET + **IBAN** (required) - A recipient SIRET - Invoice lines (description, quantity, net price)  **Simplified format example**: ```json {   \"number\": \"FACT-2025-001\",   \"supplier\": {     \"siret\": \"92019522900017\",     \"iban\": \"FR7630001007941234567890185\"   },   \"recipient\": {\"siret\": \"35600000000048\"},   \"lines\": [     {\"description\": \"Service\", \"quantity\": 10, \"unitPrice\": 100.00, \"vatRate\": 20.0}   ] } ```  **⚠️ Required fields (simplified format)**: - `number`: Unique invoice number - `supplier.siret`: Supplier's SIRET (14 digits) - `supplier.iban`: Bank account IBAN (no public API to retrieve it) - `recipient.siret`: Recipient's SIRET - `lines[]`: At least one invoice line  **What happens automatically with `auto_enrich=True`**: - ✅ Name enrichment from Chorus Pro API - ✅ Address enrichment from Business Search API (free, public) - ✅ Automatic intra-EU VAT calculation (FR + key + SIREN) - ✅ Chorus Pro ID retrieval for electronic invoicing - ✅ Net/VAT/Gross totals calculation - ✅ Date generation (today + 30-day due date) - ✅ Multi-rate VAT handling  **Supported identifiers**: - SIRET (14 digits): Specific establishment ⭐ Recommended - SIREN (9 digits): Company (auto-selection of headquarters) - Special types: UE_HORS_FRANCE, RIDET, TAHITI, etc.  ## Checks performed during generation  ### 1. Data validation (Pydantic) - Data types (amounts as Decimal, ISO 8601 dates) - Formats (14-digit SIRET, 9-digit SIREN, IBAN) - Required fields per profile - Amount consistency (Net + VAT = Gross)  ### 2. CII-compliant XML generation - Serialization according to Cross Industry Invoice XSD schema - Correct UN/CEFACT namespaces - Hierarchical structure respected - UTF-8 encoding without BOM  ### 3. Schematron validation - Business rules for selected profile (MINIMUM, BASIC, EN16931, EXTENDED) - Element cardinality (required, optional, repeatable) - Calculation rules (totals, VAT, discounts) - European EN 16931 compliance  ### 4. PDF/A-3 conversion (if output_format='pdf') - Source PDF conversion to PDF/A-3 via Ghostscript - Factur-X XML embedding in PDF - Compliant XMP metadata - ICC sRGB color profile - Removal of forbidden elements (JavaScript, forms)  ## How it works  1. **Submission**: Invoice is queued in Celery for asynchronous processing 2. **Immediate return**: You receive a `task_id` (HTTP 202 Accepted) 3. **Tracking**: Use the `/tasks/{task_id}/status` endpoint to track progress  ## Webhook notification (recommended)  Instead of polling, you can receive a webhook notification when the task completes:  ``` callback_url=https://your-server.com/webhook ```  The webhook will POST a JSON payload with: - `event_type`: `generation.completed` or `generation.failed` - `data.task_id`: The Celery task ID - `data.content_b64` or `data.xml_content`: The generated content - `X-Webhook-Signature` header for HMAC verification  See `/docs/WEBHOOKS.md` for full documentation.  ## Output formats  - **xml**: Generates only Factur-X XML (recommended for testing) - **pdf**: Generates PDF/A-3 with embedded XML (requires `source_pdf`)  ## Factur-X profiles  - **MINIMUM**: Minimal data (simplified invoice) - **BASIC**: Basic information (SMEs) - **EN16931**: European standard (recommended, compliant with directive 2014/55/EU) - **EXTENDED**: All available data (large accounts)  ## What you get  After successful processing (status `completed`): - **XML only**: Base64-encoded Factur-X compliant XML file - **PDF/A-3**: PDF with embedded XML, ready for sending/archiving - **Metadata**: Profile, Factur-X version, file size - **Validation**: Schematron compliance confirmation  ## Validation  Data is automatically validated according to detected format. On error, a 422 status is returned with invalid field details.

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


$apiInstance = new FactPulse\SDK\Api\FacturXGenerationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$invoice_data = 'invoice_data_example'; // string | Invoice data in JSON format.              Two formats accepted:             1. **Classic format**: Complete FacturXInvoice structure (all fields)             2. **Simplified format** (🆕 P0.1): Minimal structure with auto-enrichment              Format is detected automatically!
$profile = new \FactPulse\SDK\Model\APIProfile(); // \FactPulse\SDK\Model\APIProfile | Factur-X profile: MINIMUM, BASIC, EN16931 or EXTENDED.
$output_format = new \FactPulse\SDK\Model\OutputFormat(); // \FactPulse\SDK\Model\OutputFormat | Output format: 'xml' (XML only) or 'pdf' (Factur-X PDF with embedded XML).
$auto_enrich = true; // bool | 🆕 Enable auto-enrichment from SIRET/SIREN (simplified format only)
$source_pdf = '/path/to/file.txt'; // \SplFileObject
$callback_url = 'callback_url_example'; // string
$webhook_mode = 'inline'; // string | Webhook content delivery: 'inline' (base64 in payload) or 'download_url' (temporary URL, 1h TTL)
$skip_br_fr = True; // bool

try {
    $result = $apiInstance->generateInvoiceApiV1ProcessingGenerateInvoicePost($invoice_data, $profile, $output_format, $auto_enrich, $source_pdf, $callback_url, $webhook_mode, $skip_br_fr);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXGenerationApi->generateInvoiceApiV1ProcessingGenerateInvoicePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **invoice_data** | **string**| Invoice data in JSON format.              Two formats accepted:             1. **Classic format**: Complete FacturXInvoice structure (all fields)             2. **Simplified format** (🆕 P0.1): Minimal structure with auto-enrichment              Format is detected automatically! | |
| **profile** | [**\FactPulse\SDK\Model\APIProfile**](../Model/APIProfile.md)| Factur-X profile: MINIMUM, BASIC, EN16931 or EXTENDED. | [optional] |
| **output_format** | [**\FactPulse\SDK\Model\OutputFormat**](../Model/OutputFormat.md)| Output format: &#39;xml&#39; (XML only) or &#39;pdf&#39; (Factur-X PDF with embedded XML). | [optional] |
| **auto_enrich** | **bool**| 🆕 Enable auto-enrichment from SIRET/SIREN (simplified format only) | [optional] [default to true] |
| **source_pdf** | **\SplFileObject****\SplFileObject**|  | [optional] |
| **callback_url** | **string**|  | [optional] |
| **webhook_mode** | **string**| Webhook content delivery: &#39;inline&#39; (base64 in payload) or &#39;download_url&#39; (temporary URL, 1h TTL) | [optional] [default to &#39;inline&#39;] |
| **skip_br_fr** | **bool**|  | [optional] |

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

## `submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost()`

```php
submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost($submit_complete_invoice_request): \FactPulse\SDK\Model\SubmitCompleteInvoiceResponse
```

Submit a complete invoice (generation + signature + submission)

Unified endpoint to submit a complete invoice to different destinations.     **Facture prête pour Flux 2** - Génère une facture Factur-X complète avec signature optionnelle et soumission vers Chorus Pro ou PDP AFNOR.      **Automated workflow:**     1. **Auto-enrichment** (optional): retrieves data via public APIs and Chorus Pro/AFNOR     2. **Factur-X PDF generation**: creates a PDF/A-3 with embedded XML     3. **Electronic signature** (optional): signs the PDF with a certificate     4. **Submission**: sends to the chosen destination (Chorus Pro or AFNOR PDP)      **Supported destinations:**     - **Chorus Pro**: French B2G platform (invoices to public sector)     - **AFNOR PDP**: Partner Dematerialization Platforms      **Destination credentials - 2 modes available:**      **Mode 1 - Retrieval via JWT (recommended):**     - Credentials are retrieved automatically via the JWT `client_uid`     - Do not provide the `credentials` field in `destination`     - Zero-trust architecture: no secrets in the payload     - Example: `\"destination\": {\"type\": \"chorus_pro\"}`      **Mode 2 - Credentials in the payload:**     - Provide credentials directly in the payload     - Useful for tests or third-party integrations     - Example: `\"destination\": {\"type\": \"chorus_pro\", \"credentials\": {...}}`       **Electronic signature (optional) - 2 modes available:**      **Mode 1 - Stored certificate (recommended):**     - Certificate is retrieved automatically via the JWT `client_uid`     - No key to provide in the payload     - PAdES-B-LT signature with timestamp (eIDAS compliant)     - Example: `\"signature\": {\"reason\": \"Factur-X compliance\"}`      **Mode 2 - Keys in the payload (for tests):**     - Provide `key_pem` and `cert_pem` directly     - PEM format accepted: raw or base64     - Useful for tests or special cases without stored certificate     - Example: `\"signature\": {\"key_pem\": \"-----BEGIN...\", \"cert_pem\": \"-----BEGIN...\"}`      If `key_pem` and `cert_pem` are provided → Mode 2     Otherwise → Mode 1 (certificate retrieved via `client_uid`)

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


$apiInstance = new FactPulse\SDK\Api\FacturXGenerationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_complete_invoice_request = new \FactPulse\SDK\Model\SubmitCompleteInvoiceRequest(); // \FactPulse\SDK\Model\SubmitCompleteInvoiceRequest

try {
    $result = $apiInstance->submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost($submit_complete_invoice_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXGenerationApi->submitCompleteInvoiceApiV1ProcessingInvoicesSubmitCompletePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_complete_invoice_request** | [**\FactPulse\SDK\Model\SubmitCompleteInvoiceRequest**](../Model/SubmitCompleteInvoiceRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SubmitCompleteInvoiceResponse**](../Model/SubmitCompleteInvoiceResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost()`

```php
submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost($submit_complete_invoice_request, $callback_url, $webhook_mode): \FactPulse\SDK\Model\TaskResponse
```

Submit a complete invoice (asynchronous with Celery)

Asynchronous version of the `/invoices/submit-complete` endpoint using Celery for background processing.     **Facture prête pour Flux 2** - Génère une facture Factur-X complète de manière asynchrone.      **Automated workflow (same as synchronous version):**     1. **Auto-enrichment** (optional): retrieves data via public APIs and Chorus Pro/AFNOR     2. **Factur-X PDF generation**: creates a PDF/A-3 with embedded XML     3. **Electronic signature** (optional): signs the PDF with a certificate     4. **Submission**: sends to the chosen destination (Chorus Pro or AFNOR PDP)      **Supported destinations:**     - **Chorus Pro**: French B2G platform (invoices to public sector)     - **AFNOR PDP**: Partner Dematerialization Platforms      **Differences with synchronous version:**     - ✅ **Non-blocking**: Returns immediately with a `task_id` (HTTP 202 Accepted)     - ✅ **Background processing**: Invoice is processed by a Celery worker     - ✅ **Progress tracking**: Use `/tasks/{task_id}/status` to track status     - ✅ **Ideal for high volumes**: Allows processing many invoices in parallel      **How to use:**     1. **Submission**: Call this endpoint with your invoice data     2. **Immediate return**: You receive a `task_id` (e.g., \"abc123-def456\")     3. **Tracking**: Call `/tasks/{task_id}/status` to check progress     4. **Result**: When `status = \"SUCCESS\"`, the `result` field contains the complete response      **Webhook notification (recommended):**      Instead of polling, add `?callback_url=https://your-server.com/webhook` to receive automatic notification:     - `event_type`: `submission.completed`, `submission.failed`, or `submission.partial`     - `data.submission_result`: Complete submission result     - `X-Webhook-Signature` header for HMAC verification      **Credentials and signature**: Same modes as the synchronous version (JWT or payload).

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


$apiInstance = new FactPulse\SDK\Api\FacturXGenerationApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$submit_complete_invoice_request = new \FactPulse\SDK\Model\SubmitCompleteInvoiceRequest(); // \FactPulse\SDK\Model\SubmitCompleteInvoiceRequest
$callback_url = 'callback_url_example'; // string | Webhook URL for async notification when submission completes.
$webhook_mode = 'inline'; // string | Webhook content delivery: 'inline' (base64 in payload) or 'download_url' (temporary URL, 1h TTL)

try {
    $result = $apiInstance->submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost($submit_complete_invoice_request, $callback_url, $webhook_mode);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling FacturXGenerationApi->submitCompleteInvoiceAsyncApiV1ProcessingInvoicesSubmitCompleteAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **submit_complete_invoice_request** | [**\FactPulse\SDK\Model\SubmitCompleteInvoiceRequest**](../Model/SubmitCompleteInvoiceRequest.md)|  | |
| **callback_url** | **string**| Webhook URL for async notification when submission completes. | [optional] |
| **webhook_mode** | **string**| Webhook content delivery: &#39;inline&#39; (base64 in payload) or &#39;download_url&#39; (temporary URL, 1h TTL) | [optional] [default to &#39;inline&#39;] |

### Return type

[**\FactPulse\SDK\Model\TaskResponse**](../Model/TaskResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
