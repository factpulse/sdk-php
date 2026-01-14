# # IncomingInvoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**flow_id** | **string** |  | [optional]
**source_format** | [**\FactPulse\SDK\Model\InvoiceFormat**](InvoiceFormat.md) | Invoice source format |
**supplier_reference** | **string** | Invoice number issued by the supplier (BT-1) |
**document_type** | [**\FactPulse\SDK\Model\InvoiceTypeCodeOutput**](InvoiceTypeCodeOutput.md) | Document type (BT-3) | [optional]
**supplier** | [**\FactPulse\SDK\Model\IncomingSupplier**](IncomingSupplier.md) | Invoice issuer (SellerTradeParty) |
**billing_site_name** | **string** | Recipient name / your company (BT-44) |
**billing_site_siret** | **string** |  | [optional]
**issue_date** | **string** | Invoice date (BT-2) - YYYY-MM-DD |
**due_date** | **string** |  | [optional]
**currency** | **string** | ISO currency code (BT-5) | [optional] [default to 'EUR']
**net_amount** | **string** | Total net amount (BT-109) |
**vat_amount** | **string** | Total VAT amount (BT-110) |
**gross_amount** | **string** | Total gross amount (BT-112) |
**purchase_order_number** | **string** |  | [optional]
**contract_reference** | **string** |  | [optional]
**invoice_subject** | **string** |  | [optional]
**document_base64** | **string** |  | [optional]
**document_content_type** | **string** |  | [optional]
**document_filename** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
