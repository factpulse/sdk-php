# Changelog

Toutes les modifications notables de ce projet seront documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.14] - 2025-11-26

### Added
- Version initiale du SDK php
- Support complet de l'API FactPulse v1.0.0
- Endpoints Factur-X (génération, validation)
- Endpoints AFNOR PDP/PA (Flow Service, Directory Service)
- Endpoints Chorus Pro (recherche entreprise, soumission factures)
- Endpoints Signature électronique (PAdES-B-B, PAdES-B-T, PAdES-B-LT)
- Support des deux modes d'authentification (stored credentials et zero-trust)
- Documentation complète et exemples

### Documentation
- README.md avec quickstart et exemples
- Guide d'authentification JWT
- Configuration avancée (timeout, proxy, debug)

[Unreleased]: https://github.com/factpulse/sdk-php/compare/v2.0.14...HEAD
[2.0.14]: https://github.com/factpulse/sdk-php/releases/tag/v2.0.14
