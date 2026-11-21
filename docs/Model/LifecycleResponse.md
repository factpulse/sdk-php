# LifecycleResponse

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**invoices** | [**\FactPulse\SDK\Model\InvoiceLifecycle[]**](InvoiceLifecycle.md) | Cycles de vie par facture | [optional]
**total_invoices** | **int** | Nombre de factures |
**cutoff_days** | **int** | Nombre de jours de la fenetre de recherche |
**total_flows** | **int** | Nombre de flux de statut (CDAR) lus sur la PA | [optional] [default to 0]
**truncated** | **bool** | True si la limite de flux lus par appel a ete atteinte : la reponse est incomplete, reduire la fenetre (dateFrom/dateTo ou days) | [optional] [default to false]
**date_from** | **string** |  | [optional]
**date_to** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
