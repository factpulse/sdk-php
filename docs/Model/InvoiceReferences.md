# # InvoiceReferences

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**business_process_id** | **string** |  | [optional]
**invoice_currency** | **string** | Invoice currency code (BT-5). ISO 4217. | [optional] [default to 'EUR']
**payment_means** | [**\OpenAPI\Client\Model\PaymentMeans**](PaymentMeans.md) | Payment means type code (BT-81). |
**payment_means_text** | **string** |  | [optional]
**invoice_type** | [**\OpenAPI\Client\Model\InvoiceTypeCode**](InvoiceTypeCode.md) |  |
**vat_accounting_code** | [**\OpenAPI\Client\Model\VATAccountingCode**](VATAccountingCode.md) | VAT accounting code. |
**buyer_reference** | **string** |  | [optional]
**contract_reference** | **string** |  | [optional]
**purchase_order_reference** | **string** |  | [optional]
**seller_order_reference** | **string** |  | [optional]
**receiving_advice_reference** | **string** |  | [optional]
**despatch_advice_reference** | **string** |  | [optional]
**tender_reference** | **string** |  | [optional]
**preceding_invoice_reference** | **string** |  | [optional]
**preceding_invoice_date** | **string** |  | [optional]
**project_reference** | **string** |  | [optional]
**project_name** | **string** |  | [optional]
**vat_exemption_reason** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
