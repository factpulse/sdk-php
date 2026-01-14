# # InvoicePaymentInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_id** | **string** | Invoice identifier |
**invoice_date** | **\DateTime** | Original invoice date |
**payment_date** | **\DateTime** | Payment date |
**currency** | [**\OpenAPI\Client\Model\Currency**](Currency.md) |  | [optional]
**amounts_by_rate** | [**\OpenAPI\Client\Model\PaymentAmountByRate[]**](PaymentAmountByRate.md) | Payment amounts by VAT rate |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
