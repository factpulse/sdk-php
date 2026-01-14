# # ProcessingOptions

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**facturx_profile** | [**\FactPulse\SDK\Model\APIProfile**](APIProfile.md) | Factur-X profile to use | [optional]
**auto_enrich** | **bool** | Auto-enrich data (Company APIs, Chorus Pro, etc.) | [optional] [default to true]
**validate_xml** | **bool** | Validate Factur-X XML with Schematron | [optional] [default to true]
**verify_destination_parameters** | **bool** | Verify required parameters for destination (e.g., service_code for Chorus) | [optional] [default to true]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
