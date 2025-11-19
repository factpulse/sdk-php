# # LigneDePoste

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**numero** | **int** |  |
**reference** | **string** |  | [optional]
**denomination** | **string** |  |
**quantite** | [**\FactPulse\SDK\Model\Quantite**](Quantite.md) |  |
**unite** | [**\FactPulse\SDK\Model\Unite**](Unite.md) |  |
**montant_unitaire_ht** | [**\FactPulse\SDK\Model\MontantUnitaireHt**](MontantUnitaireHt.md) |  |
**montant_remise_ht** | **float** | Montant de la remise HT. | [optional]
**montant_total_ligne_ht** | **float** | Montant total HT de la ligne (quantité × prix unitaire - remise). | [optional]
**taux_tva** | **string** |  | [optional]
**taux_tva_manuel** | **float** | Taux de TVA avec valeur manuelle. | [optional]
**categorie_tva** | [**\FactPulse\SDK\Model\CategorieTVA**](CategorieTVA.md) |  | [optional]
**date_debut_periode** | **string** |  | [optional]
**date_fin_periode** | **string** |  | [optional]
**code_raison_reduction** | [**\FactPulse\SDK\Model\CodeRaisonReduction**](CodeRaisonReduction.md) |  | [optional]
**raison_reduction** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
