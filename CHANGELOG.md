# Changelog

Toutes les modifications notables de ce projet seront documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [4.5.0] - 2026-11-21

### Added
- /cdar/lifecycle : lecture de toutes les pages de statuts (réponse complète sur longue période), paramètres dateFrom / dateTo, champs totalFlows, truncated, dateFrom et dateTo dans la réponse
- Routes GET / PATCH /clients/{uid}/superpdp/vat-regime : consultation et mise à jour du régime de TVA SuperPDP
- CDAR encaissée multi-taux : amountsByRate sur /cdar/encaissee, encaisseAmountsByRate sur /cdar/generate, /cdar/submit et /cdar/validate, champ comment ; amount et invoiceBuyerElectronicAddress deviennent optionnels sur /cdar/encaissee
- PaymentMeans : valeur CARTE

### Fixed
- /cdar/lifecycle : erreurs 502 intermittentes sur les longues périodes (corrigé côté API)


[Unreleased]: https://github.com/factpulse/sdk-php/compare/v4.5.0...HEAD
[4.5.0]: https://github.com/factpulse/sdk-php/releases/tag/v4.5.0
