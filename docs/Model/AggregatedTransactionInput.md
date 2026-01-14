# # AggregatedTransactionInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**date** | **\DateTime** | Transaction date (TT-77) |
**category_code** | [**\FactPulse\SDK\Model\TransactionCategory**](TransactionCategory.md) | Transaction category code (TT-81). Use TLB1 for goods, TPS1 for services. |
**currency** | [**\FactPulse\SDK\Model\Currency**](Currency.md) |  | [optional]
**tax_exclusive_amount** | [**\FactPulse\SDK\Model\Taxexclusiveamount**](Taxexclusiveamount.md) |  |
**tax_amount** | [**\FactPulse\SDK\Model\Taxamount**](Taxamount.md) |  |
**tax_breakdown** | [**\FactPulse\SDK\Model\TaxBreakdownInput[]**](TaxBreakdownInput.md) | VAT breakdown by rate |
**transaction_count** | **int** |  | [optional]
**tax_due_type** | [**\FactPulse\SDK\Model\TaxDueDateType**](TaxDueDateType.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
