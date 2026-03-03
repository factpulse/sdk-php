# # AFNORFlow

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tracking_id** | **string** | The tracking id is an external identifier and is used to track the flow by the sender | [optional]
**name** | **string** | Name of the file |
**processing_rule** | [**\FactPulse\SDK\Model\AFNORProcessingRule**](AFNORProcessingRule.md) |  | [optional]
**flow_syntax** | [**\FactPulse\SDK\Model\AFNORFlowSyntax**](AFNORFlowSyntax.md) |  |
**flow_profile** | [**\FactPulse\SDK\Model\AFNORFlowProfile**](AFNORFlowProfile.md) |  | [optional]
**flow_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose |
**submitted_at** | **\DateTime** | The flow submission date and time (the date and time when the flow was created on the system) This property should be used by the API consumer as a time reference to avoid clock synchronization issues |
**updated_at** | **\DateTime** | The last update date and time of the flow. When the flow is submitted updatedAt is equal to submittedAt. When the flow acknowledgment status is changed updatedAt date and time is updated. |
**flow_type** | [**\FactPulse\SDK\Model\AFNORFlowType**](AFNORFlowType.md) |  |
**processing_rule_source** | **string** | Says whether the processing rule has been computed or the processing rule was an input parameter |
**flow_direction** | [**\FactPulse\SDK\Model\AFNORFlowDirection**](AFNORFlowDirection.md) |  |
**acknowledgement** | [**\FactPulse\SDK\Model\AFNORAcknowledgement**](AFNORAcknowledgement.md) |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
