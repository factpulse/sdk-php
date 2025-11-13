# # SoumettreFactureCompleteResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**succes** | **bool** | La facture a été soumise avec succès |
**destination_type** | **string** | Type de destination |
**resultat_chorus** | [**\FactPulse\SDK\Model\ResultatChorusPro**](ResultatChorusPro.md) |  | [optional]
**resultat_afnor** | [**\FactPulse\SDK\Model\ResultatAFNOR**](ResultatAFNOR.md) |  | [optional]
**facture_enrichie** | [**\FactPulse\SDK\Model\FactureEnrichieInfoOutput**](FactureEnrichieInfoOutput.md) | Données de la facture enrichie |
**pdf_facturx** | [**\FactPulse\SDK\Model\PDFFacturXInfo**](PDFFacturXInfo.md) | Informations sur le PDF généré |
**signature** | [**\FactPulse\SDK\Model\SignatureInfo**](SignatureInfo.md) |  | [optional]
**pdf_base64** | **string** | PDF Factur-X généré (et signé si demandé) encodé en base64 |
**message** | **string** | Message de retour |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
