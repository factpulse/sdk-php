# # SearchFlowRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**updated_after** | **\DateTime** |  | [optional]
**updated_before** | **\DateTime** |  | [optional]
**flow_types** | [**\FactPulse\SDK\Model\FlowType[]**](FlowType.md) |  | [optional]
**flow_directions** | [**\FactPulse\SDK\Model\FlowDirection[]**](FlowDirection.md) |  | [optional]
**tracking_id** | **string** |  | [optional]
**flow_id** | **string** |  | [optional]
**acknowledgment_status** | [**\FactPulse\SDK\Model\AcknowledgmentStatus**](AcknowledgmentStatus.md) |  | [optional]
**offset** | **int** | Offset for pagination | [optional] [default to 0]
**limit** | **int** | Maximum number of results (max 100) | [optional] [default to 25]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
