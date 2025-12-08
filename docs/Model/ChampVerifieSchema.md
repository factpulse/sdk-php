# # ChampVerifieSchema

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**business_term** | **string** | Business Term EN16931 (ex: BT-1) |
**label** | **string** | Libellé du champ (ex: N° Facture) |
**valeur_pdf** | **string** |  | [optional]
**valeur_xml** | **string** |  | [optional]
**statut** | [**\FactPulse\SDK\Model\StatutChampAPI**](StatutChampAPI.md) | Statut de conformité |
**message** | **string** |  | [optional]
**confiance** | **float** | Score de confiance (0-1) | [optional] [default to 1.0]
**source** | **string** | Source d&#39;extraction | [optional] [default to 'pdf_natif']
**bbox** | [**\FactPulse\SDK\Model\BoundingBoxSchema**](BoundingBoxSchema.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
