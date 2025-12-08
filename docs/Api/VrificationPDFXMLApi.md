# FactPulse\SDK\VrificationPDFXMLApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet()**](VrificationPDFXMLApi.md#obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet) | **GET** /api/v1/verification/verifier-async/{id_tache}/statut | Obtenir le statut d&#39;une vérification asynchrone |
| [**obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0()**](VrificationPDFXMLApi.md#obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0) | **GET** /api/v1/verification/verifier-async/{id_tache}/statut | Obtenir le statut d&#39;une vérification asynchrone |
| [**verifierPdfAsyncApiV1VerificationVerifierAsyncPost()**](VrificationPDFXMLApi.md#verifierPdfAsyncApiV1VerificationVerifierAsyncPost) | **POST** /api/v1/verification/verifier-async | Vérifier la conformité PDF/XML Factur-X (asynchrone) |
| [**verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0()**](VrificationPDFXMLApi.md#verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0) | **POST** /api/v1/verification/verifier-async | Vérifier la conformité PDF/XML Factur-X (asynchrone) |
| [**verifierPdfSyncApiV1VerificationVerifierPost()**](VrificationPDFXMLApi.md#verifierPdfSyncApiV1VerificationVerifierPost) | **POST** /api/v1/verification/verifier | Vérifier la conformité PDF/XML Factur-X (synchrone) |
| [**verifierPdfSyncApiV1VerificationVerifierPost_0()**](VrificationPDFXMLApi.md#verifierPdfSyncApiV1VerificationVerifierPost_0) | **POST** /api/v1/verification/verifier | Vérifier la conformité PDF/XML Factur-X (synchrone) |


## `obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet()`

```php
obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet($id_tache): \FactPulse\SDK\Model\StatutTache
```

Obtenir le statut d'une vérification asynchrone

Récupère le statut et le résultat d'une tâche de vérification asynchrone.  **Statuts possibles:** - `PENDING`: Tâche en attente dans la file - `STARTED`: Tâche en cours d'exécution - `SUCCESS`: Tâche terminée avec succès (voir `resultat`) - `FAILURE`: Erreur système (exception non gérée)  **Note:** Le champ `resultat.statut` peut être \"SUCCES\" ou \"ERREUR\" indépendamment du statut Celery (qui sera toujours SUCCESS si la tâche s'est exécutée).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_tache = 'id_tache_example'; // string

try {
    $result = $apiInstance->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet($id_tache);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_tache** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\StatutTache**](../Model/StatutTache.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0()`

```php
obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0($id_tache): \FactPulse\SDK\Model\StatutTache
```

Obtenir le statut d'une vérification asynchrone

Récupère le statut et le résultat d'une tâche de vérification asynchrone.  **Statuts possibles:** - `PENDING`: Tâche en attente dans la file - `STARTED`: Tâche en cours d'exécution - `SUCCESS`: Tâche terminée avec succès (voir `resultat`) - `FAILURE`: Erreur système (exception non gérée)  **Note:** Le champ `resultat.statut` peut être \"SUCCES\" ou \"ERREUR\" indépendamment du statut Celery (qui sera toujours SUCCESS si la tâche s'est exécutée).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_tache = 'id_tache_example'; // string

try {
    $result = $apiInstance->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0($id_tache);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->obtenirStatutVerificationApiV1VerificationVerifierAsyncIdTacheStatutGet_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_tache** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\StatutTache**](../Model/StatutTache.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifierPdfAsyncApiV1VerificationVerifierAsyncPost()`

```php
verifierPdfAsyncApiV1VerificationVerifierAsyncPost($fichier_pdf, $forcer_ocr): \FactPulse\SDK\Model\ReponseTache
```

Vérifier la conformité PDF/XML Factur-X (asynchrone)

Vérifie la conformité PDF/XML Factur-X de manière asynchrone.  **IMPORTANT**: Seuls les PDF Factur-X (avec XML embarqué) sont acceptés. Les PDF sans XML Factur-X retourneront une erreur `NOT_FACTURX` dans le résultat.  Cette version utilise une tâche Celery et peut faire appel au service OCR si le PDF est une image ou si `forcer_ocr=true`.  **Retourne immédiatement** un ID de tâche. Utilisez `/verifier-async/{id_tache}/statut` pour récupérer le résultat.  **Principe de vérification (Factur-X 1.08):** - Principe n°2: Le XML ne peut contenir que des infos présentes dans le PDF - Principe n°4: Toute info XML doit être présente et conforme dans le PDF  **Champs vérifiés:** - Identification: BT-1 (n° facture), BT-2 (date), BT-3 (type), BT-5 (devise), BT-23 (cadre) - Vendeur: BT-27 (nom), BT-29 (SIRET), BT-30 (SIREN), BT-31 (TVA) - Acheteur: BT-44 (nom), BT-46 (SIRET), BT-47 (SIREN), BT-48 (TVA) - Montants: BT-109 (HT), BT-110 (TVA), BT-112 (TTC), BT-115 (à payer) - Ventilation TVA: BT-116, BT-117, BT-118, BT-119 - Lignes de facture: BT-153, BT-129, BT-146, BT-131 - Notes obligatoires: PMT, PMD, AAB - Règle BR-FR-09: cohérence SIRET/SIREN  **Avantages par rapport à la version synchrone:** - Support OCR pour les PDF images (via service DocTR) - Timeout plus long pour les gros documents - Ne bloque pas le serveur

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF Factur-X à vérifier
$forcer_ocr = false; // bool | Forcer l'utilisation de l'OCR même si le PDF contient du texte natif

try {
    $result = $apiInstance->verifierPdfAsyncApiV1VerificationVerifierAsyncPost($fichier_pdf, $forcer_ocr);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->verifierPdfAsyncApiV1VerificationVerifierAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF Factur-X à vérifier | |
| **forcer_ocr** | **bool**| Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif | [optional] [default to false] |

### Return type

[**\FactPulse\SDK\Model\ReponseTache**](../Model/ReponseTache.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0()`

```php
verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0($fichier_pdf, $forcer_ocr): \FactPulse\SDK\Model\ReponseTache
```

Vérifier la conformité PDF/XML Factur-X (asynchrone)

Vérifie la conformité PDF/XML Factur-X de manière asynchrone.  **IMPORTANT**: Seuls les PDF Factur-X (avec XML embarqué) sont acceptés. Les PDF sans XML Factur-X retourneront une erreur `NOT_FACTURX` dans le résultat.  Cette version utilise une tâche Celery et peut faire appel au service OCR si le PDF est une image ou si `forcer_ocr=true`.  **Retourne immédiatement** un ID de tâche. Utilisez `/verifier-async/{id_tache}/statut` pour récupérer le résultat.  **Principe de vérification (Factur-X 1.08):** - Principe n°2: Le XML ne peut contenir que des infos présentes dans le PDF - Principe n°4: Toute info XML doit être présente et conforme dans le PDF  **Champs vérifiés:** - Identification: BT-1 (n° facture), BT-2 (date), BT-3 (type), BT-5 (devise), BT-23 (cadre) - Vendeur: BT-27 (nom), BT-29 (SIRET), BT-30 (SIREN), BT-31 (TVA) - Acheteur: BT-44 (nom), BT-46 (SIRET), BT-47 (SIREN), BT-48 (TVA) - Montants: BT-109 (HT), BT-110 (TVA), BT-112 (TTC), BT-115 (à payer) - Ventilation TVA: BT-116, BT-117, BT-118, BT-119 - Lignes de facture: BT-153, BT-129, BT-146, BT-131 - Notes obligatoires: PMT, PMD, AAB - Règle BR-FR-09: cohérence SIRET/SIREN  **Avantages par rapport à la version synchrone:** - Support OCR pour les PDF images (via service DocTR) - Timeout plus long pour les gros documents - Ne bloque pas le serveur

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF Factur-X à vérifier
$forcer_ocr = false; // bool | Forcer l'utilisation de l'OCR même si le PDF contient du texte natif

try {
    $result = $apiInstance->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0($fichier_pdf, $forcer_ocr);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->verifierPdfAsyncApiV1VerificationVerifierAsyncPost_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF Factur-X à vérifier | |
| **forcer_ocr** | **bool**| Forcer l&#39;utilisation de l&#39;OCR même si le PDF contient du texte natif | [optional] [default to false] |

### Return type

[**\FactPulse\SDK\Model\ReponseTache**](../Model/ReponseTache.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifierPdfSyncApiV1VerificationVerifierPost()`

```php
verifierPdfSyncApiV1VerificationVerifierPost($fichier_pdf): \FactPulse\SDK\Model\ReponseVerificationSucces
```

Vérifier la conformité PDF/XML Factur-X (synchrone)

Vérifie la conformité entre le PDF et son XML Factur-X embarqué.  **IMPORTANT**: Seuls les PDF Factur-X (avec XML embarqué) sont acceptés. Les PDF sans XML Factur-X seront rejetés avec une erreur 400.  Cette version synchrone utilise uniquement l'extraction PDF native (pdfplumber). Pour les PDF images nécessitant de l'OCR, utilisez l'endpoint `/verifier-async`.  **Principe de vérification (Factur-X 1.08):** - Principe n°2: Le XML ne peut contenir que des infos présentes dans le PDF - Principe n°4: Toute info XML doit être présente et conforme dans le PDF  **Champs vérifiés:** - Identification: BT-1 (n° facture), BT-2 (date), BT-3 (type), BT-5 (devise), BT-23 (cadre) - Vendeur: BT-27 (nom), BT-29 (SIRET), BT-30 (SIREN), BT-31 (TVA) - Acheteur: BT-44 (nom), BT-46 (SIRET), BT-47 (SIREN), BT-48 (TVA) - Montants: BT-109 (HT), BT-110 (TVA), BT-112 (TTC), BT-115 (à payer) - Ventilation TVA: BT-116, BT-117, BT-118, BT-119 - Lignes de facture: BT-153, BT-129, BT-146, BT-131 - Notes obligatoires: PMT, PMD, AAB - Règle BR-FR-09: cohérence SIRET/SIREN

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF Factur-X à vérifier

try {
    $result = $apiInstance->verifierPdfSyncApiV1VerificationVerifierPost($fichier_pdf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->verifierPdfSyncApiV1VerificationVerifierPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF Factur-X à vérifier | |

### Return type

[**\FactPulse\SDK\Model\ReponseVerificationSucces**](../Model/ReponseVerificationSucces.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `verifierPdfSyncApiV1VerificationVerifierPost_0()`

```php
verifierPdfSyncApiV1VerificationVerifierPost_0($fichier_pdf): \FactPulse\SDK\Model\ReponseVerificationSucces
```

Vérifier la conformité PDF/XML Factur-X (synchrone)

Vérifie la conformité entre le PDF et son XML Factur-X embarqué.  **IMPORTANT**: Seuls les PDF Factur-X (avec XML embarqué) sont acceptés. Les PDF sans XML Factur-X seront rejetés avec une erreur 400.  Cette version synchrone utilise uniquement l'extraction PDF native (pdfplumber). Pour les PDF images nécessitant de l'OCR, utilisez l'endpoint `/verifier-async`.  **Principe de vérification (Factur-X 1.08):** - Principe n°2: Le XML ne peut contenir que des infos présentes dans le PDF - Principe n°4: Toute info XML doit être présente et conforme dans le PDF  **Champs vérifiés:** - Identification: BT-1 (n° facture), BT-2 (date), BT-3 (type), BT-5 (devise), BT-23 (cadre) - Vendeur: BT-27 (nom), BT-29 (SIRET), BT-30 (SIREN), BT-31 (TVA) - Acheteur: BT-44 (nom), BT-46 (SIRET), BT-47 (SIREN), BT-48 (TVA) - Montants: BT-109 (HT), BT-110 (TVA), BT-112 (TTC), BT-115 (à payer) - Ventilation TVA: BT-116, BT-117, BT-118, BT-119 - Lignes de facture: BT-153, BT-129, BT-146, BT-131 - Notes obligatoires: PMT, PMD, AAB - Règle BR-FR-09: cohérence SIRET/SIREN

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\VrificationPDFXMLApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF Factur-X à vérifier

try {
    $result = $apiInstance->verifierPdfSyncApiV1VerificationVerifierPost_0($fichier_pdf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling VrificationPDFXMLApi->verifierPdfSyncApiV1VerificationVerifierPost_0: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF Factur-X à vérifier | |

### Return type

[**\FactPulse\SDK\Model\ReponseVerificationSucces**](../Model/ReponseVerificationSucces.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
