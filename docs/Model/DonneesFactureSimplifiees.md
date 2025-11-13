# # DonneesFactureSimplifiees

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**numero** | **string** | Numéro de facture unique |
**emetteur** | **array<string,mixed>** | Informations sur l&#39;émetteur (siret, iban, ...) |
**destinataire** | **array<string,mixed>** | Informations sur le destinataire (siret, ...) |
**lignes** | **array<string,mixed>[]** | Lignes de la facture |
**date** | **string** |  | [optional]
**echeance_jours** | **int** | Échéance en jours (défaut: 30) | [optional] [default to 30]
**commentaire** | **string** |  | [optional]
**numero_bon_commande** | **string** |  | [optional]
**numero_marche** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
