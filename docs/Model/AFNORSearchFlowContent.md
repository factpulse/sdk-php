# AFNORSearchFlowContent

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**limit** | **int** | Pagination, Maximum number of results that may be returned | [optional] [default to 25]
**next_cursor** | **string** | Pagination management: - If present, says where to start for next page, set nextCursor as the cursor in the next request - If omitted, says that pagination is finished | [optional]
**filters** | [**\FactPulse\SDK\Model\AFNORSearchFlowFilters**](AFNORSearchFlowFilters.md) |  | [optional]
**results** | [**\FactPulse\SDK\Model\AFNORFlow[]**](AFNORFlow.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
