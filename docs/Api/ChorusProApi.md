# FactPulse\SDK\ChorusProApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**ajouterFichierApiV1ChorusProTransversesAjouterFichierPost()**](ChorusProApi.md#ajouterFichierApiV1ChorusProTransversesAjouterFichierPost) | **POST** /api/v1/chorus-pro/transverses/ajouter-fichier | Ajouter une pièce jointe |
| [**completerFactureApiV1ChorusProFacturesCompleterPost()**](ChorusProApi.md#completerFactureApiV1ChorusProFacturesCompleterPost) | **POST** /api/v1/chorus-pro/factures/completer | Compléter une facture suspendue (Fournisseur) |
| [**consulterFactureApiV1ChorusProFacturesConsulterPost()**](ChorusProApi.md#consulterFactureApiV1ChorusProFacturesConsulterPost) | **POST** /api/v1/chorus-pro/factures/consulter | Consulter le statut d&#39;une facture |
| [**consulterStructureApiV1ChorusProStructuresConsulterPost()**](ChorusProApi.md#consulterStructureApiV1ChorusProStructuresConsulterPost) | **POST** /api/v1/chorus-pro/structures/consulter | Consulter les détails d&#39;une structure |
| [**listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet()**](ChorusProApi.md#listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet) | **GET** /api/v1/chorus-pro/structures/{id_structure_cpp}/services | Lister les services d&#39;une structure |
| [**obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost()**](ChorusProApi.md#obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost) | **POST** /api/v1/chorus-pro/structures/obtenir-id-depuis-siret | Utilitaire : Obtenir l&#39;ID Chorus Pro depuis un SIRET |
| [**rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost()**](ChorusProApi.md#rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost) | **POST** /api/v1/chorus-pro/factures/rechercher-destinataire | Rechercher factures reçues (Destinataire) |
| [**rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost()**](ChorusProApi.md#rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost) | **POST** /api/v1/chorus-pro/factures/rechercher-fournisseur | Rechercher factures émises (Fournisseur) |
| [**rechercherStructuresApiV1ChorusProStructuresRechercherPost()**](ChorusProApi.md#rechercherStructuresApiV1ChorusProStructuresRechercherPost) | **POST** /api/v1/chorus-pro/structures/rechercher | Rechercher des structures Chorus Pro |
| [**recyclerFactureApiV1ChorusProFacturesRecyclerPost()**](ChorusProApi.md#recyclerFactureApiV1ChorusProFacturesRecyclerPost) | **POST** /api/v1/chorus-pro/factures/recycler | Recycler une facture (Fournisseur) |
| [**soumettreFactureApiV1ChorusProFacturesSoumettrePost()**](ChorusProApi.md#soumettreFactureApiV1ChorusProFacturesSoumettrePost) | **POST** /api/v1/chorus-pro/factures/soumettre | Soumettre une facture à Chorus Pro |
| [**telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost()**](ChorusProApi.md#telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost) | **POST** /api/v1/chorus-pro/factures/telecharger-groupe | Télécharger un groupe de factures |
| [**traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost()**](ChorusProApi.md#traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost) | **POST** /api/v1/chorus-pro/factures/traiter-facture-recue | Traiter une facture reçue (Destinataire) |
| [**valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost()**](ChorusProApi.md#valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost) | **POST** /api/v1/chorus-pro/factures/valideur/consulter | Consulter une facture (Valideur) |
| [**valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost()**](ChorusProApi.md#valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost) | **POST** /api/v1/chorus-pro/factures/valideur/rechercher | Rechercher factures à valider (Valideur) |
| [**valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost()**](ChorusProApi.md#valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost) | **POST** /api/v1/chorus-pro/factures/valideur/traiter | Valider ou refuser une facture (Valideur) |


## `ajouterFichierApiV1ChorusProTransversesAjouterFichierPost()`

```php
ajouterFichierApiV1ChorusProTransversesAjouterFichierPost($body_ajouter_fichier_api_v1_chorus_pro_transverses_ajouter_fichier_post): mixed
```

Ajouter une pièce jointe

Ajoute une pièce jointe au compte utilisateur courant.      **Taille max** : 10 Mo par fichier      **Payload exemple** :     ```json     {       \"pieceJointeFichier\": \"JVBERi0xLjQKJeLjz9MKNSAwIG9iago8P...\",       \"pieceJointeNom\": \"bon_commande.pdf\",       \"pieceJointeTypeMime\": \"application/pdf\",       \"pieceJointeExtension\": \"PDF\"     }     ```      **Retour** : L'ID de la pièce jointe (`pieceJointeIdFichier`) à utiliser ensuite dans `/factures/completer`.      **Extensions acceptées** : PDF, JPG, PNG, ZIP, XML, etc.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_ajouter_fichier_api_v1_chorus_pro_transverses_ajouter_fichier_post = new \FactPulse\SDK\Model\BodyAjouterFichierApiV1ChorusProTransversesAjouterFichierPost(); // \FactPulse\SDK\Model\BodyAjouterFichierApiV1ChorusProTransversesAjouterFichierPost

try {
    $result = $apiInstance->ajouterFichierApiV1ChorusProTransversesAjouterFichierPost($body_ajouter_fichier_api_v1_chorus_pro_transverses_ajouter_fichier_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->ajouterFichierApiV1ChorusProTransversesAjouterFichierPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_ajouter_fichier_api_v1_chorus_pro_transverses_ajouter_fichier_post** | [**\FactPulse\SDK\Model\BodyAjouterFichierApiV1ChorusProTransversesAjouterFichierPost**](../Model/BodyAjouterFichierApiV1ChorusProTransversesAjouterFichierPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `completerFactureApiV1ChorusProFacturesCompleterPost()`

```php
completerFactureApiV1ChorusProFacturesCompleterPost($body_completer_facture_api_v1_chorus_pro_factures_completer_post): mixed
```

Compléter une facture suspendue (Fournisseur)

Complète une facture au statut SUSPENDUE en ajoutant des pièces jointes ou un commentaire.      **Statut requis** : SUSPENDUE      **Actions possibles** :     - Ajouter des pièces jointes (justificatifs, bons de commande, etc.)     - Modifier le commentaire      **Payload exemple** :     ```json     {       \"identifiantFactureCPP\": 12345,       \"commentaire\": \"Voici les justificatifs demandés\",       \"listePiecesJointes\": [         {           \"pieceJointeIdFichier\": 98765,           \"pieceJointeNom\": \"bon_commande.pdf\"         }       ]     }     ```      **Note** : Les pièces jointes doivent d'abord être uploadées via `/transverses/ajouter-fichier`.      **Après complétion** : La facture repasse au statut MISE_A_DISPOSITION.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_completer_facture_api_v1_chorus_pro_factures_completer_post = new \FactPulse\SDK\Model\BodyCompleterFactureApiV1ChorusProFacturesCompleterPost(); // \FactPulse\SDK\Model\BodyCompleterFactureApiV1ChorusProFacturesCompleterPost

try {
    $result = $apiInstance->completerFactureApiV1ChorusProFacturesCompleterPost($body_completer_facture_api_v1_chorus_pro_factures_completer_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->completerFactureApiV1ChorusProFacturesCompleterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_completer_facture_api_v1_chorus_pro_factures_completer_post** | [**\FactPulse\SDK\Model\BodyCompleterFactureApiV1ChorusProFacturesCompleterPost**](../Model/BodyCompleterFactureApiV1ChorusProFacturesCompleterPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `consulterFactureApiV1ChorusProFacturesConsulterPost()`

```php
consulterFactureApiV1ChorusProFacturesConsulterPost($consulter_facture_request): \FactPulse\SDK\Model\ConsulterFactureResponse
```

Consulter le statut d'une facture

Récupère les informations et le statut actuel d'une facture soumise à Chorus Pro.      **Retour** :     - Numéro et date de facture     - Montant TTC     - **Statut courant** : SOUMISE, VALIDEE, REJETEE, SUSPENDUE, MANDATEE, MISE_EN_PAIEMENT, etc.     - Structure destinataire      **Cas d'usage** :     - Suivre l'évolution du traitement d'une facture     - Vérifier si une facture a été validée ou rejetée     - Obtenir la date de mise en paiement      **Polling** : Appelez cet endpoint régulièrement pour suivre l'évolution du statut.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$consulter_facture_request = new \FactPulse\SDK\Model\ConsulterFactureRequest(); // \FactPulse\SDK\Model\ConsulterFactureRequest

try {
    $result = $apiInstance->consulterFactureApiV1ChorusProFacturesConsulterPost($consulter_facture_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->consulterFactureApiV1ChorusProFacturesConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **consulter_facture_request** | [**\FactPulse\SDK\Model\ConsulterFactureRequest**](../Model/ConsulterFactureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ConsulterFactureResponse**](../Model/ConsulterFactureResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `consulterStructureApiV1ChorusProStructuresConsulterPost()`

```php
consulterStructureApiV1ChorusProStructuresConsulterPost($consulter_structure_request): \FactPulse\SDK\Model\ConsulterStructureResponse
```

Consulter les détails d'une structure

Récupère les informations détaillées d'une structure Chorus Pro.       **Retour** :     - Raison sociale     - Numéro de TVA intracommunautaire     - Email de contact     - **Paramètres obligatoires** : Indique si le code service et/ou numéro d'engagement sont requis pour soumettre une facture      **Étape typique** : Appelée après `rechercher-structures` pour savoir quels champs sont obligatoires avant de soumettre une facture.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$consulter_structure_request = new \FactPulse\SDK\Model\ConsulterStructureRequest(); // \FactPulse\SDK\Model\ConsulterStructureRequest

try {
    $result = $apiInstance->consulterStructureApiV1ChorusProStructuresConsulterPost($consulter_structure_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->consulterStructureApiV1ChorusProStructuresConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **consulter_structure_request** | [**\FactPulse\SDK\Model\ConsulterStructureRequest**](../Model/ConsulterStructureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ConsulterStructureResponse**](../Model/ConsulterStructureResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet()`

```php
listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet($id_structure_cpp, $body_lister_services_structure_api_v1_chorus_pro_structures_id_structure_cpp_services_get): \FactPulse\SDK\Model\RechercherServicesResponse
```

Lister les services d'une structure

Récupère la liste des services actifs d'une structure publique.      **Cas d'usage** :     - Lister les services disponibles pour une administration     - Vérifier qu'un code service existe avant de soumettre une facture      **Retour** :     - Liste des services avec leur code, libellé et statut (actif/inactif)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id_structure_cpp = 56; // int
$body_lister_services_structure_api_v1_chorus_pro_structures_id_structure_cpp_services_get = new \FactPulse\SDK\Model\BodyListerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet(); // \FactPulse\SDK\Model\BodyListerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet

try {
    $result = $apiInstance->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet($id_structure_cpp, $body_lister_services_structure_api_v1_chorus_pro_structures_id_structure_cpp_services_get);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->listerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **id_structure_cpp** | **int**|  | |
| **body_lister_services_structure_api_v1_chorus_pro_structures_id_structure_cpp_services_get** | [**\FactPulse\SDK\Model\BodyListerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet**](../Model/BodyListerServicesStructureApiV1ChorusProStructuresIdStructureCppServicesGet.md)|  | |

### Return type

[**\FactPulse\SDK\Model\RechercherServicesResponse**](../Model/RechercherServicesResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost()`

```php
obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost($obtenir_id_chorus_pro_request): \FactPulse\SDK\Model\ObtenirIdChorusProResponse
```

Utilitaire : Obtenir l'ID Chorus Pro depuis un SIRET

**Utilitaire pratique** pour obtenir l'ID Chorus Pro d'une structure à partir de son SIRET.       Cette fonction wrapper combine :     1. Recherche de la structure par SIRET     2. Extraction de l'`id_structure_cpp` si une seule structure est trouvée      **Retour** :     - `id_structure_cpp` : ID Chorus Pro (0 si non trouvé ou si plusieurs résultats)     - `designation_structure` : Nom de la structure (si trouvée)     - `message` : Message explicatif      **Cas d'usage** :     - Raccourci pour obtenir directement l'ID Chorus Pro avant de soumettre une facture     - Alternative simplifiée à `rechercher-structures` + extraction manuelle de l'ID      **Note** : Si plusieurs structures correspondent au SIRET (rare), retourne 0 et un message d'erreur.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$obtenir_id_chorus_pro_request = new \FactPulse\SDK\Model\ObtenirIdChorusProRequest(); // \FactPulse\SDK\Model\ObtenirIdChorusProRequest

try {
    $result = $apiInstance->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost($obtenir_id_chorus_pro_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->obtenirIdChorusProDepuisSiretApiV1ChorusProStructuresObtenirIdDepuisSiretPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **obtenir_id_chorus_pro_request** | [**\FactPulse\SDK\Model\ObtenirIdChorusProRequest**](../Model/ObtenirIdChorusProRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ObtenirIdChorusProResponse**](../Model/ObtenirIdChorusProResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost()`

```php
rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost($body_rechercher_factures_destinataire_api_v1_chorus_pro_factures_rechercher_destinataire_post): mixed
```

Rechercher factures reçues (Destinataire)

Recherche les factures reçues par le destinataire connecté.      **Filtres** :     - Téléchargée / non téléchargée     - Dates de réception     - Statut (MISE_A_DISPOSITION, SUSPENDUE, etc.)     - Fournisseur      **Indicateur utile** : `factureTelechargeeParDestinataire` permet de savoir si la facture a déjà été téléchargée.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_rechercher_factures_destinataire_api_v1_chorus_pro_factures_rechercher_destinataire_post = new \FactPulse\SDK\Model\BodyRechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost(); // \FactPulse\SDK\Model\BodyRechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost

try {
    $result = $apiInstance->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost($body_rechercher_factures_destinataire_api_v1_chorus_pro_factures_rechercher_destinataire_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_rechercher_factures_destinataire_api_v1_chorus_pro_factures_rechercher_destinataire_post** | [**\FactPulse\SDK\Model\BodyRechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost**](../Model/BodyRechercherFacturesDestinataireApiV1ChorusProFacturesRechercherDestinatairePost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost()`

```php
rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost($body_rechercher_factures_fournisseur_api_v1_chorus_pro_factures_rechercher_fournisseur_post): mixed
```

Rechercher factures émises (Fournisseur)

Recherche les factures émises par le fournisseur connecté.      **Filtres disponibles** :     - Numéro de facture     - Dates (début/fin)     - Statut     - Structure destinataire     - Montant      **Cas d'usage** :     - Suivi des factures émises     - Vérification des statuts     - Export pour comptabilité

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_rechercher_factures_fournisseur_api_v1_chorus_pro_factures_rechercher_fournisseur_post = new \FactPulse\SDK\Model\BodyRechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost(); // \FactPulse\SDK\Model\BodyRechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost

try {
    $result = $apiInstance->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost($body_rechercher_factures_fournisseur_api_v1_chorus_pro_factures_rechercher_fournisseur_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_rechercher_factures_fournisseur_api_v1_chorus_pro_factures_rechercher_fournisseur_post** | [**\FactPulse\SDK\Model\BodyRechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost**](../Model/BodyRechercherFacturesFournisseurApiV1ChorusProFacturesRechercherFournisseurPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rechercherStructuresApiV1ChorusProStructuresRechercherPost()`

```php
rechercherStructuresApiV1ChorusProStructuresRechercherPost($rechercher_structure_request): \FactPulse\SDK\Model\RechercherStructureResponse
```

Rechercher des structures Chorus Pro

Recherche des structures (entreprises, administrations) enregistrées sur Chorus Pro.      **Cas d'usage** :     - Trouver l'ID Chorus Pro d'une structure à partir de son SIRET     - Vérifier si une structure est enregistrée sur Chorus Pro     - Lister les structures correspondant à des critères      **Filtres disponibles** :     - Identifiant (SIRET, SIREN, etc.)     - Raison sociale     - Type d'identifiant     - Structures privées uniquement      **Étape typique** : Appelée avant `soumettre-facture` pour obtenir l'`id_structure_cpp` du destinataire.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$rechercher_structure_request = new \FactPulse\SDK\Model\RechercherStructureRequest(); // \FactPulse\SDK\Model\RechercherStructureRequest

try {
    $result = $apiInstance->rechercherStructuresApiV1ChorusProStructuresRechercherPost($rechercher_structure_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->rechercherStructuresApiV1ChorusProStructuresRechercherPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **rechercher_structure_request** | [**\FactPulse\SDK\Model\RechercherStructureRequest**](../Model/RechercherStructureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\RechercherStructureResponse**](../Model/RechercherStructureResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `recyclerFactureApiV1ChorusProFacturesRecyclerPost()`

```php
recyclerFactureApiV1ChorusProFacturesRecyclerPost($body_recycler_facture_api_v1_chorus_pro_factures_recycler_post): mixed
```

Recycler une facture (Fournisseur)

Recycle une facture au statut A_RECYCLER en modifiant les données d'acheminement.      **Statut requis** : A_RECYCLER      **Champs modifiables** :     - Destinataire (`idStructureCPP`)     - Code service     - Numéro d'engagement      **Cas d'usage** :     - Erreur de destinataire     - Changement de service facturation     - Mise à jour du numéro d'engagement      **Payload exemple** :     ```json     {       \"identifiantFactureCPP\": 12345,       \"idStructureCPP\": 67890,       \"codeService\": \"SERVICE_01\",       \"numeroEngagement\": \"ENG2024001\"     }     ```      **Note** : La facture conserve son numéro et ses montants, seuls les champs d'acheminement changent.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_recycler_facture_api_v1_chorus_pro_factures_recycler_post = new \FactPulse\SDK\Model\BodyRecyclerFactureApiV1ChorusProFacturesRecyclerPost(); // \FactPulse\SDK\Model\BodyRecyclerFactureApiV1ChorusProFacturesRecyclerPost

try {
    $result = $apiInstance->recyclerFactureApiV1ChorusProFacturesRecyclerPost($body_recycler_facture_api_v1_chorus_pro_factures_recycler_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->recyclerFactureApiV1ChorusProFacturesRecyclerPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_recycler_facture_api_v1_chorus_pro_factures_recycler_post** | [**\FactPulse\SDK\Model\BodyRecyclerFactureApiV1ChorusProFacturesRecyclerPost**](../Model/BodyRecyclerFactureApiV1ChorusProFacturesRecyclerPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `soumettreFactureApiV1ChorusProFacturesSoumettrePost()`

```php
soumettreFactureApiV1ChorusProFacturesSoumettrePost($soumettre_facture_request): \FactPulse\SDK\Model\SoumettreFactureResponse
```

Soumettre une facture à Chorus Pro

Soumet une facture électronique à une structure publique via Chorus Pro.       **📋 Workflow complet** :     1. **Uploader le PDF Factur-X** via `/transverses/ajouter-fichier` → récupérer `pieceJointeId`     2. **Obtenir l'ID structure** via `/structures/rechercher` ou `/structures/obtenir-id-depuis-siret`     3. **Vérifier les paramètres obligatoires** via `/structures/consulter`     4. **Soumettre la facture** avec le `piece_jointe_principale_id` obtenu à l'étape 1      **Pré-requis** :     1. Avoir l'`id_structure_cpp` du destinataire (via `/structures/rechercher`)     2. Connaître les paramètres obligatoires (via `/structures/consulter`) :        - Code service si `code_service_doit_etre_renseigne=true`        - Numéro d'engagement si `numero_ej_doit_etre_renseigne=true`     3. Avoir uploadé le PDF Factur-X (via `/transverses/ajouter-fichier`)      **Format attendu** :     - `piece_jointe_principale_id` : ID retourné par `/transverses/ajouter-fichier`     - Montants : Chaînes de caractères avec 2 décimales (ex: \"1250.50\")     - Dates : Format ISO 8601 (YYYY-MM-DD)      **Retour** :     - `identifiant_facture_cpp` : ID Chorus Pro de la facture créée     - `numero_flux_depot` : Numéro de suivi du dépôt      **Statuts possibles après soumission** :     - SOUMISE : En attente de validation     - VALIDEE : Validée par le destinataire     - REJETEE : Rejetée (erreur de données ou refus métier)     - SUSPENDUE : En attente d'informations complémentaires      **Note** : Utilisez `/factures/consulter` pour suivre l'évolution du statut.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$soumettre_facture_request = new \FactPulse\SDK\Model\SoumettreFactureRequest(); // \FactPulse\SDK\Model\SoumettreFactureRequest

try {
    $result = $apiInstance->soumettreFactureApiV1ChorusProFacturesSoumettrePost($soumettre_facture_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->soumettreFactureApiV1ChorusProFacturesSoumettrePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **soumettre_facture_request** | [**\FactPulse\SDK\Model\SoumettreFactureRequest**](../Model/SoumettreFactureRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\SoumettreFactureResponse**](../Model/SoumettreFactureResponse.md)

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost()`

```php
telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost($body_telecharger_groupe_factures_api_v1_chorus_pro_factures_telecharger_groupe_post): mixed
```

Télécharger un groupe de factures

Télécharge une ou plusieurs factures (max 10 recommandé) avec leurs pièces jointes.      **Formats disponibles** :     - PDF : Fichier PDF uniquement     - XML : Fichier XML uniquement     - ZIP : Archive contenant PDF + XML + pièces jointes      **Taille maximale** : 120 Mo par téléchargement      **Payload exemple** :     ```json     {       \"listeIdentifiantsFactureCPP\": [12345, 12346],       \"inclurePiecesJointes\": true,       \"formatFichier\": \"ZIP\"     }     ```      **Retour** : Le fichier est encodé en base64 dans le champ `fichierBase64`.      **Note** : Le flag `factureTelechargeeParDestinataire` est mis à jour automatiquement.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_telecharger_groupe_factures_api_v1_chorus_pro_factures_telecharger_groupe_post = new \FactPulse\SDK\Model\BodyTelechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost(); // \FactPulse\SDK\Model\BodyTelechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost

try {
    $result = $apiInstance->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost($body_telecharger_groupe_factures_api_v1_chorus_pro_factures_telecharger_groupe_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->telechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_telecharger_groupe_factures_api_v1_chorus_pro_factures_telecharger_groupe_post** | [**\FactPulse\SDK\Model\BodyTelechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost**](../Model/BodyTelechargerGroupeFacturesApiV1ChorusProFacturesTelechargerGroupePost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost()`

```php
traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost($body_traiter_facture_recue_api_v1_chorus_pro_factures_traiter_facture_recue_post): mixed
```

Traiter une facture reçue (Destinataire)

Change le statut d'une facture reçue.      **Statuts possibles** :     - MISE_A_DISPOSITION : Facture acceptée     - SUSPENDUE : En attente d'informations complémentaires (motif obligatoire)     - REJETEE : Facture refusée (motif obligatoire)     - MANDATEE : Facture mandatée     - MISE_EN_PAIEMENT : Facture en cours de paiement     - COMPTABILISEE : Facture comptabilisée     - MISE_A_DISPOSITION_COMPTABLE : Mise à disposition comptable     - A_RECYCLER : À recycler     - COMPLETEE : Complétée     - SERVICE-FAIT : Service fait     - PRISE_EN_COMPTE_DESTINATAIRE : Prise en compte     - TRANSMISE_MOA : Transmise à la MOA      **Payload exemple** :     ```json     {       \"identifiantFactureCPP\": 12345,       \"nouveauStatut\": \"REJETEE\",       \"motifRejet\": \"Facture en double\",       \"commentaire\": \"Facture déjà reçue sous la référence ABC123\"     }     ```      **Règles** :     - Un motif est **obligatoire** pour SUSPENDUE et REJETEE     - Seuls certains statuts sont autorisés selon le statut actuel de la facture

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_traiter_facture_recue_api_v1_chorus_pro_factures_traiter_facture_recue_post = new \FactPulse\SDK\Model\BodyTraiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost(); // \FactPulse\SDK\Model\BodyTraiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost

try {
    $result = $apiInstance->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost($body_traiter_facture_recue_api_v1_chorus_pro_factures_traiter_facture_recue_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->traiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_traiter_facture_recue_api_v1_chorus_pro_factures_traiter_facture_recue_post** | [**\FactPulse\SDK\Model\BodyTraiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost**](../Model/BodyTraiterFactureRecueApiV1ChorusProFacturesTraiterFactureRecuePost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost()`

```php
valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost($body_valideur_consulter_facture_api_v1_chorus_pro_factures_valideur_consulter_post): mixed
```

Consulter une facture (Valideur)

Consulte facture (valideur).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_valideur_consulter_facture_api_v1_chorus_pro_factures_valideur_consulter_post = new \FactPulse\SDK\Model\BodyValideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost(); // \FactPulse\SDK\Model\BodyValideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost

try {
    $result = $apiInstance->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost($body_valideur_consulter_facture_api_v1_chorus_pro_factures_valideur_consulter_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_valideur_consulter_facture_api_v1_chorus_pro_factures_valideur_consulter_post** | [**\FactPulse\SDK\Model\BodyValideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost**](../Model/BodyValideurConsulterFactureApiV1ChorusProFacturesValideurConsulterPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost()`

```php
valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost($body_valideur_rechercher_factures_api_v1_chorus_pro_factures_valideur_rechercher_post): mixed
```

Rechercher factures à valider (Valideur)

Recherche les factures en attente de validation par le valideur connecté.      **Rôle** : Valideur dans le circuit de validation interne.      **Filtres** : Dates, structure, service, etc.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_valideur_rechercher_factures_api_v1_chorus_pro_factures_valideur_rechercher_post = new \FactPulse\SDK\Model\BodyValideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost(); // \FactPulse\SDK\Model\BodyValideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost

try {
    $result = $apiInstance->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost($body_valideur_rechercher_factures_api_v1_chorus_pro_factures_valideur_rechercher_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_valideur_rechercher_factures_api_v1_chorus_pro_factures_valideur_rechercher_post** | [**\FactPulse\SDK\Model\BodyValideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost**](../Model/BodyValideurRechercherFacturesApiV1ChorusProFacturesValideurRechercherPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost()`

```php
valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost($body_valideur_traiter_facture_api_v1_chorus_pro_factures_valideur_traiter_post): mixed
```

Valider ou refuser une facture (Valideur)

Valide ou refuse une facture en attente de validation.      **Actions** :     - Valider : La facture passe au statut suivant du circuit     - Refuser : La facture est rejetée (motif obligatoire)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ChorusProApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body_valideur_traiter_facture_api_v1_chorus_pro_factures_valideur_traiter_post = new \FactPulse\SDK\Model\BodyValideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost(); // \FactPulse\SDK\Model\BodyValideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost

try {
    $result = $apiInstance->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost($body_valideur_traiter_facture_api_v1_chorus_pro_factures_valideur_traiter_post);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChorusProApi->valideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **body_valideur_traiter_facture_api_v1_chorus_pro_factures_valideur_traiter_post** | [**\FactPulse\SDK\Model\BodyValideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost**](../Model/BodyValideurTraiterFactureApiV1ChorusProFacturesValideurTraiterPost.md)|  | |

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
