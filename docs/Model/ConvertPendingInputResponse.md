# # ConvertPendingInputResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** |  | [optional] [default to 'pending_input']
**conversion_id** | **string** |  |
**message** | **string** |  | [optional] [default to 'Donnees manquantes requises pour la conformite']
**extraction** | [**\FactPulse\SDK\Model\ExtractionInfo**](ExtractionInfo.md) |  |
**extracted_data** | **array<string,mixed>** | Donnees extraites par OCR au format FacturXInvoice |
**missing_fields** | [**\FactPulse\SDK\Model\MissingField[]**](MissingField.md) |  |
**resume_url** | **string** |  |
**expires_at** | **\DateTime** |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
