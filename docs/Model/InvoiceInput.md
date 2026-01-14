# # InvoiceInput

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_id** | **string** | Invoice identifier |
**issue_date** | **\DateTime** | Invoice issue date |
**type_code** | [**\OpenAPI\Client\Model\FactureElectroniqueRestApiSchemasEreportingInvoiceTypeCode**](FactureElectroniqueRestApiSchemasEreportingInvoiceTypeCode.md) | Invoice type code | [optional]
**currency** | [**\OpenAPI\Client\Model\Currency**](Currency.md) |  | [optional]
**due_date** | **\DateTime** |  | [optional]
**seller_siren** | **string** | Seller SIREN/SIRET |
**seller_vat_id** | **string** |  | [optional]
**seller_country** | [**\OpenAPI\Client\Model\Sellercountry**](Sellercountry.md) |  | [optional]
**buyer_id** | **string** |  | [optional]
**buyer_vat_id** | **string** |  | [optional]
**buyer_country** | [**\OpenAPI\Client\Model\Buyercountry**](Buyercountry.md) |  |
**tax_exclusive_amount** | [**\OpenAPI\Client\Model\Taxexclusiveamount1**](Taxexclusiveamount1.md) |  |
**tax_amount** | [**\OpenAPI\Client\Model\Taxamount1**](Taxamount1.md) |  |
**tax_breakdown** | [**\OpenAPI\Client\Model\TaxBreakdownInput[]**](TaxBreakdownInput.md) | VAT breakdown |
**referenced_invoice_id** | **string** |  | [optional]
**referenced_invoice_date** | **\DateTime** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
