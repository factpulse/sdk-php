# FactPulse\SDK\UtilisateurApi



All URIs are relative to http://localhost, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**obtenirInfosUtilisateurApiV1MoiGet()**](UtilisateurApi.md#obtenirInfosUtilisateurApiV1MoiGet) | **GET** /api/v1/moi | Obtenir les informations de l&#39;utilisateur connecté |


## `obtenirInfosUtilisateurApiV1MoiGet()`

```php
obtenirInfosUtilisateurApiV1MoiGet(): mixed
```

Obtenir les informations de l'utilisateur connecté

Retourne les informations de l'utilisateur authentifié.  Cet endpoint permet de : - Vérifier que l'authentification fonctionne - Obtenir les détails du compte connecté - Tester la validité du token JWT - Consulter son quota de consommation  **Nécessite une authentification valide.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\UtilisateurApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->obtenirInfosUtilisateurApiV1MoiGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UtilisateurApi->obtenirInfosUtilisateurApiV1MoiGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

**mixed**

### Authorization

[HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
