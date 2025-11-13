# # ResultatValidationPDFAPI

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**est_conforme** | **bool** | True si le PDF est conforme à tous les critères (XML, PDF/A, XMP) |
**xml_present** | **bool** | True si un XML Factur-X est embarqué dans le PDF |
**xml_conforme** | **bool** | True si le XML Factur-X est conforme aux règles Schematron |
**profil_detecte** | **string** |  | [optional]
**erreurs_xml** | **string[]** | Liste des erreurs de validation XML | [optional]
**pdfa_conforme** | **bool** | True si le PDF est conforme PDF/A |
**version_pdfa** | **string** |  | [optional]
**methode_validation_pdfa** | **string** | Méthode utilisée pour la validation PDF/A (metadata ou verapdf) | [optional] [default to 'metadata']
**regles_validees** | **int** |  | [optional]
**regles_echouees** | **int** |  | [optional]
**erreurs_pdfa** | **string[]** | Liste des erreurs de conformité PDF/A | [optional]
**avertissements_pdfa** | **string[]** | Liste des avertissements PDF/A | [optional]
**xmp_present** | **bool** | True si des métadonnées XMP sont présentes |
**xmp_conforme_facturx** | **bool** | True si les métadonnées XMP contiennent des informations Factur-X |
**profil_xmp** | **string** |  | [optional]
**version_xmp** | **string** |  | [optional]
**erreurs_xmp** | **string[]** | Liste des erreurs de métadonnées XMP | [optional]
**metadonnees_xmp** | **array<string,mixed>** | Métadonnées XMP extraites du PDF | [optional]
**est_signe** | **bool** | True si le PDF contient au moins une signature |
**nombre_signatures** | **int** | Nombre de signatures électroniques trouvées | [optional] [default to 0]
**signatures** | [**\FactPulse\SDK\Model\InformationSignatureAPI[]**](InformationSignatureAPI.md) | Liste des signatures trouvées avec leurs informations | [optional]
**erreurs_signatures** | **string[]** | Liste des erreurs lors de l&#39;analyse des signatures | [optional]
**message_resume** | **string** | Message résumant le résultat de la validation |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
