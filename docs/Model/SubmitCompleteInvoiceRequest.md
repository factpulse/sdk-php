# SubmitCompleteInvoiceRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_data** | **array<string,mixed>** | Invoice data, in either of the two accepted formats (detected automatically, same rule as /generate-invoice): 1. **Simplified format**: &#x60;number&#x60; + &#x60;lines&#x60;, with auto-enrichment. Any field of the complete model may be added on top. 2. **Complete format**: full &#x60;FacturXInvoice&#x60; structure, recognised by the presence of &#x60;invoiceLines&#x60;. No auto-enrichment of totals. |
**source_pdf** | **string** | Base64-encoded source PDF (will be transformed to Factur-X) |
**destination** | [**\FactPulse\SDK\Model\Destination**](Destination.md) |  |
**signature** | [**\FactPulse\SDK\Model\SignatureParameters**](SignatureParameters.md) |  | [optional]
**options** | [**\FactPulse\SDK\Model\ProcessingOptions**](ProcessingOptions.md) | Processing options | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
