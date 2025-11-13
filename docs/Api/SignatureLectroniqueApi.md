# FactPulse\SDK\SignatureLectroniqueApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**genererCertificatTestApiV1TraitementGenererCertificatTestPost()**](SignatureLectroniqueApi.md#genererCertificatTestApiV1TraitementGenererCertificatTestPost) | **POST** /api/v1/traitement/generer-certificat-test | Générer un certificat X.509 auto-signé de test |
| [**signerPdfApiV1TraitementSignerPdfPost()**](SignatureLectroniqueApi.md#signerPdfApiV1TraitementSignerPdfPost) | **POST** /api/v1/traitement/signer-pdf | Signer un PDF avec le certificat du client (PAdES-B-LT) |
| [**signerPdfAsyncApiV1TraitementSignerPdfAsyncPost()**](SignatureLectroniqueApi.md#signerPdfAsyncApiV1TraitementSignerPdfAsyncPost) | **POST** /api/v1/traitement/signer-pdf-async | Signer un PDF de manière asynchrone (Celery) |
| [**validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost()**](SignatureLectroniqueApi.md#validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost) | **POST** /api/v1/traitement/valider-signature-pdf | Valider les signatures électroniques d&#39;un PDF |


## `genererCertificatTestApiV1TraitementGenererCertificatTestPost()`

```php
genererCertificatTestApiV1TraitementGenererCertificatTestPost($generate_certificate_request): \FactPulse\SDK\Model\GenerateCertificateResponse
```

Générer un certificat X.509 auto-signé de test

Génère un certificat X.509 auto-signé pour les tests de signature électronique PDF.      **⚠️ ATTENTION : Certificat de TEST uniquement !**      Ce certificat est :     - ✅ Adapté pour tests et développement     - ✅ Compatible signature PDF (PAdES)     - ✅ Conforme eIDAS niveau **SES** (Simple Electronic Signature)     - ❌ **JAMAIS utilisable en production**     - ❌ **Non reconnu** par les navigateurs et lecteurs PDF     - ❌ **Aucune valeur juridique**      ## Niveaux eIDAS      - **SES** (Simple) : Certificat auto-signé ← Généré par cet endpoint     - **AdES** (Advanced) : Certificat CA commerciale (Let's Encrypt, etc.)     - **QES** (Qualified) : Certificat qualifié PSCO (CertEurope, Universign, etc.)      ## Utilisation      Une fois généré, le certificat peut être :      1. **Enregistré dans Django** (recommandé) :        - Django Admin > Certificats de signature        - Upload `certificat_pem` et `cle_privee_pem`      2. **Utilisé directement** :        - Signer un PDF avec `/signer-pdf`        - Le certificat sera automatiquement utilisé      ## Exemple d'appel      ```bash     curl -X POST \"https://www.factpulse.fr/api/facturation/generer-certificat-test\" \\       -H \"Authorization: Bearer eyJ0eXAi...\" \\       -H \"Content-Type: application/json\" \\       -d '{         \"cn\": \"Test Client XYZ\",         \"organisation\": \"Client XYZ SARL\",         \"email\": \"contact@xyz.fr\",         \"duree_jours\": 365       }'     ```      ## Cas d'usage      - Tests de signature PDF en développement     - POC de signature électronique     - Formation et démos     - Tests d'intégration automatisés      ## Conformité technique      Certificat généré avec :     - Clé RSA 2048 ou 4096 bits     - Algorithme SHA-256     - Extensions Key Usage : `digitalSignature`, `contentCommitment` (non-repudiation)     - Extensions Extended Key Usage : `codeSigning`, `emailProtection`     - Validité : 1 jour à 10 ans (configurable)     - Format : PEM (certificat et clé)     - Optionnel : PKCS#12 (.p12)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\SignatureLectroniqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$generate_certificate_request = new \FactPulse\SDK\Model\GenerateCertificateRequest(); // \FactPulse\SDK\Model\GenerateCertificateRequest

try {
    $result = $apiInstance->genererCertificatTestApiV1TraitementGenererCertificatTestPost($generate_certificate_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SignatureLectroniqueApi->genererCertificatTestApiV1TraitementGenererCertificatTestPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **generate_certificate_request** | [**\FactPulse\SDK\Model\GenerateCertificateRequest**](../Model/GenerateCertificateRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\GenerateCertificateResponse**](../Model/GenerateCertificateResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signerPdfApiV1TraitementSignerPdfPost()`

```php
signerPdfApiV1TraitementSignerPdfPost($fichier_pdf, $raison, $localisation, $contact, $field_name, $use_pades_lt, $use_timestamp): mixed
```

Signer un PDF avec le certificat du client (PAdES-B-LT)

Signe un PDF uploadé avec le certificat électronique configuré pour le client (via client_uid du JWT).      **Standards supportés** : PAdES-B-B, PAdES-B-T (horodatage), PAdES-B-LT (archivage long terme).      **Niveaux eIDAS** : SES (auto-signé), AdES (CA commerciale), QES (PSCO - hors scope).      **⚠️ Disclaimer légal** : Les signatures générées sont des cachets électroniques au sens     du règlement eIDAS. Le niveau de validité juridique dépend du certificat utilisé (SES/AdES/QES).     FactPulse ne fournit pas de certificats qualifiés QES - vous devez obtenir un certificat auprès     d'un PSCO (Prestataire de Services de Confiance qualifié) pour une validité juridique maximale.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\SignatureLectroniqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF à signer (sera traité puis retourné signé en base64)
$raison = 'raison_example'; // string
$localisation = 'localisation_example'; // string
$contact = 'contact_example'; // string
$field_name = 'FactPulseSignature'; // string | Nom du champ de signature PDF
$use_pades_lt = false; // bool | Activer PAdES-B-LT (archivage long terme avec données de validation embarquées). NÉCESSITE un certificat avec accès OCSP/CRL.
$use_timestamp = true; // bool | Activer l'horodatage RFC 3161 avec FreeTSA (PAdES-B-T)

try {
    $result = $apiInstance->signerPdfApiV1TraitementSignerPdfPost($fichier_pdf, $raison, $localisation, $contact, $field_name, $use_pades_lt, $use_timestamp);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SignatureLectroniqueApi->signerPdfApiV1TraitementSignerPdfPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF à signer (sera traité puis retourné signé en base64) | |
| **raison** | **string**|  | [optional] |
| **localisation** | **string**|  | [optional] |
| **contact** | **string**|  | [optional] |
| **field_name** | **string**| Nom du champ de signature PDF | [optional] [default to &#39;FactPulseSignature&#39;] |
| **use_pades_lt** | **bool**| Activer PAdES-B-LT (archivage long terme avec données de validation embarquées). NÉCESSITE un certificat avec accès OCSP/CRL. | [optional] [default to false] |
| **use_timestamp** | **bool**| Activer l&#39;horodatage RFC 3161 avec FreeTSA (PAdES-B-T) | [optional] [default to true] |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `signerPdfAsyncApiV1TraitementSignerPdfAsyncPost()`

```php
signerPdfAsyncApiV1TraitementSignerPdfAsyncPost($fichier_pdf, $raison, $localisation, $contact, $field_name, $use_pades_lt, $use_timestamp): mixed
```

Signer un PDF de manière asynchrone (Celery)

Signe un PDF uploadé de manière asynchrone via une tâche Celery.      **Différence avec /signer-pdf** :     - `/signer-pdf` : Signature synchrone (blocage jusqu'à la fin)     - `/signer-pdf-async` : Signature asynchrone (retourne immédiatement un task_id)      **Avantages de l'async** :     - Pas de timeout pour les gros fichiers     - Pas de blocage du worker FastAPI     - Possibilité de suivre la progression via le task_id     - Idéal pour les traitements par lot      **Standards supportés** : PAdES-B-B, PAdES-B-T (horodatage), PAdES-B-LT (archivage long terme).      **⚠️ Disclaimer légal** : Identique à /signer-pdf (voir documentation de cet endpoint).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\SignatureLectroniqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF à signer (traité de manière asynchrone)
$raison = 'raison_example'; // string
$localisation = 'localisation_example'; // string
$contact = 'contact_example'; // string
$field_name = 'FactPulseSignature'; // string | Nom du champ de signature PDF
$use_pades_lt = false; // bool | Activer PAdES-B-LT (archivage long terme avec données de validation embarquées). NÉCESSITE un certificat avec accès OCSP/CRL.
$use_timestamp = true; // bool | Activer l'horodatage RFC 3161 avec FreeTSA (PAdES-B-T)

try {
    $result = $apiInstance->signerPdfAsyncApiV1TraitementSignerPdfAsyncPost($fichier_pdf, $raison, $localisation, $contact, $field_name, $use_pades_lt, $use_timestamp);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SignatureLectroniqueApi->signerPdfAsyncApiV1TraitementSignerPdfAsyncPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF à signer (traité de manière asynchrone) | |
| **raison** | **string**|  | [optional] |
| **localisation** | **string**|  | [optional] |
| **contact** | **string**|  | [optional] |
| **field_name** | **string**| Nom du champ de signature PDF | [optional] [default to &#39;FactPulseSignature&#39;] |
| **use_pades_lt** | **bool**| Activer PAdES-B-LT (archivage long terme avec données de validation embarquées). NÉCESSITE un certificat avec accès OCSP/CRL. | [optional] [default to false] |
| **use_timestamp** | **bool**| Activer l&#39;horodatage RFC 3161 avec FreeTSA (PAdES-B-T) | [optional] [default to true] |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost()`

```php
validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost($fichier_pdf): mixed
```

Valider les signatures électroniques d'un PDF

Valide les signatures électroniques présentes dans un PDF uploadé.      **Vérifications effectuées** :     - Présence de signatures     - Intégrité du document (non modifié depuis signature)     - Validité des certificats     - Chaîne de confiance (si disponible)     - Présence d'horodatage (PAdES-B-T)     - Données de validation (PAdES-B-LT)      **Standards supportés** : PAdES-B-B, PAdES-B-T, PAdES-B-LT, ISO 32000-2.      **⚠️ Note** : Cette validation est technique (intégrité cryptographique). La validité juridique     dépend du niveau eIDAS du certificat (SES/AdES/QES) et du contexte d'utilisation.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\SignatureLectroniqueApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$fichier_pdf = '/path/to/file.txt'; // \SplFileObject | Fichier PDF à valider (sera analysé pour détecter et valider les signatures)

try {
    $result = $apiInstance->validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost($fichier_pdf);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SignatureLectroniqueApi->validerSignaturePdfEndpointApiV1TraitementValiderSignaturePdfPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **fichier_pdf** | **\SplFileObject****\SplFileObject**| Fichier PDF à valider (sera analysé pour détecter et valider les signatures) | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
