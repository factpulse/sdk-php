# # CreateCDARRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**document_id** | **string** | Identifiant unique du message CDAR |
**business_process** | **string** | Code processus métier (REGULATED, B2C, B2BINT, etc.) | [optional] [default to 'REGULATED']
**type_code** | **string** | Type de message (23&#x3D;Traitement, 305&#x3D;Transmission) | [optional] [default to '23']
**sender_siren** | **string** | SIREN de l&#39;émetteur (9 chiffres) |
**sender_role** | **string** | Rôle de l&#39;émetteur (WK, SE, BY, etc.) | [optional] [default to 'WK']
**sender_name** | **string** |  | [optional]
**sender_email** | **string** |  | [optional]
**recipients** | [**\FactPulse\SDK\Model\RecipientInput[]**](RecipientInput.md) | Liste des destinataires | [optional]
**invoice_id** | **string** | Identifiant de la facture (BT-1) |
**invoice_issue_date** | **\DateTime** | Date d&#39;émission de la facture (YYYY-MM-DD) |
**invoice_type_code** | **string** | Type de document (380&#x3D;Facture, 381&#x3D;Avoir) | [optional] [default to '380']
**invoice_seller_siren** | **string** |  | [optional]
**invoice_buyer_siren** | **string** |  | [optional]
**status** | **string** | Code statut de la facture (200-601) |
**reason_code** | **string** |  | [optional]
**reason_text** | **string** |  | [optional]
**action_code** | **string** |  | [optional]
**encaisse_amount** | [**\FactPulse\SDK\Model\Encaisseamount**](Encaisseamount.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
