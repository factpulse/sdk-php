# # FacturXInvoice

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_number** | **string** |  |
**payment_due_date** | **string** |  |
**invoice_date** | **string** |  | [optional]
**submission_mode** | [**\OpenAPI\Client\Model\SubmissionMode**](SubmissionMode.md) |  |
**recipient** | [**\OpenAPI\Client\Model\Recipient**](Recipient.md) |  |
**supplier** | [**\OpenAPI\Client\Model\Supplier**](Supplier.md) |  |
**invoicing_framework** | [**\OpenAPI\Client\Model\InvoicingFramework**](InvoicingFramework.md) |  |
**references** | [**\OpenAPI\Client\Model\InvoiceReferences**](InvoiceReferences.md) |  |
**totals** | [**\OpenAPI\Client\Model\InvoiceTotals**](InvoiceTotals.md) |  |
**invoice_lines** | [**\OpenAPI\Client\Model\InvoiceLine[]**](InvoiceLine.md) |  | [optional]
**vat_lines** | [**\OpenAPI\Client\Model\VATLine[]**](VATLine.md) |  | [optional]
**notes** | [**\OpenAPI\Client\Model\InvoiceNote[]**](InvoiceNote.md) |  | [optional]
**comment** | **string** |  | [optional]
**current_user_id** | **int** |  | [optional]
**supplementary_attachments** | [**\OpenAPI\Client\Model\SupplementaryAttachment[]**](SupplementaryAttachment.md) |  | [optional]
**payee** | [**\OpenAPI\Client\Model\Payee**](Payee.md) |  | [optional]
**delivery_party** | [**\OpenAPI\Client\Model\DeliveryParty**](DeliveryParty.md) |  | [optional]
**tax_representative** | [**\OpenAPI\Client\Model\TaxRepresentative**](TaxRepresentative.md) |  | [optional]
**delivery_date** | **string** |  | [optional]
**billing_period_start** | **string** |  | [optional]
**billing_period_end** | **string** |  | [optional]
**payment_reference** | **string** |  | [optional]
**creditor_reference_id** | **string** |  | [optional]
**direct_debit_mandate_id** | **string** |  | [optional]
**debtor_iban** | **string** |  | [optional]
**payment_terms** | **string** |  | [optional]
**allowances_charges** | [**\OpenAPI\Client\Model\AllowanceCharge[]**](AllowanceCharge.md) |  | [optional]
**additional_documents** | [**\OpenAPI\Client\Model\AdditionalDocument[]**](AdditionalDocument.md) |  | [optional]
**buyer_accounting_reference** | **string** |  | [optional]
**payment_card** | [**\OpenAPI\Client\Model\PaymentCard**](PaymentCard.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
