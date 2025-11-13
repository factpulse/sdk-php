# # SoumettreFactureRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**credentials** | [**\FactPulse\SDK\Model\ChorusProCredentials**](ChorusProCredentials.md) |  | [optional]
**numero_facture** | **string** | Numéro de la facture |
**date_facture** | **string** | Date de facture (format ISO: YYYY-MM-DD) |
**date_echeance_paiement** | **string** |  | [optional]
**id_structure_cpp** | **int** | ID Chorus Pro de la structure destinataire |
**code_service** | **string** |  | [optional]
**numero_engagement** | **string** |  | [optional]
**montant_ht_total** | [**\FactPulse\SDK\Model\MontantHtTotal1**](MontantHtTotal1.md) |  |
**montant_tva** | [**\FactPulse\SDK\Model\MontantTva1**](MontantTva1.md) |  |
**montant_ttc_total** | [**\FactPulse\SDK\Model\MontantTtcTotal1**](MontantTtcTotal1.md) |  |
**piece_jointe_principale_id** | **int** |  | [optional]
**piece_jointe_principale_designation** | **string** |  | [optional]
**commentaire** | **string** |  | [optional]
**numero_bon_commande** | **string** |  | [optional]
**numero_marche** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
