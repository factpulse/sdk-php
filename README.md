# FactPulse SDK PHP

Official PHP client for the FactPulse API - French electronic invoicing.

## Features

- **Factur-X**: Generation and validation of electronic invoices (MINIMUM, BASIC, EN16931, EXTENDED profiles)
- **Chorus Pro**: Integration with the French public sector invoicing platform
- **AFNOR PDP/PA**: Submission of flows compliant with the XP Z12-013 standard
- **Electronic signature**: PDF signature (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- **Simplified client**: JWT authentication and integrated polling via `Helpers`

## Installation

```bash
composer require factpulse/sdk
```

## Quick Start

The `Helpers` module provides a simplified API with automatic authentication and polling:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use FactPulse\SDK\Helpers\FactPulseClient;
use function FactPulse\SDK\Helpers\{
    amount, invoiceTotals, invoiceLine, vatLine, supplier, recipient
};

// Create the client
$client = new FactPulseClient(
    'your_email@example.com',
    'your_password'
);

// Build the invoice with helpers
$invoiceData = [
    'invoiceNumber' => 'INV-2025-001',
    'issueDate' => '2025-01-15',
    'dueDate' => '2025-02-15',
    'currencyCode' => 'EUR',
    'supplier' => supplier(
        'My Company SAS',
        '12345678901234',
        '123 Example Street',
        '75001',
        'Paris'
    ),
    'recipient' => recipient(
        'Client SARL',
        '98765432109876',
        '456 Test Avenue',
        '69001',
        'Lyon'
    ),
    'totals' => invoiceTotals(1000.00, 200.00, 1200.00, 1200.00),
    'lines' => [
        invoiceLine(1, 'Consulting services', 10, 100.00, 1000.00)
    ],
    'vatLines' => [
        vatLine(1000.00, 200.00)
    ],
];

// Generate the Factur-X PDF
$pdfBytes = $client->generateFacturx($invoiceData, 'source_invoice.pdf', 'EN16931');

file_put_contents('invoice_facturx.pdf', $pdfBytes);
```

## Available Helpers

### amount($value)

Converts a value to a formatted string for monetary amounts.

```php
use function FactPulse\SDK\Helpers\amount;

amount(1234.5);      // "1234.50"
amount("1234.56");   // "1234.56"
amount(null);        // "0.00"
```

### invoiceTotals($totalNetAmount, $vatAmount, $totalGrossAmount, $amountDue, ...)

Creates a complete invoice totals object.

```php
use function FactPulse\SDK\Helpers\invoiceTotals;

$totals = invoiceTotals(
    1000.00,
    200.00,
    1200.00,
    1200.00,
    50.00,                  // globalAllowanceAmount (optional)
    'Loyalty discount',     // globalAllowanceReason (optional)
    100.00                  // prepayment (optional)
);
```

### invoiceLine($lineNumber, $itemName, $quantity, $unitNetPrice, $lineNetAmount, ...)

Creates an invoice line.

```php
use function FactPulse\SDK\Helpers\invoiceLine;

$line = invoiceLine(
    1,
    'Consulting services',
    5,
    200.00,
    1000.00,
    'S',      // vatCategory: S, Z, E, AE, K
    'HOUR',   // unit: LUMP_SUM, PIECE, HOUR, DAY...
    [
        'vatRate' => 'TVA20',        // Or 'manualVatRate' => '20.00'
        'reference' => 'REF-001',
    ]
);
```

### vatLine($baseExcludingTax, $vatAmount, ...)

Creates a VAT breakdown line.

```php
use function FactPulse\SDK\Helpers\vatLine;

$vat = vatLine(1000.00, 200.00, 'S', [
    'rate' => 'VAT20',       // Or 'manualRate' => '20.00'
]);
```

### postalAddress($line1, $postalCode, $city, ...)

Creates a structured postal address.

```php
use function FactPulse\SDK\Helpers\postalAddress;

$address = postalAddress(
    '123 Republic Street',
    '75001',
    'Paris',
    'FR',           // country (default: 'FR')
    'Building A'    // line2 (optional)
);
```

### electronicAddress($identifier, $schemeId)

Creates an electronic address (digital identifier).

```php
use function FactPulse\SDK\Helpers\electronicAddress;

// SIRET (schemeId="0225")
$address = electronicAddress('12345678901234', '0225');

// SIREN (schemeId="0009", default)
$address = electronicAddress('123456789');
```

### supplier($name, $siret, $addressLine1, $postalCode, $city, $options)

Creates a complete supplier with automatic calculation of SIREN and intra-community VAT.

```php
use function FactPulse\SDK\Helpers\supplier;

$s = supplier(
    'My Company SAS',
    '12345678901234',
    '123 Example Street',
    '75001',
    'Paris',
    ['iban' => 'FR7630006000011234567890189']
);
// SIREN and intra-community VAT automatically calculated
```

### recipient($name, $siret, $addressLine1, $postalCode, $city, $options)

Creates a recipient (customer) with automatic calculation of SIREN.

```php
use function FactPulse\SDK\Helpers\recipient;

$r = recipient(
    'Client SARL',
    '98765432109876',
    '456 Test Avenue',
    '69001',
    'Lyon'
);
```

## Zero-Trust Mode (Chorus Pro / AFNOR)

To pass your own credentials without server-side storage:

```php
use FactPulse\SDK\Helpers\{FactPulseClient, ChorusProCredentials, AFNORCredentials};

$chorusCreds = new ChorusProCredentials(
    'your_client_id',
    'your_client_secret',
    'your_login',
    'your_password',
    true  // sandbox
);

$afnorCreds = new AFNORCredentials(
    'https://api.pdp.fr/flow/v1',
    'https://auth.pdp.fr/oauth/token',
    'your_client_id',
    'your_client_secret'
);

$client = new FactPulseClient(
    'your_email@example.com',
    'your_password',
    null,  // apiUrl
    null,  // clientUid
    $chorusCreds,
    $afnorCreds
);
```

## Resources

- **API Documentation**: https://factpulse.fr/api/facturation/documentation
- **Support**: contact@factpulse.fr

## License

MIT License - Copyright (c) 2025 FactPulse
