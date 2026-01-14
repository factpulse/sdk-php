# # AFNORCreateRoutingCodeBody

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**facility_nature** | [**\FactPulse\SDK\Model\AFNORFacilityNature**](AFNORFacilityNature.md) |  |
**routing_identifier** | **string** | Routing identifier od a routing code. |
**siret** | **string** | SIRET Number |
**routing_identifier_type** | **string** | Routing Identifier type. | [optional]
**routing_code_name** | **string** | Name of the directory line routing code. This attribute is only returned if the directory line is defined at the SIREN / SIRET / Routing code mesh. |
**manages_legal_commitment_code** | **bool** | Indicates whether the public structure requires a legal commitment number. This attribute is only returned if the directory line is defined for a public structure at the SIREN / SIRET or SIREN / SIRET / Routing code level. | [optional]
**administrative_status** | [**\FactPulse\SDK\Model\AFNORRoutingCodeAdministrativeStatus**](AFNORRoutingCodeAdministrativeStatus.md) |  |
**address** | [**\FactPulse\SDK\Model\AFNORAddressEdit**](AFNORAddressEdit.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
