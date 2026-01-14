# # InvoiceLine

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**line_number** | **int** | Invoice line identifier (BT-126). |
**line_note** | **string** |  | [optional]
**parent_line_id** | **string** |  | [optional]
**line_sub_type** | [**\OpenAPI\Client\Model\LineSubType**](LineSubType.md) |  | [optional]
**reference** | **string** |  | [optional]
**buyer_assigned_id** | **string** |  | [optional]
**product_global_id** | **string** |  | [optional]
**product_global_id_scheme** | **string** |  | [optional]
**item_name** | **string** | Item name (BT-153). |
**item_description** | **string** |  | [optional]
**origin_country** | **string** |  | [optional]
**characteristics** | [**\OpenAPI\Client\Model\ProductCharacteristic[]**](ProductCharacteristic.md) |  | [optional]
**classifications** | [**\OpenAPI\Client\Model\ProductClassification[]**](ProductClassification.md) |  | [optional]
**quantity** | [**\OpenAPI\Client\Model\Quantity**](Quantity.md) |  |
**unit** | [**\OpenAPI\Client\Model\UnitOfMeasure**](UnitOfMeasure.md) | Invoiced quantity unit of measure code (BT-130). |
**gross_unit_price** | [**\OpenAPI\Client\Model\GrossUnitPrice**](GrossUnitPrice.md) |  | [optional]
**unit_net_price** | [**\OpenAPI\Client\Model\UnitNetPrice**](UnitNetPrice.md) |  |
**price_basis_quantity** | [**\OpenAPI\Client\Model\PriceBasisQuantity**](PriceBasisQuantity.md) |  | [optional]
**price_basis_unit** | **string** |  | [optional]
**price_allowance_amount** | [**\OpenAPI\Client\Model\PriceAllowanceAmount**](PriceAllowanceAmount.md) |  | [optional]
**line_net_amount** | [**\OpenAPI\Client\Model\LineNetAmount**](LineNetAmount.md) |  | [optional]
**allowance_amount** | [**\OpenAPI\Client\Model\InvoiceLineAllowanceAmount**](InvoiceLineAllowanceAmount.md) |  | [optional]
**allowance_reason_code** | [**\OpenAPI\Client\Model\AllowanceReasonCode**](AllowanceReasonCode.md) |  | [optional]
**allowance_reason** | **string** |  | [optional]
**allowances_charges** | [**\OpenAPI\Client\Model\AllowanceCharge[]**](AllowanceCharge.md) |  | [optional]
**vat_rate** | **string** |  | [optional]
**manual_vat_rate** | [**\OpenAPI\Client\Model\ManualVatRate**](ManualVatRate.md) |  | [optional]
**vat_category** | [**\OpenAPI\Client\Model\VATCategory**](VATCategory.md) |  | [optional]
**period_start_date** | **string** |  | [optional]
**period_end_date** | **string** |  | [optional]
**purchase_order_line_ref** | **string** |  | [optional]
**accounting_account** | **string** |  | [optional]
**additional_documents** | [**\OpenAPI\Client\Model\AdditionalDocument[]**](AdditionalDocument.md) |  | [optional]
**line_notes** | [**\OpenAPI\Client\Model\InvoiceNote[]**](InvoiceNote.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
