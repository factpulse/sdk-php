# # AggregatedTransactionInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**date** | **\DateTime** | Transaction date (TT-77) |
**category_code** | [**\OpenAPI\Client\Model\TransactionCategory**](TransactionCategory.md) | Transaction category code (TT-81). Use TLB1 for goods, TPS1 for services. |
**currency** | [**\OpenAPI\Client\Model\Currency**](Currency.md) |  | [optional]
**tax_exclusive_amount** | [**\OpenAPI\Client\Model\Taxexclusiveamount**](Taxexclusiveamount.md) |  |
**tax_amount** | [**\OpenAPI\Client\Model\Taxamount**](Taxamount.md) |  |
**tax_breakdown** | [**\OpenAPI\Client\Model\TaxBreakdownInput[]**](TaxBreakdownInput.md) | VAT breakdown by rate |
**transaction_count** | **int** |  | [optional]
**tax_due_type** | [**\OpenAPI\Client\Model\TaxDueDateType**](TaxDueDateType.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
