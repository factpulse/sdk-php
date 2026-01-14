# # PDFValidationResultAPI

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**is_compliant** | **bool** | True if PDF complies with all criteria (XML, PDF/A, XMP) |
**xml_present** | **bool** | True if a Factur-X XML is embedded in the PDF |
**xml_compliant** | **bool** | True if Factur-X XML complies with Schematron rules |
**detected_profile** | **string** |  | [optional]
**xml_errors** | **string[]** | List of XML validation errors | [optional]
**pdfa_compliant** | **bool** | True if PDF is PDF/A compliant |
**pdfa_version** | **string** |  | [optional]
**pdfa_validation_method** | **string** | Method used for PDF/A validation (metadata or verapdf) | [optional] [default to 'metadata']
**validated_rules** | **int** |  | [optional]
**failed_rules** | **int** |  | [optional]
**pdfa_errors** | **string[]** | List of PDF/A compliance errors | [optional]
**pdfa_warnings** | **string[]** | List of PDF/A warnings | [optional]
**xmp_present** | **bool** | True if XMP metadata is present |
**xmp_facturx_compliant** | **bool** | True if XMP metadata contains Factur-X information |
**xmp_profile** | **string** |  | [optional]
**xmp_version** | **string** |  | [optional]
**xmp_errors** | **string[]** | List of XMP metadata errors | [optional]
**xmp_metadata** | **array<string,mixed>** | XMP metadata extracted from PDF | [optional]
**is_signed** | **bool** | True if PDF contains at least one signature |
**signature_count** | **int** | Number of electronic signatures found | [optional] [default to 0]
**signatures** | [**\FactPulse\SDK\Model\SignatureInfoAPI[]**](SignatureInfoAPI.md) | List of found signatures with their information | [optional]
**signature_errors** | **string[]** | List of errors during signature analysis | [optional]
**summary_message** | **string** | Message summarizing the validation result |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
