# # ReponseVerificationSucces

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**est_conforme** | **bool** | True si aucun écart critique |
**score_conformite** | **float** | Score de conformité (0-100%) |
**champs_verifies** | **int** | Nombre de champs vérifiés | [optional] [default to 0]
**champs_conformes** | **int** | Nombre de champs conformes | [optional] [default to 0]
**est_facturx** | **bool** | True si le PDF contient du XML Factur-X | [optional] [default to false]
**profil_facturx** | **string** |  | [optional]
**champs** | [**\FactPulse\SDK\Model\ChampVerifieSchema[]**](ChampVerifieSchema.md) | Liste des champs vérifiés avec valeurs, statuts et coordonnées PDF | [optional]
**notes_obligatoires** | [**\FactPulse\SDK\Model\NoteObligatoireSchema[]**](NoteObligatoireSchema.md) | Notes obligatoires (PMT, PMD, AAB) avec localisation PDF | [optional]
**dimensions_pages** | [**\FactPulse\SDK\Model\DimensionPageSchema[]**](DimensionPageSchema.md) | Dimensions de chaque page du PDF (largeur, hauteur) | [optional]
**avertissements** | **string[]** | Avertissements non bloquants | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
