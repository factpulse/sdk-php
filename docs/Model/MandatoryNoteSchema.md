# # MandatoryNoteSchema

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**subject_code** | **string** | Subject code (PMT, PMD, AAB) |
**label** | **string** | Label (e.g., Recovery indemnity) |
**pdf_value** | **string** |  | [optional]
**xml_value** | **string** |  | [optional]
**status** | [**\OpenAPI\Client\Model\FieldStatus**](FieldStatus.md) | Compliance status (COMPLIANT if XML found in PDF) | [optional]
**message** | **string** |  | [optional]
**bbox** | [**\OpenAPI\Client\Model\BoundingBoxSchema**](BoundingBoxSchema.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
