# # ParametresSignature

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**key_pem** | **string** |  | [optional]
**cert_pem** | **string** |  | [optional]
**key_passphrase** | **string** |  | [optional]
**raison** | **string** |  | [optional]
**localisation** | **string** |  | [optional]
**contact** | **string** |  | [optional]
**field_name** | **string** | Nom du champ de signature PDF | [optional] [default to 'FactPulseSignature']
**use_pades_lt** | **bool** | Activer PAdES-B-LT (archivage long terme). NÉCESSITE certificat avec accès OCSP/CRL | [optional] [default to false]
**use_timestamp** | **bool** | Activer l&#39;horodatage RFC 3161 avec FreeTSA (PAdES-B-T) | [optional] [default to true]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
