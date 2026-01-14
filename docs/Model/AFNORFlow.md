# # AFNORFlow

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**submitted_at** | **\DateTime** | The flow submission date and time (the date and time when the flow was created on the system) | [optional]
**updated_at** | **\DateTime** | The last update date and time of the flow. When the flow is submitted updatedAt is equal to submittedAt. When the flow acknowledgment status is changed updatedAt date and time is updated. | [optional]
**flow_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose | [optional]
**tracking_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose | [optional]
**flow_type** | [**\OpenAPI\Client\Model\AFNORFlowType**](AFNORFlowType.md) |  | [optional]
**processing_rule** | [**\OpenAPI\Client\Model\AFNORProcessingRule**](AFNORProcessingRule.md) |  | [optional]
**processing_rule_source** | **string** | Says whether the processing rule has been computed or the processing rule was an input parameter | [optional]
**flow_direction** | [**\OpenAPI\Client\Model\AFNORFlowDirection**](AFNORFlowDirection.md) |  | [optional]
**flow_syntax** | [**\OpenAPI\Client\Model\AFNORFlowSyntax**](AFNORFlowSyntax.md) |  | [optional]
**flow_profile** | [**\OpenAPI\Client\Model\AFNORFlowProfile**](AFNORFlowProfile.md) |  | [optional]
**acknowledgement** | [**\OpenAPI\Client\Model\AFNORAcknowledgement**](AFNORAcknowledgement.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
