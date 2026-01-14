# FactPulse SDK PHP

Official PHP client for the FactPulse API.

## Installation

```bash
composer require factpulse/sdk
```

## Quick Start

```php
<?php
require_once 'vendor/autoload.php';

use FactPulse\SDK\FactPulseClient;

$client = new FactPulseClient([
    'email' => 'your_email@example.com',
    'password' => 'your_password',
]);

// Generate a Factur-X invoice
$pdfBytes = $client->generateFacturx([
    'invoiceData' => [
        'number' => 'INV-2025-001',
        'supplier' => ['name' => 'My Company', 'siret' => '12345678901234'],
        'recipient' => ['name' => 'Client', 'siret' => '98765432109876'],
        'lines' => [['description' => 'Service', 'quantity' => 1, 'unitPrice' => 1000]],
    ],
    'pdfSource' => file_get_contents('source.pdf'),
    'profile' => 'EN16931',
]);

file_put_contents('facturx.pdf', $pdfBytes);
```

## License

MIT
