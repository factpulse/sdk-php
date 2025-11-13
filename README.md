# FactPulse SDK PHP

Client PHP officiel pour l'API FactPulse - Facturation électronique française.

## 🎯 Fonctionnalités

- **Factur-X** : Génération et validation de factures électroniques (profils MINIMUM, BASIC, EN16931, EXTENDED)
- **Chorus Pro** : Intégration avec la plateforme de facturation publique française
- **AFNOR PDP/PA** : Soumission de flux conformes à la norme XP Z12-013
- **Signature électronique** : Signature PDF (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- **Traitement asynchrone** : Support Celery pour opérations longues
- **PHP 7.4+** : Compatible avec les versions modernes de PHP

## 🚀 Installation

```bash
composer require factpulse/sdk
```

## 📖 Démarrage rapide

### 1. Authentification

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use FactPulse\SDK\Configuration;
use FactPulse\SDK\Api\TraitementFactureApi;
use GuzzleHttp\Client;

// Configuration du client
$config = Configuration::getDefaultConfiguration()
    ->setHost('https://factpulse.fr/api/facturation')
    ->setAccessToken('votre_token_jwt');

$apiInstance = new TraitementFactureApi(new Client(), $config);
```

### 2. Générer une facture Factur-X

```php
// Données de la facture
$factureData = [
    'numero_facture' => 'FAC-2025-001',
    'date_facture' => '2025-01-15',
    'montant_total_ht' => '1000.00',
    'montant_total_ttc' => '1200.00',
    'fournisseur' => [
        'nom' => 'Mon Entreprise SAS',
        'siret' => '12345678901234',
        'adresse_postale' => [
            'ligne_un' => '123 Rue Example',
            'code_postal' => '75001',
            'nom_ville' => 'Paris',
            'pays_code_iso' => 'FR'
        ]
    ],
    'destinataire' => [
        'nom' => 'Client SARL',
        'siret' => '98765432109876',
        'adresse_postale' => [
            'ligne_un' => '456 Avenue Test',
            'code_postal' => '69001',
            'nom_ville' => 'Lyon',
            'pays_code_iso' => 'FR'
        ]
    ],
    'lignes_de_poste' => [[
        'numero' => 1,
        'denomination' => 'Prestation de conseil',
        'quantite' => '10.00',
        'montant_unitaire_ht' => '100.00',
        'montant_ligne_ht' => '1000.00'
    ]]
];

// Générer le PDF Factur-X
$pdfBytes = $apiInstance->genererFactureApiV1TraitementGenererFacturePost(
    json_encode($factureData),
    'EN16931',
    'pdf'
);

// Sauvegarder
file_put_contents('facture.pdf', $pdfBytes);
```

### 3. Soumettre une facture complète (Chorus Pro / AFNOR PDP)

```php
$response = $apiInstance->soumettreFactureCompleteApiV1TraitementFacturesSoumettreCompletePost([
    'facture' => $factureData,
    'destination' => [
        'type' => 'chorus_pro',
        'credentials' => [
            'login' => 'votre_login_chorus',
            'password' => 'votre_password_chorus'
        ]
    ]
]);

echo "Facture soumise : " . $response->getIdFactureChorus();
```

## 🔑 Obtention du token JWT

### Via l'API

```php
$ch = curl_init('https://factpulse.fr/api/token/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'username' => 'votre_email@example.com',
    'password' => 'votre_mot_de_passe'
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = json_decode(curl_exec($ch), true);
$token = $response['access'];
curl_close($ch);
```

**Accès aux credentials d'un client spécifique :**

Si vous gérez plusieurs clients et souhaitez accéder aux credentials (Chorus Pro, AFNOR PDP) d'un client particulier, ajoutez le champ `client_uid` :

```php
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'username' => 'votre_email@example.com',
    'password' => 'votre_mot_de_passe',
    'client_uid' => 'identifiant_client'  // UID du client cible
]));
```

### Via le Dashboard

1. Connectez-vous sur https://factpulse.fr/api/dashboard/
2. Générez un token API
3. Copiez et utilisez le token dans votre configuration

## 📚 Ressources

- **Documentation API** : https://factpulse.fr/api/facturation/documentation
- **Code source** : https://github.com/factpulse/sdk-php
- **Issues** : https://github.com/factpulse/sdk-php/issues
- **Support** : contact@factpulse.fr

## 📄 Licence

MIT License - Copyright (c) 2025 FactPulse
