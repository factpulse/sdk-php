# FactPulse SDK PHP

Official PHP client for the FactPulse API - French electronic invoicing.

## Features

- **Factur-X**: Generation and validation of electronic invoices (MINIMUM, BASIC, EN16931, EXTENDED profiles)
- **Chorus Pro**: Integration with the French public invoicing platform
- **AFNOR PDP/PA**: Submission of flows compliant with XP Z12-013 standard
- **Electronic signature**: PDF signing (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- **Thin HTTP wrapper**: Generic `post()` and `get()` methods with automatic JWT auth and polling

## Installation

```bash
composer require factpulse/sdk
```

## Quick Start

```php
<?php
require_once 'vendor/autoload.php';

use FactPulse\SDK\FactPulseClient;

// Create the client
$client = new FactPulseClient(
    "your_email@example.com",
    "your_password",
    "your-client-uuid"  // From dashboard: Configuration > Clients
);

// Read your source PDF
$pdfB64 = base64_encode(file_get_contents("source_invoice.pdf"));

// Generate Factur-X and submit to PDP in one call
$result = $client->post("processing/invoices/submit-complete-async", [
    "invoiceData" => [
        "number" => "INV-2025-001",
        "supplier" => [
            "siret" => "12345678901234",
            "iban" => "FR7630001007941234567890185",
            "routingAddress" => "12345678901234",
        ],
        "recipient" => [
            "siret" => "98765432109876",
            "routingAddress" => "98765432109876",
        ],
        "lines" => [
            [
                "description" => "Consulting services",
                "quantity" => 10,
                "unitPrice" => 100.0,
                "vatRate" => 20.0,
            ],
        ],
    ],
    "sourcePdf" => $pdfB64,
    "profile" => "EN16931",
    "destination" => ["type" => "afnor"],
]);

// PDF is in $result["content"] (auto-polled, auto-decoded from base64)
file_put_contents("facturx_invoice.pdf", $result["content"]);

echo "Flow ID: " . $result["afnorResult"]["flowId"] . "\n";
```

## API Methods

The SDK provides two generic methods that map directly to API endpoints:

```php
// POST /api/v1/{path}
$result = $client->post("path/to/endpoint", ["key1" => $value1, "key2" => $value2]);

// GET /api/v1/{path}
$result = $client->get("path/to/endpoint", ["param1" => $value1]);
```

### Common Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `processing/invoices/submit-complete-async` | POST | Generate Factur-X + submit to PDP |
| `processing/generate-invoice` | POST | Generate Factur-X XML or PDF |
| `processing/validate-xml` | POST | Validate Factur-X XML |
| `processing/validate-facturx-pdf` | POST | Validate Factur-X PDF |
| `processing/sign-pdf` | POST | Sign PDF with certificate |
| `afnor/flow/v1/flows` | POST | Submit flow to AFNOR PDP |
| `afnor/incoming-flows/{flow_id}` | GET | Get incoming invoice |
| `chorus-pro/factures/soumettre` | POST | Submit to Chorus Pro |

## Webhooks

Instead of polling, you can receive results via webhook by adding `callbackUrl`:

```php
// Submit with webhook - returns immediately
$result = $client->post("processing/invoices/submit-complete-async", [
    "invoiceData" => $invoiceData,
    "sourcePdf" => $pdfB64,
    "destination" => ["type" => "afnor"],
    "callbackUrl" => "https://your-server.com/webhook/factpulse",
    "webhookMode" => "INLINE",  // or "DOWNLOAD_URL"
]);

$taskId = $result["taskId"];
// Result will be POSTed to your webhook URL
```

### Webhook Receiver Example

```php
<?php
$webhookSecret = "your-shared-secret";

function verifySignature(string $payload, string $signature): bool {
    if (strpos($signature, "sha256=") !== 0) {
        return false;
    }
    $expected = hash_hmac("sha256", $payload, $GLOBALS["webhookSecret"]);
    return hash_equals($expected, substr($signature, 7));
}

// Get raw POST body
$payload = file_get_contents("php://input");
$signature = $_SERVER["HTTP_X_WEBHOOK_SIGNATURE"] ?? "";

if (!verifySignature($payload, $signature)) {
    http_response_code(401);
    echo json_encode(["error" => "Invalid signature"]);
    exit;
}

$event = json_decode($payload, true);
$eventType = $event["event_type"];
$data = $event["data"];

if ($eventType === "submission.completed") {
    $flowId = $data["afnorResult"]["flowId"] ?? null;
    error_log("Invoice submitted: $flowId");
} elseif ($eventType === "submission.failed") {
    error_log("Submission failed: " . ($data["error"] ?? "Unknown"));
}

header("Content-Type: application/json");
echo json_encode(["status" => "received"]);
```

### Webhook Event Types

| Event | Description |
|-------|-------------|
| `generation.completed` | Factur-X generated successfully |
| `generation.failed` | Generation failed |
| `validation.completed` | Validation passed |
| `validation.failed` | Validation failed |
| `signature.completed` | PDF signed |
| `submission.completed` | Submitted to PDP/Chorus |
| `submission.failed` | Submission failed |

## Zero-Storage Mode

Pass PDP credentials directly in the request (no server-side storage):

```php
$result = $client->post("processing/invoices/submit-complete-async", [
    "invoiceData" => $invoiceData,
    "sourcePdf" => $pdfB64,
    "destination" => [
        "type" => "afnor",
        "flowServiceUrl" => "https://api.pdp.example.com/flow/v1",
        "tokenUrl" => "https://auth.pdp.example.com/oauth/token",
        "clientId" => "your_pdp_client_id",
        "clientSecret" => "your_pdp_client_secret",
    ],
]);
```

## Error Handling

```php
use FactPulse\SDK\FactPulseClient;
use FactPulse\SDK\FactPulseError;

try {
    $result = $client->post("processing/validate-xml", ["xmlContent" => $xml]);
} catch (FactPulseError $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Status code: " . $e->getStatusCode() . "\n";
    echo "Details: " . print_r($e->getDetails(), true) . "\n";
}
```

## Resources

- **API Documentation**: https://factpulse.fr/api/facturation/documentation
- **Webhooks Guide**: https://factpulse.fr/docs/webhooks
- **Support**: contact@factpulse.fr

## License

MIT License - Copyright (c) 2025 FactPulse
