# OpenAPI\Client\UserApi

## Gestion utilisateur  Endpoints pour la gestion du compte utilisateur et des informations de session.  ### Endpoints  - &#x60;GET /api/v1/me&#x60; : Informations sur l&#39;utilisateur connecté et son quota

All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**getUserInfoApiV1MeGet()**](UserApi.md#getUserInfoApiV1MeGet) | **GET** /api/v1/me | Get current user information |


## `getUserInfoApiV1MeGet()`

```php
getUserInfoApiV1MeGet(): mixed
```

Get current user information

Returns information about the authenticated user.  This endpoint allows you to: - Verify that authentication works - Get connected account details - Test JWT token validity - Check your consumption quota  **Requires valid authentication.**

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure Bearer authorization: HTTPBearer
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\UserApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getUserInfoApiV1MeGet();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->getUserInfoApiV1MeGet: ', $e->getMessage(), PHP_EOL;
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
