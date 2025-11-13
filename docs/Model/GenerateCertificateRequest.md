# # GenerateCertificateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**cn** | **string** | Common Name (CN) - Nom du certificat | [optional] [default to 'Test Signature FactPulse']
**organisation** | **string** | Organisation (O) | [optional] [default to 'FactPulse Test']
**pays** | **string** | Code pays ISO 2 lettres (C) | [optional] [default to 'FR']
**ville** | **string** | Ville (L) | [optional] [default to 'Paris']
**province** | **string** | Province/État (ST) | [optional] [default to 'Ile-de-France']
**email** | **string** |  | [optional]
**duree_jours** | **int** | Durée de validité en jours | [optional] [default to 365]
**taille_cle** | **int** | Taille de la clé RSA en bits | [optional] [default to 2048]
**passphrase_cle** | **string** |  | [optional]
**generer_p12** | **bool** | Générer aussi un fichier PKCS#12 (.p12) | [optional] [default to false]
**passphrase_p12** | **string** | Passphrase pour le fichier PKCS#12 | [optional] [default to 'changeme']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
