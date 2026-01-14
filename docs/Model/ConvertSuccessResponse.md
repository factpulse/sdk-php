# # ConvertSuccessResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Statut de la conversion | [optional] [default to 'success']
**conversion_id** | **string** | Identifiant unique de conversion |
**document_type** | [**\FactPulse\SDK\Model\DocumentTypeInfo**](DocumentTypeInfo.md) |  |
**invoice** | **array<string,mixed>** | Donnees facture au format FacturXInvoice (cf. models.py) |
**extraction** | [**\FactPulse\SDK\Model\ExtractionInfo**](ExtractionInfo.md) |  |
**validation** | [**\FactPulse\SDK\Model\ValidationInfo**](ValidationInfo.md) |  |
**files** | [**\FactPulse\SDK\Model\FilesInfo**](FilesInfo.md) |  |
**processing_time_ms** | **int** | Temps de traitement en ms |
**pdf_regenerated** | **bool** | True si le PDF a ete regenere (source non exploitable) | [optional] [default to false]
**pdf_regenerated_reason** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
