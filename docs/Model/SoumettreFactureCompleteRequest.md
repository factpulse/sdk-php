# # SoumettreFactureCompleteRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**donnees_facture** | [**\FactPulse\SDK\Model\DonneesFactureSimplifiees**](DonneesFactureSimplifiees.md) | Données de la facture au format simplifié (voir exemples) |
**pdf_source** | **string** | PDF source encodé en base64 (sera transformé en Factur-X) |
**destination** | [**\FactPulse\SDK\Model\Destination**](Destination.md) |  |
**signature** | [**\FactPulse\SDK\Model\ParametresSignature**](ParametresSignature.md) |  | [optional]
**options** | [**\FactPulse\SDK\Model\OptionsProcessing**](OptionsProcessing.md) | Options de traitement | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
