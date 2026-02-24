# FactPulse\SDK\ReferencesApi

## 📚 Reference Data  **Endpoints for accessing reference data (code lists, enumerations).**  ### Available references  - **VATEX codes**: VAT exemption reason codes from the Peppol BIS Billing 3.0 code list

All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getVatexCodesApiV1ReferencesVatexCodesGet()**](ReferencesApi.md#getVatexCodesApiV1ReferencesVatexCodesGet) | **GET** /api/v1/references/vatex-codes | VATEX exemption reason codes |


## `getVatexCodesApiV1ReferencesVatexCodesGet()`

```php
getVatexCodesApiV1ReferencesVatexCodesGet($category): \FactPulse\SDK\Model\VATEXCodesResponse
```

VATEX exemption reason codes

Returns the list of VATEX (VAT exemption reason) codes from the Peppol BIS Billing 3.0 code list. Source: https://docs.peppol.eu/poacc/billing/3.0/codelist/vatex/

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



$apiInstance = new FactPulse\SDK\Api\ReferencesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$category = 'category_example'; // string | Filter by VAT category code (E, AE, K, G, O).

try {
    $result = $apiInstance->getVatexCodesApiV1ReferencesVatexCodesGet($category);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ReferencesApi->getVatexCodesApiV1ReferencesVatexCodesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **category** | **string**| Filter by VAT category code (E, AE, K, G, O). | [optional] |

### Return type

[**\FactPulse\SDK\Model\VATEXCodesResponse**](../Model/VATEXCodesResponse.md)

### Authorization

No authorization required

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
