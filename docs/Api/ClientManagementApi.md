# FactPulse\SDK\ClientManagementApi



All URIs are relative to https://factpulse.fr, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**activateClientApiV1ClientsUidActiverPost()**](ClientManagementApi.md#activateClientApiV1ClientsUidActiverPost) | **POST** /api/v1/clients/{uid}/activer | Activate a client |
| [**createClientApiV1ClientsPost()**](ClientManagementApi.md#createClientApiV1ClientsPost) | **POST** /api/v1/clients | Create a client |
| [**deactivateClientApiV1ClientsUidDesactiverPost()**](ClientManagementApi.md#deactivateClientApiV1ClientsUidDesactiverPost) | **POST** /api/v1/clients/{uid}/desactiver | Deactivate a client |
| [**deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete()**](ClientManagementApi.md#deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete) | **DELETE** /api/v1/clients/{uid}/webhook-secret | Delete webhook secret |
| [**generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost()**](ClientManagementApi.md#generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost) | **POST** /api/v1/clients/{uid}/webhook-secret/generate | Generate webhook secret |
| [**getClientApiV1ClientsUidGet()**](ClientManagementApi.md#getClientApiV1ClientsUidGet) | **GET** /api/v1/clients/{uid} | Get client details |
| [**getPdpConfigApiV1ClientsUidPdpConfigGet()**](ClientManagementApi.md#getPdpConfigApiV1ClientsUidPdpConfigGet) | **GET** /api/v1/clients/{uid}/pdp-config | Get client PDP configuration |
| [**getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet()**](ClientManagementApi.md#getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet) | **GET** /api/v1/clients/{uid}/webhook-secret/status | Get webhook secret status |
| [**listClientsApiV1ClientsGet()**](ClientManagementApi.md#listClientsApiV1ClientsGet) | **GET** /api/v1/clients | List clients |
| [**rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost()**](ClientManagementApi.md#rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost) | **POST** /api/v1/clients/{uid}/rotate-encryption-key | Rotate client encryption key |
| [**updateClientApiV1ClientsUidPatch()**](ClientManagementApi.md#updateClientApiV1ClientsUidPatch) | **PATCH** /api/v1/clients/{uid} | Update a client |
| [**updatePdpConfigApiV1ClientsUidPdpConfigPut()**](ClientManagementApi.md#updatePdpConfigApiV1ClientsUidPdpConfigPut) | **PUT** /api/v1/clients/{uid}/pdp-config | Configure client PDP |


## `activateClientApiV1ClientsUidActiverPost()`

```php
activateClientApiV1ClientsUidActiverPost($uid): \FactPulse\SDK\Model\ClientActivateResponse
```

Activate a client

Activate a deactivated client.  **Scope**: Client level (JWT with client_uid that must match {uid})

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->activateClientApiV1ClientsUidActiverPost($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->activateClientApiV1ClientsUidActiverPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\ClientActivateResponse**](../Model/ClientActivateResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `createClientApiV1ClientsPost()`

```php
createClientApiV1ClientsPost($client_create_request): \FactPulse\SDK\Model\ClientDetail
```

Create a client

Create a new client for the account.  **Scope**: Account level (JWT without client_uid)  **Fields**: - `name`: Client name (required) - `description`: Optional description - `siret`: Optional SIRET (14 digits)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$client_create_request = new \FactPulse\SDK\Model\ClientCreateRequest(); // \FactPulse\SDK\Model\ClientCreateRequest

try {
    $result = $apiInstance->createClientApiV1ClientsPost($client_create_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->createClientApiV1ClientsPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **client_create_request** | [**\FactPulse\SDK\Model\ClientCreateRequest**](../Model/ClientCreateRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ClientDetail**](../Model/ClientDetail.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deactivateClientApiV1ClientsUidDesactiverPost()`

```php
deactivateClientApiV1ClientsUidDesactiverPost($uid): \FactPulse\SDK\Model\ClientActivateResponse
```

Deactivate a client

Deactivate an active client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Note**: A deactivated client cannot be used for API calls (AFNOR, Chorus Pro, etc.).

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->deactivateClientApiV1ClientsUidDesactiverPost($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->deactivateClientApiV1ClientsUidDesactiverPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\ClientActivateResponse**](../Model/ClientActivateResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete()`

```php
deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete($uid): \FactPulse\SDK\Model\WebhookSecretDeleteResponse
```

Delete webhook secret

Delete the webhook secret for a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **After deletion**: Webhooks for this client will use the global server key for HMAC signature instead of a client-specific key.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->deleteWebhookSecretApiV1ClientsUidWebhookSecretDelete: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\WebhookSecretDeleteResponse**](../Model/WebhookSecretDeleteResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost()`

```php
generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost($uid): \FactPulse\SDK\Model\WebhookSecretGenerateResponse
```

Generate webhook secret

Generate or regenerate the webhook secret for a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Important**: Save the returned secret immediately - it will never be shown again. The secret is used to sign webhooks sent by the server (HMAC-SHA256).  **If a secret already exists**: It will be replaced by the new one.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->generateWebhookSecretApiV1ClientsUidWebhookSecretGeneratePost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\WebhookSecretGenerateResponse**](../Model/WebhookSecretGenerateResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getClientApiV1ClientsUidGet()`

```php
getClientApiV1ClientsUidGet($uid): \FactPulse\SDK\Model\ClientDetail
```

Get client details

Get details of a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Security**: If the JWT contains a client_uid, it must match the {uid} in the URL, otherwise a 403 error is returned.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->getClientApiV1ClientsUidGet($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->getClientApiV1ClientsUidGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\ClientDetail**](../Model/ClientDetail.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getPdpConfigApiV1ClientsUidPdpConfigGet()`

```php
getPdpConfigApiV1ClientsUidPdpConfigGet($uid): \FactPulse\SDK\Model\PDPConfigResponse
```

Get client PDP configuration

Get the PDP (PA/PDP) configuration for a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Security**: The client secret is never returned. Only a status (`secretStatus`) indicates whether a secret is configured.  **Response**: - If configured: all config details (URLs, client_id, secret status) - If not configured: `isConfigured: false` with a message

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->getPdpConfigApiV1ClientsUidPdpConfigGet($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->getPdpConfigApiV1ClientsUidPdpConfigGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\PDPConfigResponse**](../Model/PDPConfigResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet()`

```php
getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet($uid): \FactPulse\SDK\Model\WebhookSecretStatusResponse
```

Get webhook secret status

Check if a webhook secret is configured for a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Response**: - `hasSecret`: Whether a webhook secret is configured - `createdAt`: When the secret was created (if exists)  **Note**: The secret value is never returned, only its status.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string

try {
    $result = $apiInstance->getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet($uid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->getWebhookSecretStatusApiV1ClientsUidWebhookSecretStatusGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |

### Return type

[**\FactPulse\SDK\Model\WebhookSecretStatusResponse**](../Model/WebhookSecretStatusResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `listClientsApiV1ClientsGet()`

```php
listClientsApiV1ClientsGet($page, $page_size): \FactPulse\SDK\Model\ClientListResponse
```

List clients

Paginated list of clients for the account.  **Scope**: Account level (JWT without client_uid)  **Pagination**: - `page`: Page number (default: 1) - `pageSize`: Page size (default: 20, max: 100)

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 1; // int | Page number
$page_size = 20; // int | Page size

try {
    $result = $apiInstance->listClientsApiV1ClientsGet($page, $page_size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->listClientsApiV1ClientsGet: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **page** | **int**| Page number | [optional] [default to 1] |
| **page_size** | **int**| Page size | [optional] [default to 20] |

### Return type

[**\FactPulse\SDK\Model\ClientListResponse**](../Model/ClientListResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost()`

```php
rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost($uid, $key_rotation_request): \FactPulse\SDK\Model\KeyRotationResponse
```

Rotate client encryption key

Rotate the client encryption key for all secrets in double encryption mode.  **Scope**: Client level (JWT with client_uid that must match {uid})  **What this does**: 1. Decrypts all secrets (PDP, Chorus Pro) using the old key 2. Re-encrypts them using the new key 3. Saves to database  **Important notes**: - Both keys must be base64-encoded AES-256 keys (32 bytes each) - The old key becomes invalid immediately after rotation - Only secrets encrypted with `encryptionMode: \"double\"` are affected - If the client has no double-encrypted secrets, returns 404  **Security**: - The old key must be valid (decryption is verified) - If decryption fails, rotation is aborted (atomic operation) - Neither key is logged or stored by the server

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string
$key_rotation_request = new \FactPulse\SDK\Model\KeyRotationRequest(); // \FactPulse\SDK\Model\KeyRotationRequest

try {
    $result = $apiInstance->rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost($uid, $key_rotation_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->rotateEncryptionKeyApiV1ClientsUidRotateEncryptionKeyPost: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |
| **key_rotation_request** | [**\FactPulse\SDK\Model\KeyRotationRequest**](../Model/KeyRotationRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\KeyRotationResponse**](../Model/KeyRotationResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updateClientApiV1ClientsUidPatch()`

```php
updateClientApiV1ClientsUidPatch($uid, $client_update_request): \FactPulse\SDK\Model\ClientDetail
```

Update a client

Update client information (partial update).  **Scope**: Client level (JWT with client_uid that must match {uid})  **Updatable fields**: - `name`: Client name - `description`: Description - `siret`: SIRET (14 digits)  Only provided fields are updated.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string
$client_update_request = new \FactPulse\SDK\Model\ClientUpdateRequest(); // \FactPulse\SDK\Model\ClientUpdateRequest

try {
    $result = $apiInstance->updateClientApiV1ClientsUidPatch($uid, $client_update_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->updateClientApiV1ClientsUidPatch: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |
| **client_update_request** | [**\FactPulse\SDK\Model\ClientUpdateRequest**](../Model/ClientUpdateRequest.md)|  | |

### Return type

[**\FactPulse\SDK\Model\ClientDetail**](../Model/ClientDetail.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `updatePdpConfigApiV1ClientsUidPdpConfigPut()`

```php
updatePdpConfigApiV1ClientsUidPdpConfigPut($uid, $pdp_config_update_request, $x_encryption_key): \FactPulse\SDK\Model\PDPConfigResponse
```

Configure client PDP

Configure or update the PDP (PA/PDP) configuration for a client.  **Scope**: Client level (JWT with client_uid that must match {uid})  **Required fields**: - `flowServiceUrl`: PDP Flow Service URL - `tokenUrl`: PDP OAuth token URL - `oauthClientId`: OAuth Client ID - `clientSecret`: OAuth Client Secret (sent but NEVER returned)  **Optional fields**: - `isActive`: Enable/disable the config (default: true) - `modeSandbox`: Sandbox mode (default: false) - `encryptionMode`: Encryption mode (default: \"fernet\")   - \"fernet\": Server-side encryption only   - \"double\": Client AES-256-GCM + Server Fernet (requires X-Encryption-Key header)  **Double Encryption Mode**: When `encryptionMode` is set to \"double\", you MUST also provide the `X-Encryption-Key` header containing a base64-encoded AES-256 key (32 bytes). This key is used to encrypt the `clientSecret` on the client side before the server encrypts it again with Fernet. The server cannot decrypt the secret without the client key.  **Security**: The `clientSecret` is stored encrypted on Django side and is never returned in API responses.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: APIKeyHeader
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKey('X-API-Key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setApiKeyPrefix('X-API-Key', 'Bearer');

// Configure Bearer authorization: HTTPBearer
$config = FactPulse\SDK\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new FactPulse\SDK\Api\ClientManagementApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$uid = 'uid_example'; // string
$pdp_config_update_request = new \FactPulse\SDK\Model\PDPConfigUpdateRequest(); // \FactPulse\SDK\Model\PDPConfigUpdateRequest
$x_encryption_key = 'x_encryption_key_example'; // string | Client encryption key for double encryption mode. Must be a base64-encoded AES-256 key (32 bytes). Required only when accessing resources encrypted with encryption_mode='double'.

try {
    $result = $apiInstance->updatePdpConfigApiV1ClientsUidPdpConfigPut($uid, $pdp_config_update_request, $x_encryption_key);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ClientManagementApi->updatePdpConfigApiV1ClientsUidPdpConfigPut: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **uid** | **string**|  | |
| **pdp_config_update_request** | [**\FactPulse\SDK\Model\PDPConfigUpdateRequest**](../Model/PDPConfigUpdateRequest.md)|  | |
| **x_encryption_key** | **string**| Client encryption key for double encryption mode. Must be a base64-encoded AES-256 key (32 bytes). Required only when accessing resources encrypted with encryption_mode&#x3D;&#39;double&#39;. | [optional] |

### Return type

[**\FactPulse\SDK\Model\PDPConfigResponse**](../Model/PDPConfigResponse.md)

### Authorization

[APIKeyHeader](../../README.md#APIKeyHeader), [HTTPBearer](../../README.md#HTTPBearer)

### HTTP request headers

- **Content-Type**: `application/json`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
