# # AFNORFullFlowInfo

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**tracking_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose | [optional]
**name** | **string** | Name of the file | [optional]
**processing_rule** | [**\FactPulse\SDK\Model\AFNORProcessingRule**](AFNORProcessingRule.md) |  | [optional]
**flow_syntax** | [**\FactPulse\SDK\Model\AFNORFlowSyntax**](AFNORFlowSyntax.md) |  |
**flow_profile** | [**\FactPulse\SDK\Model\AFNORFlowProfile**](AFNORFlowProfile.md) |  | [optional]
**sha256** | **string** |  | [optional]
**flow_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose | [optional]
**submitted_at** | **\DateTime** | The flow submission date and time (the date and time when the flow was created on the system) This property should be used by the API consumer as a time reference to avoid clock synchronization issues | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
