# # SubmitCompleteInvoiceResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**success** | **bool** | Invoice was successfully submitted |
**destination_type** | **string** | Destination type |
**chorus_result** | [**\FactPulse\SDK\Model\ChorusProResult**](ChorusProResult.md) |  | [optional]
**afnor_result** | [**\FactPulse\SDK\Model\AFNORResult**](AFNORResult.md) |  | [optional]
**enriched_invoice** | [**\FactPulse\SDK\Model\EnrichedInvoiceInfo**](EnrichedInvoiceInfo.md) | Enriched invoice data |
**facturx_pdf** | [**\FactPulse\SDK\Model\FacturXPDFInfo**](FacturXPDFInfo.md) | Generated PDF information |
**signature** | [**\FactPulse\SDK\Model\SignatureInfo**](SignatureInfo.md) |  | [optional]
**pdf_base64** | **string** | Generated Factur-X PDF (and signed if requested) base64-encoded |
**message** | **string** | Return message |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
