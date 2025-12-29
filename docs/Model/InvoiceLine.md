# # InvoiceLine

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**line_number** | **int** | Invoice line identifier (BT-126). |
**line_note** | **string** |  | [optional]
**reference** | **string** |  | [optional]
**buyer_assigned_id** | **string** |  | [optional]
**product_global_id** | **string** |  | [optional]
**product_global_id_scheme** | **string** |  | [optional]
**item_name** | **string** | Item name (BT-153). |
**item_description** | **string** |  | [optional]
**origin_country** | **string** |  | [optional]
**characteristics** | [**\FactPulse\SDK\Model\ProductCharacteristic[]**](ProductCharacteristic.md) |  | [optional]
**classifications** | [**\FactPulse\SDK\Model\ProductClassification[]**](ProductClassification.md) |  | [optional]
**quantity** | [**\FactPulse\SDK\Model\Quantity**](Quantity.md) |  |
**unit** | [**\FactPulse\SDK\Model\UnitOfMeasure**](UnitOfMeasure.md) | Invoiced quantity unit of measure code (BT-130). |
**gross_unit_price** | [**\FactPulse\SDK\Model\GrossUnitPrice**](GrossUnitPrice.md) |  | [optional]
**unit_net_price** | [**\FactPulse\SDK\Model\UnitNetPrice**](UnitNetPrice.md) |  |
**price_basis_quantity** | [**\FactPulse\SDK\Model\PriceBasisQuantity**](PriceBasisQuantity.md) |  | [optional]
**price_basis_unit** | **string** |  | [optional]
**price_allowance_amount** | [**\FactPulse\SDK\Model\PriceAllowanceAmount**](PriceAllowanceAmount.md) |  | [optional]
**line_net_amount** | [**\FactPulse\SDK\Model\LineNetAmount**](LineNetAmount.md) |  | [optional]
**allowance_amount** | [**\FactPulse\SDK\Model\InvoiceLineAllowanceAmount**](InvoiceLineAllowanceAmount.md) |  | [optional]
**allowance_reason_code** | [**\FactPulse\SDK\Model\AllowanceReasonCode**](AllowanceReasonCode.md) |  | [optional]
**allowance_reason** | **string** |  | [optional]
**allowances_charges** | [**\FactPulse\SDK\Model\AllowanceCharge[]**](AllowanceCharge.md) |  | [optional]
**vat_rate** | **string** |  | [optional]
**manual_vat_rate** | [**\FactPulse\SDK\Model\ManualVatRate**](ManualVatRate.md) |  | [optional]
**vat_category** | [**\FactPulse\SDK\Model\VATCategory**](VATCategory.md) |  | [optional]
**period_start_date** | **string** |  | [optional]
**period_end_date** | **string** |  | [optional]
**purchase_order_line_ref** | **string** |  | [optional]
**accounting_account** | **string** |  | [optional]
**additional_documents** | [**\FactPulse\SDK\Model\AdditionalDocument[]**](AdditionalDocument.md) |  | [optional]
**line_notes** | [**\FactPulse\SDK\Model\InvoiceNote[]**](InvoiceNote.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
