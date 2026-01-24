# # EncaisseeRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoice_id** | **string** | Identifiant de la facture (BT-1) |
**invoice_issue_date** | **\DateTime** | Date d&#39;émission de la facture (YYYY-MM-DD) |
**invoice_buyer_siren** | **string** | SIREN de l&#39;acheteur (destinataire du statut) |
**invoice_buyer_electronic_address** | **string** | Adresse électronique de l&#39;acheteur (MDT-73) |
**amount** | [**\FactPulse\SDK\Model\Amount**](Amount.md) |  |
**currency** | **string** | Code devise ISO 4217 | [optional] [default to 'EUR']
**sender_siren** | **string** |  | [optional]
**flow_type** | **string** | Type de flux (CustomerInvoiceLC pour facture émise) | [optional] [default to 'CustomerInvoiceLC']
**pdp_flow_service_url** | **string** |  | [optional]
**pdp_token_url** | **string** |  | [optional]
**pdp_client_id** | **string** |  | [optional]
**pdp_client_secret** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
