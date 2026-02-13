# # ParseFacturXResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Parsing status |
**invoice** | **array<string,mixed>** | Parsed invoice data. For CII/Factur-X: FacturXInvoice format (round-trip with /generate-invoice). For UBL: IncomingInvoice format (summary extraction). |
**detected_format** | **string** |  | [optional]
**detected_profile** | **string** |  | [optional]
**error** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
