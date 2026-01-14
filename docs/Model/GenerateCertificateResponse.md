# # GenerateCertificateResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**status** | **string** | Operation status | [optional] [default to 'success']
**certificate_pem** | **string** | X.509 certificate in PEM format |
**private_key_pem** | **string** | RSA private key in PEM format |
**pkcs12_base64** | **string** |  | [optional]
**info** | [**\OpenAPI\Client\Model\CertificateInfoResponse**](CertificateInfoResponse.md) | Generated certificate information |
**warning** | **string** | Warning about certificate usage | [optional] [default to 'WARNING: This certificate is SELF-SIGNED and intended for TESTING only. DO NOT use in production. eIDAS level: SES (Simple Electronic Signature)']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
