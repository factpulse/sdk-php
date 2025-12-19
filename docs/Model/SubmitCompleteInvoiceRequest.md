# # SubmitCompleteInvoiceRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_data** | [**\FactPulse\SDK\Model\SimplifiedInvoiceData**](SimplifiedInvoiceData.md) | Invoice data in simplified format (see examples) |
**source_pdf** | **string** | Base64-encoded source PDF (will be transformed to Factur-X) |
**destination** | [**\FactPulse\SDK\Model\Destination**](Destination.md) |  |
**signature** | [**\FactPulse\SDK\Model\SignatureParameters**](SignatureParameters.md) |  | [optional]
**options** | [**\FactPulse\SDK\Model\ProcessingOptions**](ProcessingOptions.md) | Processing options | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
