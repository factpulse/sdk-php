# # VerifiedFieldSchema

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**business_term** | **string** | EN16931 Business Term (e.g., BT-1) |
**label** | **string** | Field label (e.g., Invoice Number) |
**pdf_value** | **string** |  | [optional]
**xml_value** | **string** |  | [optional]
**status** | [**\OpenAPI\Client\Model\FieldStatus**](FieldStatus.md) | Compliance status |
**message** | **string** |  | [optional]
**confidence** | **float** | Confidence score (0-1) | [optional] [default to 1.0]
**source** | **string** | Extraction source | [optional] [default to 'native_pdf']
**bbox** | [**\OpenAPI\Client\Model\BoundingBoxSchema**](BoundingBoxSchema.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
