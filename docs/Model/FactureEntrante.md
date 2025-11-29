# # FactureEntrante

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**flow_id** | **string** |  | [optional]
**format_source** | [**\FactPulse\SDK\Model\FormatFacture**](FormatFacture.md) | Format source de la facture |
**ref_fournisseur** | **string** | Numéro de facture émis par le fournisseur (BT-1) |
**type_document** | [**\FactPulse\SDK\Model\TypeDocument**](TypeDocument.md) | Type de document (BT-3) | [optional]
**fournisseur** | [**\FactPulse\SDK\Model\FournisseurEntrant**](FournisseurEntrant.md) | Émetteur de la facture (SellerTradeParty) |
**site_facturation_nom** | **string** | Nom du destinataire / votre entreprise (BT-44) |
**site_facturation_siret** | **string** |  | [optional]
**date_de_piece** | **string** | Date de la facture (BT-2) - YYYY-MM-DD |
**date_reglement** | **string** |  | [optional]
**devise** | **string** | Code devise ISO (BT-5) | [optional] [default to 'EUR']
**montant_ht** | **string** | Montant HT total (BT-109) |
**montant_tva** | **string** | Montant TVA total (BT-110) |
**montant_ttc** | **string** | Montant TTC total (BT-112) |
**numero_bon_commande** | **string** |  | [optional]
**reference_contrat** | **string** |  | [optional]
**objet_facture** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
