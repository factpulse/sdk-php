# # AFNORRoutingCodePayloadHistoryLegalUnitFacility

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**routing_identifier** | **string** | Routing identifier od a routing code. | [optional]
**siret** | **string** | SIRET Number | [optional]
**routing_identifier_type** | **string** | Routing Identifier type. | [optional]
**routing_code_name** | **string** | Name of the directory line routing code. This attribute is only returned if the directory line is defined at the SIREN / SIRET / Routing code mesh. | [optional]
**manages_legal_commitment_code** | **bool** | Indicates whether the public structure requires a legal commitment number. This attribute is only returned if the directory line is defined for a public structure at the SIREN / SIRET or SIREN / SIRET / Routing code level. | [optional]
**administrative_status** | [**\OpenAPI\Client\Model\AFNORRoutingCodeAdministrativeStatus**](AFNORRoutingCodeAdministrativeStatus.md) |  | [optional]
**address** | [**\OpenAPI\Client\Model\AFNORAddressRead**](AFNORAddressRead.md) |  | [optional]
**legal_unit** | [**\OpenAPI\Client\Model\AFNORLegalUnitPayloadIncluded**](AFNORLegalUnitPayloadIncluded.md) |  | [optional]
**facility** | [**\OpenAPI\Client\Model\AFNORFacilityPayloadIncluded**](AFNORFacilityPayloadIncluded.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
