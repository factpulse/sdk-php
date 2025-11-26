# FactPulse SDK PHP

Client PHP officiel pour l'API FactPulse - Facturation électronique française.

## 🎯 Fonctionnalités

- **Factur-X** : Génération et validation de factures électroniques (profils MINIMUM, BASIC, EN16931, EXTENDED)
- **Chorus Pro** : Intégration avec la plateforme de facturation publique française
- **AFNOR PDP/PA** : Soumission de flux conformes à la norme XP Z12-013
- **Signature électronique** : Signature PDF (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- **Client simplifié** : Authentification JWT et polling intégrés via `Helpers`
- **PHP 8.1+** : Compatible avec les versions modernes de PHP

## 🚀 Installation

```bash
composer require factpulse/sdk
```

## 📖 Démarrage rapide

### Méthode recommandée : Client simplifié avec Helpers

Le module `Helpers` offre une API simplifiée avec authentification et polling automatiques :

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use FactPulse\SDK\Helpers\FactPulseClient;

// Créer le client (authentification automatique)
$client = new FactPulseClient([
    'email' => 'votre_email@example.com',
    'password' => 'votre_mot_de_passe'
]);

// Données de la facture
$factureData = [
    'numero_facture' => 'FAC-2025-001',
    'date_facture' => '2025-01-15',
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
    'montant_total' => [
        'montant_ht_total' => '1000.00',
        'montant_tva' => '200.00',
        'montant_ttc_total' => '1200.00',
        'montant_a_payer' => '1200.00'
    ],
    'lignes_de_poste' => [[
        'numero' => 1,
        'denomination' => 'Prestation de conseil',
        'quantite' => '10.00',
        'unite' => 'PIECE',
        'montant_unitaire_ht' => '100.00'
    ]]
];

// Lire le PDF source
$pdfSource = file_get_contents('facture_source.pdf');

// Générer le PDF Factur-X (polling automatique)
$pdfBytes = $client->genererFacturx(
    $factureData,
    $pdfSource,
    'EN16931',  // profil
    'pdf',      // format
    true        // sync (attend le résultat)
);

// Sauvegarder
file_put_contents('facture_facturx.pdf', $pdfBytes);
```

### Méthode alternative : SDK brut

Pour un contrôle total, utilisez le SDK généré directement :

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

use FactPulse\SDK\Configuration;
use FactPulse\SDK\Api\TraitementFactureApi;
use GuzzleHttp\Client;

// 1. Obtenir le token JWT
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

// 2. Configurer le client
$config = Configuration::getDefaultConfiguration()
    ->setHost('https://factpulse.fr/api/facturation')
    ->setAccessToken($token);

// 3. Appeler l'API
$api = new TraitementFactureApi(new Client(), $config);
$response = $api->genererFactureApiV1TraitementGenererFacturePost(
    json_encode($factureData),
    'EN16931',
    'pdf',
    new \SplFileObject($pdfPath, 'r')
);

// 4. Polling manuel pour récupérer le résultat
$taskId = $response['id_tache'];
// ... (implémenter le polling)
```

## 🔧 Avantages des Helpers

| Fonctionnalité | SDK brut | Helpers |
|----------------|----------|---------|
| Authentification | Manuelle | Automatique |
| Refresh token | Manuel | Automatique |
| Polling tâches async | Manuel | Automatique (backoff) |
| Retry sur 401 | Manuel | Automatique |

## 🔑 Options d'authentification

### Client UID (multi-clients)

Si vous gérez plusieurs clients :

```php
$client = new FactPulseClient([
    'email' => 'votre_email@example.com',
    'password' => 'votre_mot_de_passe',
    'clientUid' => 'identifiant_client'  // UID du client cible
]);
```

### Configuration avancée

```php
$client = new FactPulseClient([
    'email' => 'votre_email@example.com',
    'password' => 'votre_mot_de_passe',
    'apiUrl' => 'https://factpulse.fr',  // URL personnalisée
    'pollingInterval' => 2000,  // Intervalle de polling initial (ms)
    'pollingTimeout' => 120000,  // Timeout de polling (ms)
    'maxRetries' => 2  // Tentatives en cas de 401
]);
```

## 💡 Formats de montants acceptés

L'API accepte plusieurs formats pour les montants :

```php
// String (recommandé pour la précision)
$montant = "1234.56";

// Float
$montant = 1234.56;

// Integer
$montant = 1234;

// Helper de formatage
$montantFormate = FactPulseClient::formatMontant(1234.5);  // "1234.50"
```

## 📚 Ressources

- **Documentation API** : https://factpulse.fr/api/facturation/documentation
- **Code source** : https://github.com/factpulse/sdk-php
- **Issues** : https://github.com/factpulse/sdk-php/issues
- **Support** : contact@factpulse.fr

## 📄 Licence

MIT License - Copyright (c) 2025 FactPulse
