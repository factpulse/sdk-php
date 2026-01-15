# # VerificationSuccessResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**is_compliant** | **bool** | True if no critical discrepancy |
**compliance_score** | **float** | Compliance score (0-100%) |
**verified_fields_count** | **int** | Number of verified fields | [optional] [default to 0]
**compliant_fields_count** | **int** | Number of compliant fields | [optional] [default to 0]
**is_facturx** | **bool** | True if PDF contains Factur-X XML | [optional] [default to false]
**facturx_profile** | **string** |  | [optional]
**fields** | [**\FactPulse\SDK\Model\VerifiedFieldSchema[]**](VerifiedFieldSchema.md) | List of verified fields with values, statuses and PDF coordinates | [optional]
**mandatory_notes** | [**\FactPulse\SDK\Model\MandatoryNoteSchema[]**](MandatoryNoteSchema.md) | Mandatory notes (PMT, PMD, AAB) with PDF location | [optional]
**page_dimensions** | [**\FactPulse\SDK\Model\PageDimensionsSchema[]**](PageDimensionsSchema.md) | Dimensions of each PDF page (width, height) | [optional]
**warnings** | **string[]** | Non-blocking warnings | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
