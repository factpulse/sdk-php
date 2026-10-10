# Changelog

Toutes les modifications notables de ce projet seront documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [4.4.0] - 2026-10-10

### Added
- Endpoint /cdar/lifecycle : paramètre flowDirection (In, Out, All ; défaut All) et champ flowDirection sur chaque événement

### Fixed
- Go : le chemin du module suit désormais la version majeure (github.com/factpulse/sdk-go/v4). Les versions v4.x n'étaient pas installables via /v3 : mettre à jour les imports de sdk-go/v3 vers sdk-go/v4
- Ruby : FactPulse::Client.new accepte les arguments nommés (email:, password:, client_uid:) comme indiqué dans le README
- CDAR : vatRate / encaisseVatRate typés en nombre (défaut 20)


[Unreleased]: https://github.com/factpulse/sdk-php/compare/v4.4.0...HEAD
[4.4.0]: https://github.com/factpulse/sdk-php/releases/tag/v4.4.0
