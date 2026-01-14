# # SubmitInvoiceRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**credentials** | [**\OpenAPI\Client\Model\ChorusProCredentials**](ChorusProCredentials.md) |  | [optional]
**invoice_number** | **string** | Invoice number |
**invoice_date** | **string** | Invoice date (ISO format: YYYY-MM-DD) |
**payment_due_date** | **string** |  | [optional]
**structure_id** | **int** | Chorus Pro recipient structure ID |
**service_code** | **string** |  | [optional]
**engagement_number** | **string** |  | [optional]
**total_net_amount** | [**\OpenAPI\Client\Model\SubmitNetAmount**](SubmitNetAmount.md) |  |
**vat_amount** | [**\OpenAPI\Client\Model\SubmitVatAmount**](SubmitVatAmount.md) |  |
**total_gross_amount** | [**\OpenAPI\Client\Model\SubmitGrossAmount**](SubmitGrossAmount.md) |  |
**main_attachment_id** | **int** |  | [optional]
**main_attachment_label** | **string** |  | [optional]
**comment** | **string** |  | [optional]
**purchase_order_reference** | **string** |  | [optional]
**contract_reference** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
