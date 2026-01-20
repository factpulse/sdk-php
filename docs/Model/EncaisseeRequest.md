# # EncaisseeRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_id** | **string** | Identifiant de la facture (BT-1) |
**invoice_issue_date** | **\DateTime** | Date d&#39;émission de la facture (YYYY-MM-DD) |
**sender_siren** | **string** |  | [optional]
**flow_type** | **string** | Type de flux: SupplierInvoiceLC (acheteur) ou CustomerInvoiceLC (vendeur) | [optional] [default to 'SupplierInvoiceLC']
**pdp_flow_service_url** | **string** |  | [optional]
**pdp_token_url** | **string** |  | [optional]
**pdp_client_id** | **string** |  | [optional]
**pdp_client_secret** | **string** |  | [optional]
**amount** | [**\FactPulse\SDK\Model\Amount**](Amount.md) |  |
**currency** | **string** | Code devise ISO 4217 | [optional] [default to 'EUR']

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
