# # ConvertValidationFailedResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** |  | [optional] [default to 'validation_failed']
**conversion_id** | **string** |  |
**message** | **string** |  | [optional] [default to 'Donnees extraites avec erreurs de validation. Completez le formulaire et appelez /resume.']
**extraction** | [**\FactPulse\SDK\Model\ExtractionInfo**](ExtractionInfo.md) |  |
**extracted_data** | **array<string,mixed>** | Donnees extraites par OCR au format FacturXInvoice (a completer/corriger) |
**missing_fields** | [**\FactPulse\SDK\Model\MissingField[]**](MissingField.md) | Champs manquants pour conformite Factur-X | [optional]
**validation** | [**\FactPulse\SDK\Model\ValidationInfo**](ValidationInfo.md) |  |
**resume_url** | **string** | URL pour reprendre la conversion avec corrections |
**expires_at** | **\DateTime** | Expiration de la conversion (1h) |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
