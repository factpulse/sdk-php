# Configuration GitHub Actions

## Configuration Packagist

1. Enregistrez le package sur https://packagist.org/packages/submit
2. URL du repo : https://github.com/factpulse/sdk-php

## Secrets GitHub requis

1. Allez sur https://github.com/factpulse/sdk-php/settings/secrets/actions
2. Ajoutez les secrets :
   - `PACKAGIST_USERNAME` : Votre nom d'utilisateur Packagist
   - `PACKAGIST_TOKEN` : Votre token API Packagist (obtenu dans votre profil)

## Déploiement

Le workflow se déclenche automatiquement lors de la création d'un tag `v*` (exemple : `v1.0.0`).
Packagist récupère automatiquement les tags GitHub.
