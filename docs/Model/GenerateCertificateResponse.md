# # GenerateCertificateResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Statut de l&#39;opération | [optional] [default to 'success']
**certificat_pem** | **string** | Certificat X.509 au format PEM |
**cle_privee_pem** | **string** | Clé privée RSA au format PEM |
**pkcs12_base64** | **string** |  | [optional]
**info** | [**\FactPulse\SDK\Model\CertificateInfoResponse**](CertificateInfoResponse.md) | Informations sur le certificat généré |
**avertissement** | **string** | Avertissement sur l&#39;utilisation du certificat | [optional] [default to '⚠️ Ce certificat est AUTO-SIGNÉ et destiné uniquement aux TESTS. Ne PAS utiliser en production. Niveau eIDAS : SES (Simple Electronic Signature)']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
