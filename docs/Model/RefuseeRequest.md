# # RefuseeRequest

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
**reason_code** | **string** | Code motif du refus (obligatoire). Valeurs autorisées: TX_TVA_ERR, MONTANTTOTAL_ERR, CALCUL_ERR, NON_CONFORME, DOUBLON, DEST_ERR, TRANSAC_INC, EMMET_INC, CONTRAT_TERM, DOUBLE_FACT, CMD_ERR, ADR_ERR, REF_CT_ABSENT |
**reason_text** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
