# FactPulse SDK PHP

Client PHP officiel pour l'API FactPulse - Facturation électronique française.

## Fonctionnalités

- **Factur-X** : Génération et validation de factures électroniques (profils MINIMUM, BASIC, EN16931, EXTENDED)
- **Chorus Pro** : Intégration avec la plateforme de facturation publique française
- **AFNOR PDP/PA** : Soumission de flux conformes à la norme XP Z12-013
- **Signature électronique** : Signature PDF (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- **Client simplifié** : Authentification JWT et polling intégrés via `Helpers`

## Installation

```bash
composer require factpulse/sdk
```

## Démarrage rapide

Le module `Helpers` offre une API simplifiée avec authentification et polling automatiques :

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use FactPulse\SDK\Helpers\FactPulseClient;
use function FactPulse\SDK\Helpers\{
    montant, montantTotal, ligneDePoste, ligneDeTva, fournisseur, destinataire
};

// Créer le client
$client = new FactPulseClient(
    'votre_email@example.com',
    'votre_mot_de_passe'
);

// Construire la facture avec les helpers
$factureData = [
    'numeroFacture' => 'FAC-2025-001',
    'dateFacture' => '2025-01-15',
    'fournisseur' => fournisseur(
        'Mon Entreprise SAS',
        '12345678901234',
        '123 Rue Example',
        '75001',
        'Paris'
    ),
    'destinataire' => destinataire(
        'Client SARL',
        '98765432109876',
        '456 Avenue Test',
        '69001',
        'Lyon'
    ),
    'montantTotal' => montantTotal(1000.00, 200.00, 1200.00, 1200.00),
    'lignesDePoste' => [
        ligneDePoste(1, 'Prestation de conseil', 10, 100.00, 1000.00)
    ],
    'lignesDeTva' => [
        ligneDeTva(1000.00, 200.00)
    ],
];

// Générer le PDF Factur-X
$pdfBytes = $client->genererFacturx($factureData, 'facture_source.pdf', 'EN16931');

file_put_contents('facture_facturx.pdf', $pdfBytes);
```

## Helpers disponibles

### montant($value)

Convertit une valeur en string formaté pour les montants monétaires.

```php
use function FactPulse\SDK\Helpers\montant;

montant(1234.5);      // "1234.50"
montant("1234.56");   // "1234.56"
montant(null);        // "0.00"
```

### montantTotal($ht, $tva, $ttc, $aPayer, ...)

Crée un objet MontantTotal complet.

```php
use function FactPulse\SDK\Helpers\montantTotal;

$total = montantTotal(
    1000.00,
    200.00,
    1200.00,
    1200.00,
    50.00,           // remiseTtc (optionnel)
    'Fidélité',      // motifRemise (optionnel)
    100.00           // acompte (optionnel)
);
```

### ligneDePoste($numero, $denomination, $quantite, $montantUnitaireHt, $montantTotalLigneHt, ...)

Crée une ligne de facturation.

```php
use function FactPulse\SDK\Helpers\ligneDePoste;

$ligne = ligneDePoste(
    1,
    'Prestation de conseil',
    5,
    200.00,
    1000.00,  // montantTotalLigneHt requis
    'S',      // categorieTva: S, Z, E, AE, K
    'HEURE',  // unite: FORFAIT, PIECE, HEURE, JOUR...
    [
        'tauxTva' => 'TVA20',        // Ou 'tauxTvaManuel' => '20.00'
        'reference' => 'REF-001',
    ]
);
```

### ligneDeTva($montantBaseHt, $montantTva, ...)

Crée une ligne de ventilation TVA.

```php
use function FactPulse\SDK\Helpers\ligneDeTva;

$tva = ligneDeTva(1000.00, 200.00, 'S', [
    'taux' => 'TVA20',       // Ou 'tauxManuel' => '20.00'
]);
```

### adressePostale($ligne1, $codePostal, $ville, ...)

Crée une adresse postale structurée.

```php
use function FactPulse\SDK\Helpers\adressePostale;

$adresse = adressePostale(
    '123 Rue de la République',
    '75001',
    'Paris',
    'FR',           // pays (défaut: 'FR')
    'Bâtiment A'    // ligne2 (optionnel)
);
```

### adresseElectronique($identifiant, $schemeId)

Crée une adresse électronique (identifiant numérique).

```php
use function FactPulse\SDK\Helpers\adresseElectronique;

// SIRET (schemeId="0225")
$adresse = adresseElectronique('12345678901234', '0225');

// SIREN (schemeId="0009", défaut)
$adresse = adresseElectronique('123456789');
```

### fournisseur($nom, $siret, $adresseLigne1, $codePostal, $ville, $options)

Crée un fournisseur complet avec calcul automatique du SIREN et TVA intra.

```php
use function FactPulse\SDK\Helpers\fournisseur;

$f = fournisseur(
    'Ma Société SAS',
    '12345678901234',
    '123 Rue Example',
    '75001',
    'Paris',
    ['iban' => 'FR7630006000011234567890189']
);
// SIREN et TVA intracommunautaire calculés automatiquement
```

### destinataire($nom, $siret, $adresseLigne1, $codePostal, $ville, $options)

Crée un destinataire (client) avec calcul automatique du SIREN.

```php
use function FactPulse\SDK\Helpers\destinataire;

$d = destinataire(
    'Client SARL',
    '98765432109876',
    '456 Avenue Test',
    '69001',
    'Lyon'
);
```

## Mode Zero-Trust (Chorus Pro / AFNOR)

Pour passer vos propres credentials sans stockage côté serveur :

```php
use FactPulse\SDK\Helpers\{FactPulseClient, ChorusProCredentials, AFNORCredentials};

$chorusCreds = new ChorusProCredentials(
    'votre_client_id',
    'votre_client_secret',
    'votre_login',
    'votre_password',
    true  // sandbox
);

$afnorCreds = new AFNORCredentials(
    'https://api.pdp.fr/flow/v1',
    'https://auth.pdp.fr/oauth/token',
    'votre_client_id',
    'votre_client_secret'
);

$client = new FactPulseClient(
    'votre_email@example.com',
    'votre_mot_de_passe',
    null,  // apiUrl
    null,  // clientUid
    $chorusCreds,
    $afnorCreds
);
```

## Ressources

- **Documentation API** : https://factpulse.fr/api/facturation/documentation
- **Support** : contact@factpulse.fr

## Licence

MIT License - Copyright (c) 2025 FactPulse
