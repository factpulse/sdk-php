# # GenerateCertificateRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**cn** | **string** | Common Name (CN) - Certificate name | [optional] [default to 'Test Signature FactPulse']
**organization** | **string** | Organization (O) | [optional] [default to 'FactPulse Test']
**country** | **string** | ISO 2-letter country code (C) | [optional] [default to 'FR']
**city** | **string** | City (L) | [optional] [default to 'Paris']
**state** | **string** | State/Province (ST) | [optional] [default to 'Ile-de-France']
**email** | **string** |  | [optional]
**validity_days** | **int** | Validity duration in days | [optional] [default to 365]
**key_size** | **int** | RSA key size in bits | [optional] [default to 2048]
**key_passphrase** | **string** |  | [optional]
**generate_p12** | **bool** | Also generate a PKCS#12 (.p12) file | [optional] [default to false]
**p12_passphrase** | **string** | Passphrase for PKCS#12 file | [optional] [default to 'changeme']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
