# # ConversionTaskStatusResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** |  | [optional] [default to 'ERROR']
**conversion_id** | **string** |  |
**document_type_code** | **int** |  |
**profile** | **string** |  |
**extraction** | [**\FactPulse\SDK\Model\ConversionExtractionInfo**](ConversionExtractionInfo.md) |  |
**processing_time_ms** | **int** |  |
**pdf_regenerated** | **bool** |  | [optional] [default to false]
**pdf_regenerated_reason** | **string** |  | [optional]
**content_b64** | **string** |  | [optional]
**xml_content** | **string** |  | [optional]
**message** | **string** |  |
**missing_fields** | **string[]** |  |
**extracted_data** | **array<string,mixed>** |  |
**confidence_score** | **float** |  |
**validation_errors** | **array<string,mixed>[]** |  | [optional]
**correction_attempted** | **bool** |  | [optional] [default to false]
**error_code** | **string** |  |
**error_message** | **string** |  |
**details** | [**\FactPulse\SDK\Model\AFNORErrorDetail[]**](AFNORErrorDetail.md) |  | [optional]
**traceback** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
