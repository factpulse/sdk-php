# # SignatureParameters

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**key_pem** | **string** |  | [optional]
**cert_pem** | **string** |  | [optional]
**key_passphrase** | **string** |  | [optional]
**reason** | **string** |  | [optional]
**location** | **string** |  | [optional]
**contact** | **string** |  | [optional]
**field_name** | **string** | PDF signature field name | [optional] [default to 'FactPulseSignature']
**use_pades_lt** | **bool** | Enable PAdES-B-LT (long-term archival). REQUIRES certificate with OCSP/CRL access | [optional] [default to false]
**use_timestamp** | **bool** | Enable RFC 3161 timestamping with FreeTSA (PAdES-B-T) | [optional] [default to true]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
