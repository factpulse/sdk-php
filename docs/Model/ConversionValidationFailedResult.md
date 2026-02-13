# # ConversionValidationFailedResult

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** |  | [optional] [default to 'VALIDATION_FAILED']
**conversion_id** | **string** |  |
**message** | **string** |  |
**extracted_data** | **array<string,mixed>** |  |
**extraction** | [**\FactPulse\SDK\Model\ConversionExtractionInfo**](ConversionExtractionInfo.md) |  | [optional]
**validation_errors** | **array<string,mixed>[]** |  | [optional]
**profile** | **string** |  |
**processing_time_ms** | **int** |  |
**correction_attempted** | **bool** |  | [optional] [default to false]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
