# # CertificateInfoResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**cn** | **string** | Common Name |
**organisation** | **string** | Organisation |
**pays** | **string** | Code pays |
**ville** | **string** | Ville |
**province** | **string** | Province |
**email** | **string** |  | [optional]
**sujet** | **string** | Sujet complet (RFC4514) |
**emetteur** | **string** | Émetteur (auto-signé &#x3D; même que sujet) |
**numero_serie** | **int** | Numéro de série du certificat |
**valide_du** | **string** | Date de début de validité (ISO 8601) |
**valide_au** | **string** | Date de fin de validité (ISO 8601) |
**algorithme** | **string** | Algorithme de signature |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
