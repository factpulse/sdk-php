# SimplifiedInvoiceData

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**number** | **string** | Unique invoice number |
**supplier** | **array<string,mixed>** | Supplier information (siret, iban, bic, routingAddress, ...). For a seller without an intra-community VAT number (VAT franchise, article 293 B of the CGI), provide &#x60;taxRegistrationId&#x60; (BT-32, usually the SIREN): it satisfies BR-E-02 and prevents BT-31 from being auto-calculated. |
**recipient** | **array<string,mixed>** | Recipient information (siret, vatNumber for BT-48, ...) |
**lines** | **array<string,mixed>[]** | Invoice lines |
**date** | **string** |  | [optional]
**due_days** | **int** | Due date in days (default: 30) | [optional] [default to 30]
**comment** | **string** |  | [optional]
**purchase_order_reference** | **string** |  | [optional]
**contract_reference** | **string** |  | [optional]
**invoice_type** | [**\FactPulse\SDK\Model\FactureElectroniqueModelsInvoiceTypeCode**](FactureElectroniqueModelsInvoiceTypeCode.md) | Document type (UNTDID 1001). Default: 380 (Invoice). | [optional]
**preceding_invoice_reference** | **string** |  | [optional]
**operation_nature** | [**\FactPulse\SDK\Model\OperationNature**](OperationNature.md) |  | [optional]
**invoicing_framework** | [**\FactPulse\SDK\Model\InvoicingFrameworkCode**](InvoicingFrameworkCode.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
