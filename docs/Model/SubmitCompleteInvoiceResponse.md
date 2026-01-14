# # SubmitCompleteInvoiceResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**success** | **bool** | Invoice was successfully submitted |
**destination_type** | **string** | Destination type |
**chorus_result** | [**\OpenAPI\Client\Model\ChorusProResult**](ChorusProResult.md) |  | [optional]
**afnor_result** | [**\OpenAPI\Client\Model\AFNORResult**](AFNORResult.md) |  | [optional]
**enriched_invoice** | [**\OpenAPI\Client\Model\EnrichedInvoiceInfo**](EnrichedInvoiceInfo.md) | Enriched invoice data |
**facturx_pdf** | [**\OpenAPI\Client\Model\FacturXPDFInfo**](FacturXPDFInfo.md) | Generated PDF information |
**signature** | [**\OpenAPI\Client\Model\SignatureInfo**](SignatureInfo.md) |  | [optional]
**pdf_base64** | **string** | Generated Factur-X PDF (and signed if requested) base64-encoded |
**message** | **string** | Return message |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
