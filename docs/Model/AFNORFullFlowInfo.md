# # AFNORFullFlowInfo

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**flow_id** | **string** | Unique identifier supporting UUID but not only, for flexibility purpose |
**submitted_at** | **\DateTime** | The flow submission date and time (the date and time when the flow was created on the system) This property should be used by the API consumer as a time reference to avoid clock synchronization issues |
**tracking_id** | **string** | The tracking id is an external identifier and is used to track the flow by the sender | [optional]
**name** | **string** | Name of the file |
**processing_rule** | [**\FactPulse\SDK\Model\AFNORProcessingRule**](AFNORProcessingRule.md) |  | [optional]
**flow_syntax** | [**\FactPulse\SDK\Model\AFNORFlowSyntax**](AFNORFlowSyntax.md) |  |
**flow_profile** | [**\FactPulse\SDK\Model\AFNORFlowProfile**](AFNORFlowProfile.md) |  | [optional]
**sha256** | **string** | The sha256 is the fingerprint of the attached file: - if provided in the request: it should be checked once received - if not provided in the request: it may be computed and returned in the response | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
