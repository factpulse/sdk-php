# # SimplifiedInvoiceData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**number** | **string** | Unique invoice number |
**supplier** | **array<string,mixed>** | Supplier information (siret, iban, ...) |
**recipient** | **array<string,mixed>** | Recipient information (siret, ...) |
**lines** | **array<string,mixed>[]** | Invoice lines |
**date** | **string** |  | [optional]
**due_days** | **int** | Due date in days (default: 30) | [optional] [default to 30]
**comment** | **string** |  | [optional]
**purchase_order_reference** | **string** |  | [optional]
**contract_reference** | **string** |  | [optional]
**invoice_type** | [**\OpenAPI\Client\Model\FactureElectroniqueModelsInvoiceTypeCode**](FactureElectroniqueModelsInvoiceTypeCode.md) | Document type (UNTDID 1001). Default: 380 (Invoice). | [optional]
**preceding_invoice_reference** | **string** |  | [optional]
**operation_nature** | [**\OpenAPI\Client\Model\OperationNature**](OperationNature.md) |  | [optional]
**invoicing_framework** | [**\OpenAPI\Client\Model\InvoicingFrameworkCode**](InvoicingFrameworkCode.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
