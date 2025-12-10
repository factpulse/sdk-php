<?php
/**
 * FactureFacturX
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * API REST FactPulse
 *
 * API REST pour la facturation électronique en France : Factur-X, AFNOR PDP/PA, signatures électroniques.  ## 🎯 Fonctionnalités principales  ### 📄 Génération de factures Factur-X - **Formats** : XML seul ou PDF/A-3 avec XML embarqué - **Profils** : MINIMUM, BASIC, EN16931, EXTENDED - **Normes** : EN 16931 (directive UE 2014/55), ISO 19005-3 (PDF/A-3), CII (UN/CEFACT) - **🆕 Format simplifié** : Génération à partir de SIRET + auto-enrichissement (API Chorus Pro + Recherche Entreprises)  ### ✅ Validation et conformité - **Validation XML** : Schematron (45 à 210+ règles selon profil) - **Validation PDF** : PDF/A-3, métadonnées XMP Factur-X, signatures électroniques - **VeraPDF** : Validation stricte PDF/A (146+ règles ISO 19005-3) - **Traitement asynchrone** : Support Celery pour validations lourdes (VeraPDF)  ### 📡 Intégration AFNOR PDP/PA (XP Z12-013) - **Soumission de flux** : Envoi de factures vers Plateformes de Dématérialisation Partenaires - **Recherche de flux** : Consultation des factures soumises - **Téléchargement** : Récupération des PDF/A-3 avec XML - **Directory Service** : Recherche d'entreprises (SIREN/SIRET) - **Multi-client** : Support de plusieurs configs PDP par utilisateur (stored credentials ou zero-storage)  ### ✍️ Signature électronique PDF - **Standards** : PAdES-B-B, PAdES-B-T (horodatage RFC 3161), PAdES-B-LT (archivage long terme) - **Niveaux eIDAS** : SES (auto-signé), AdES (CA commerciale), QES (PSCO) - **Validation** : Vérification intégrité cryptographique et certificats - **Génération de certificats** : Certificats X.509 auto-signés pour tests  ### 🔄 Traitement asynchrone - **Celery** : Génération, validation et signature asynchrones - **Polling** : Suivi d'état via `/taches/{id_tache}/statut` - **Pas de timeout** : Idéal pour gros fichiers ou validations lourdes  ## 🔒 Authentification  Toutes les requêtes nécessitent un **token JWT** dans le header Authorization : ``` Authorization: Bearer YOUR_JWT_TOKEN ```  ### Comment obtenir un token JWT ?  #### 🔑 Méthode 1 : API `/api/token/` (Recommandée)  **URL :** `https://www.factpulse.fr/api/token/`  Cette méthode est **recommandée** pour l'intégration dans vos applications et workflows CI/CD.  **Prérequis :** Avoir défini un mot de passe sur votre compte  **Pour les utilisateurs inscrits via email/password :** - Vous avez déjà un mot de passe, utilisez-le directement  **Pour les utilisateurs inscrits via OAuth (Google/GitHub) :** - Vous devez d'abord définir un mot de passe sur : https://www.factpulse.fr/accounts/password/set/ - Une fois le mot de passe créé, vous pourrez utiliser l'API  **Exemple de requête :** ```bash curl -X POST https://www.factpulse.fr/api/token/ \\   -H \"Content-Type: application/json\" \\   -d '{     \"username\": \"votre_email@example.com\",     \"password\": \"votre_mot_de_passe\"   }' ```  **Paramètre optionnel `client_uid` :**  Pour sélectionner les credentials d'un client spécifique (PA/PDP, Chorus Pro, certificats de signature), ajoutez `client_uid` :  ```bash curl -X POST https://www.factpulse.fr/api/token/ \\   -H \"Content-Type: application/json\" \\   -d '{     \"username\": \"votre_email@example.com\",     \"password\": \"votre_mot_de_passe\",     \"client_uid\": \"550e8400-e29b-41d4-a716-446655440000\"   }' ```  Le `client_uid` sera inclus dans le JWT et permettra à l'API d'utiliser automatiquement : - Les credentials AFNOR/PDP configurés pour ce client - Les credentials Chorus Pro configurés pour ce client - Les certificats de signature électronique configurés pour ce client  **Réponse :** ```json {   \"access\": \"eyJ0eXAiOiJKV1QiLCJhbGc...\",  // Token d'accès (validité: 30 min)   \"refresh\": \"eyJ0eXAiOiJKV1QiLCJhbGc...\"  // Token de rafraîchissement (validité: 7 jours) } ```  **Avantages :** - ✅ Automatisation complète (CI/CD, scripts) - ✅ Gestion programmatique des tokens - ✅ Support du refresh token pour renouveler automatiquement l'accès - ✅ Intégration facile dans n'importe quel langage/outil  #### 🖥️ Méthode 2 : Génération via Dashboard (Alternative)  **URL :** https://www.factpulse.fr/dashboard/  Cette méthode convient pour des tests rapides ou une utilisation occasionnelle via l'interface graphique.  **Fonctionnement :** - Connectez-vous au dashboard - Utilisez les boutons \"Generate Test Token\" ou \"Generate Production Token\" - Fonctionne pour **tous** les utilisateurs (OAuth et email/password), sans nécessiter de mot de passe  **Types de tokens :** - **Token Test** : Validité 24h, quota 1000 appels/jour (gratuit) - **Token Production** : Validité 7 jours, quota selon votre forfait  **Avantages :** - ✅ Rapide pour tester l'API - ✅ Aucun mot de passe requis - ✅ Interface visuelle simple  **Inconvénients :** - ❌ Nécessite une action manuelle - ❌ Pas de refresh token - ❌ Moins adapté pour l'automatisation  ### 📚 Documentation complète  Pour plus d'informations sur l'authentification et l'utilisation de l'API : https://www.factpulse.fr/documentation-api/
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.18.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace FactPulse\SDK\Model;

use \ArrayAccess;
use \FactPulse\SDK\ObjectSerializer;

/**
 * FactureFacturX Class Doc Comment
 *
 * @category Class
 * @description Modèle de données pour une facture destinée à être convertie en Factur-X.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class FactureFacturX implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'FactureFacturX';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'numero_facture' => 'string',
        'date_echeance_paiement' => 'string',
        'date_facture' => 'string',
        'mode_depot' => '\FactPulse\SDK\Model\ModeDepot',
        'destinataire' => '\FactPulse\SDK\Model\Destinataire',
        'fournisseur' => '\FactPulse\SDK\Model\Fournisseur',
        'cadre_de_facturation' => '\FactPulse\SDK\Model\CadreDeFacturation',
        'references' => '\FactPulse\SDK\Model\References',
        'montant_total' => '\FactPulse\SDK\Model\MontantTotal',
        'lignes_de_poste' => '\FactPulse\SDK\Model\LigneDePoste[]',
        'lignes_de_tva' => '\FactPulse\SDK\Model\LigneDeTVA[]',
        'notes' => '\FactPulse\SDK\Model\Note[]',
        'commentaire' => 'string',
        'id_utilisateur_courant' => 'int',
        'pieces_jointes_complementaires' => '\FactPulse\SDK\Model\PieceJointeComplementaire[]',
        'beneficiaire' => '\FactPulse\SDK\Model\Beneficiaire'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'numero_facture' => null,
        'date_echeance_paiement' => null,
        'date_facture' => null,
        'mode_depot' => null,
        'destinataire' => null,
        'fournisseur' => null,
        'cadre_de_facturation' => null,
        'references' => null,
        'montant_total' => null,
        'lignes_de_poste' => null,
        'lignes_de_tva' => null,
        'notes' => null,
        'commentaire' => null,
        'id_utilisateur_courant' => null,
        'pieces_jointes_complementaires' => null,
        'beneficiaire' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'numero_facture' => false,
        'date_echeance_paiement' => false,
        'date_facture' => false,
        'mode_depot' => false,
        'destinataire' => false,
        'fournisseur' => false,
        'cadre_de_facturation' => false,
        'references' => false,
        'montant_total' => false,
        'lignes_de_poste' => false,
        'lignes_de_tva' => false,
        'notes' => false,
        'commentaire' => true,
        'id_utilisateur_courant' => true,
        'pieces_jointes_complementaires' => true,
        'beneficiaire' => true
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'numero_facture' => 'numeroFacture',
        'date_echeance_paiement' => 'dateEcheancePaiement',
        'date_facture' => 'dateFacture',
        'mode_depot' => 'modeDepot',
        'destinataire' => 'destinataire',
        'fournisseur' => 'fournisseur',
        'cadre_de_facturation' => 'cadreDeFacturation',
        'references' => 'references',
        'montant_total' => 'montantTotal',
        'lignes_de_poste' => 'lignesDePoste',
        'lignes_de_tva' => 'lignesDeTva',
        'notes' => 'notes',
        'commentaire' => 'commentaire',
        'id_utilisateur_courant' => 'idUtilisateurCourant',
        'pieces_jointes_complementaires' => 'piecesJointesComplementaires',
        'beneficiaire' => 'beneficiaire'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'numero_facture' => 'setNumeroFacture',
        'date_echeance_paiement' => 'setDateEcheancePaiement',
        'date_facture' => 'setDateFacture',
        'mode_depot' => 'setModeDepot',
        'destinataire' => 'setDestinataire',
        'fournisseur' => 'setFournisseur',
        'cadre_de_facturation' => 'setCadreDeFacturation',
        'references' => 'setReferences',
        'montant_total' => 'setMontantTotal',
        'lignes_de_poste' => 'setLignesDePoste',
        'lignes_de_tva' => 'setLignesDeTva',
        'notes' => 'setNotes',
        'commentaire' => 'setCommentaire',
        'id_utilisateur_courant' => 'setIdUtilisateurCourant',
        'pieces_jointes_complementaires' => 'setPiecesJointesComplementaires',
        'beneficiaire' => 'setBeneficiaire'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'numero_facture' => 'getNumeroFacture',
        'date_echeance_paiement' => 'getDateEcheancePaiement',
        'date_facture' => 'getDateFacture',
        'mode_depot' => 'getModeDepot',
        'destinataire' => 'getDestinataire',
        'fournisseur' => 'getFournisseur',
        'cadre_de_facturation' => 'getCadreDeFacturation',
        'references' => 'getReferences',
        'montant_total' => 'getMontantTotal',
        'lignes_de_poste' => 'getLignesDePoste',
        'lignes_de_tva' => 'getLignesDeTva',
        'notes' => 'getNotes',
        'commentaire' => 'getCommentaire',
        'id_utilisateur_courant' => 'getIdUtilisateurCourant',
        'pieces_jointes_complementaires' => 'getPiecesJointesComplementaires',
        'beneficiaire' => 'getBeneficiaire'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('numero_facture', $data ?? [], null);
        $this->setIfExists('date_echeance_paiement', $data ?? [], null);
        $this->setIfExists('date_facture', $data ?? [], null);
        $this->setIfExists('mode_depot', $data ?? [], null);
        $this->setIfExists('destinataire', $data ?? [], null);
        $this->setIfExists('fournisseur', $data ?? [], null);
        $this->setIfExists('cadre_de_facturation', $data ?? [], null);
        $this->setIfExists('references', $data ?? [], null);
        $this->setIfExists('montant_total', $data ?? [], null);
        $this->setIfExists('lignes_de_poste', $data ?? [], null);
        $this->setIfExists('lignes_de_tva', $data ?? [], null);
        $this->setIfExists('notes', $data ?? [], null);
        $this->setIfExists('commentaire', $data ?? [], null);
        $this->setIfExists('id_utilisateur_courant', $data ?? [], null);
        $this->setIfExists('pieces_jointes_complementaires', $data ?? [], null);
        $this->setIfExists('beneficiaire', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['numero_facture'] === null) {
            $invalidProperties[] = "'numero_facture' can't be null";
        }
        if ($this->container['date_echeance_paiement'] === null) {
            $invalidProperties[] = "'date_echeance_paiement' can't be null";
        }
        if ($this->container['mode_depot'] === null) {
            $invalidProperties[] = "'mode_depot' can't be null";
        }
        if ($this->container['destinataire'] === null) {
            $invalidProperties[] = "'destinataire' can't be null";
        }
        if ($this->container['fournisseur'] === null) {
            $invalidProperties[] = "'fournisseur' can't be null";
        }
        if ($this->container['cadre_de_facturation'] === null) {
            $invalidProperties[] = "'cadre_de_facturation' can't be null";
        }
        if ($this->container['references'] === null) {
            $invalidProperties[] = "'references' can't be null";
        }
        if ($this->container['montant_total'] === null) {
            $invalidProperties[] = "'montant_total' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets numero_facture
     *
     * @return string
     */
    public function getNumeroFacture()
    {
        return $this->container['numero_facture'];
    }

    /**
     * Sets numero_facture
     *
     * @param string $numero_facture numero_facture
     *
     * @return self
     */
    public function setNumeroFacture($numero_facture)
    {
        if (is_null($numero_facture)) {
            throw new \InvalidArgumentException('non-nullable numero_facture cannot be null');
        }
        $this->container['numero_facture'] = $numero_facture;

        return $this;
    }

    /**
     * Gets date_echeance_paiement
     *
     * @return string
     */
    public function getDateEcheancePaiement()
    {
        return $this->container['date_echeance_paiement'];
    }

    /**
     * Sets date_echeance_paiement
     *
     * @param string $date_echeance_paiement date_echeance_paiement
     *
     * @return self
     */
    public function setDateEcheancePaiement($date_echeance_paiement)
    {
        if (is_null($date_echeance_paiement)) {
            throw new \InvalidArgumentException('non-nullable date_echeance_paiement cannot be null');
        }
        $this->container['date_echeance_paiement'] = $date_echeance_paiement;

        return $this;
    }

    /**
     * Gets date_facture
     *
     * @return string|null
     */
    public function getDateFacture()
    {
        return $this->container['date_facture'];
    }

    /**
     * Sets date_facture
     *
     * @param string|null $date_facture date_facture
     *
     * @return self
     */
    public function setDateFacture($date_facture)
    {
        if (is_null($date_facture)) {
            throw new \InvalidArgumentException('non-nullable date_facture cannot be null');
        }
        $this->container['date_facture'] = $date_facture;

        return $this;
    }

    /**
     * Gets mode_depot
     *
     * @return \FactPulse\SDK\Model\ModeDepot
     */
    public function getModeDepot()
    {
        return $this->container['mode_depot'];
    }

    /**
     * Sets mode_depot
     *
     * @param \FactPulse\SDK\Model\ModeDepot $mode_depot mode_depot
     *
     * @return self
     */
    public function setModeDepot($mode_depot)
    {
        if (is_null($mode_depot)) {
            throw new \InvalidArgumentException('non-nullable mode_depot cannot be null');
        }
        $this->container['mode_depot'] = $mode_depot;

        return $this;
    }

    /**
     * Gets destinataire
     *
     * @return \FactPulse\SDK\Model\Destinataire
     */
    public function getDestinataire()
    {
        return $this->container['destinataire'];
    }

    /**
     * Sets destinataire
     *
     * @param \FactPulse\SDK\Model\Destinataire $destinataire destinataire
     *
     * @return self
     */
    public function setDestinataire($destinataire)
    {
        if (is_null($destinataire)) {
            throw new \InvalidArgumentException('non-nullable destinataire cannot be null');
        }
        $this->container['destinataire'] = $destinataire;

        return $this;
    }

    /**
     * Gets fournisseur
     *
     * @return \FactPulse\SDK\Model\Fournisseur
     */
    public function getFournisseur()
    {
        return $this->container['fournisseur'];
    }

    /**
     * Sets fournisseur
     *
     * @param \FactPulse\SDK\Model\Fournisseur $fournisseur fournisseur
     *
     * @return self
     */
    public function setFournisseur($fournisseur)
    {
        if (is_null($fournisseur)) {
            throw new \InvalidArgumentException('non-nullable fournisseur cannot be null');
        }
        $this->container['fournisseur'] = $fournisseur;

        return $this;
    }

    /**
     * Gets cadre_de_facturation
     *
     * @return \FactPulse\SDK\Model\CadreDeFacturation
     */
    public function getCadreDeFacturation()
    {
        return $this->container['cadre_de_facturation'];
    }

    /**
     * Sets cadre_de_facturation
     *
     * @param \FactPulse\SDK\Model\CadreDeFacturation $cadre_de_facturation cadre_de_facturation
     *
     * @return self
     */
    public function setCadreDeFacturation($cadre_de_facturation)
    {
        if (is_null($cadre_de_facturation)) {
            throw new \InvalidArgumentException('non-nullable cadre_de_facturation cannot be null');
        }
        $this->container['cadre_de_facturation'] = $cadre_de_facturation;

        return $this;
    }

    /**
     * Gets references
     *
     * @return \FactPulse\SDK\Model\References
     */
    public function getReferences()
    {
        return $this->container['references'];
    }

    /**
     * Sets references
     *
     * @param \FactPulse\SDK\Model\References $references references
     *
     * @return self
     */
    public function setReferences($references)
    {
        if (is_null($references)) {
            throw new \InvalidArgumentException('non-nullable references cannot be null');
        }
        $this->container['references'] = $references;

        return $this;
    }

    /**
     * Gets montant_total
     *
     * @return \FactPulse\SDK\Model\MontantTotal
     */
    public function getMontantTotal()
    {
        return $this->container['montant_total'];
    }

    /**
     * Sets montant_total
     *
     * @param \FactPulse\SDK\Model\MontantTotal $montant_total montant_total
     *
     * @return self
     */
    public function setMontantTotal($montant_total)
    {
        if (is_null($montant_total)) {
            throw new \InvalidArgumentException('non-nullable montant_total cannot be null');
        }
        $this->container['montant_total'] = $montant_total;

        return $this;
    }

    /**
     * Gets lignes_de_poste
     *
     * @return \FactPulse\SDK\Model\LigneDePoste[]|null
     */
    public function getLignesDePoste()
    {
        return $this->container['lignes_de_poste'];
    }

    /**
     * Sets lignes_de_poste
     *
     * @param \FactPulse\SDK\Model\LigneDePoste[]|null $lignes_de_poste lignes_de_poste
     *
     * @return self
     */
    public function setLignesDePoste($lignes_de_poste)
    {
        if (is_null($lignes_de_poste)) {
            throw new \InvalidArgumentException('non-nullable lignes_de_poste cannot be null');
        }
        $this->container['lignes_de_poste'] = $lignes_de_poste;

        return $this;
    }

    /**
     * Gets lignes_de_tva
     *
     * @return \FactPulse\SDK\Model\LigneDeTVA[]|null
     */
    public function getLignesDeTva()
    {
        return $this->container['lignes_de_tva'];
    }

    /**
     * Sets lignes_de_tva
     *
     * @param \FactPulse\SDK\Model\LigneDeTVA[]|null $lignes_de_tva lignes_de_tva
     *
     * @return self
     */
    public function setLignesDeTva($lignes_de_tva)
    {
        if (is_null($lignes_de_tva)) {
            throw new \InvalidArgumentException('non-nullable lignes_de_tva cannot be null');
        }
        $this->container['lignes_de_tva'] = $lignes_de_tva;

        return $this;
    }

    /**
     * Gets notes
     *
     * @return \FactPulse\SDK\Model\Note[]|null
     */
    public function getNotes()
    {
        return $this->container['notes'];
    }

    /**
     * Sets notes
     *
     * @param \FactPulse\SDK\Model\Note[]|null $notes notes
     *
     * @return self
     */
    public function setNotes($notes)
    {
        if (is_null($notes)) {
            throw new \InvalidArgumentException('non-nullable notes cannot be null');
        }
        $this->container['notes'] = $notes;

        return $this;
    }

    /**
     * Gets commentaire
     *
     * @return string|null
     */
    public function getCommentaire()
    {
        return $this->container['commentaire'];
    }

    /**
     * Sets commentaire
     *
     * @param string|null $commentaire commentaire
     *
     * @return self
     */
    public function setCommentaire($commentaire)
    {
        if (is_null($commentaire)) {
            array_push($this->openAPINullablesSetToNull, 'commentaire');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('commentaire', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['commentaire'] = $commentaire;

        return $this;
    }

    /**
     * Gets id_utilisateur_courant
     *
     * @return int|null
     */
    public function getIdUtilisateurCourant()
    {
        return $this->container['id_utilisateur_courant'];
    }

    /**
     * Sets id_utilisateur_courant
     *
     * @param int|null $id_utilisateur_courant id_utilisateur_courant
     *
     * @return self
     */
    public function setIdUtilisateurCourant($id_utilisateur_courant)
    {
        if (is_null($id_utilisateur_courant)) {
            array_push($this->openAPINullablesSetToNull, 'id_utilisateur_courant');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('id_utilisateur_courant', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['id_utilisateur_courant'] = $id_utilisateur_courant;

        return $this;
    }

    /**
     * Gets pieces_jointes_complementaires
     *
     * @return \FactPulse\SDK\Model\PieceJointeComplementaire[]|null
     */
    public function getPiecesJointesComplementaires()
    {
        return $this->container['pieces_jointes_complementaires'];
    }

    /**
     * Sets pieces_jointes_complementaires
     *
     * @param \FactPulse\SDK\Model\PieceJointeComplementaire[]|null $pieces_jointes_complementaires pieces_jointes_complementaires
     *
     * @return self
     */
    public function setPiecesJointesComplementaires($pieces_jointes_complementaires)
    {
        if (is_null($pieces_jointes_complementaires)) {
            array_push($this->openAPINullablesSetToNull, 'pieces_jointes_complementaires');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('pieces_jointes_complementaires', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['pieces_jointes_complementaires'] = $pieces_jointes_complementaires;

        return $this;
    }

    /**
     * Gets beneficiaire
     *
     * @return \FactPulse\SDK\Model\Beneficiaire|null
     */
    public function getBeneficiaire()
    {
        return $this->container['beneficiaire'];
    }

    /**
     * Sets beneficiaire
     *
     * @param \FactPulse\SDK\Model\Beneficiaire|null $beneficiaire beneficiaire
     *
     * @return self
     */
    public function setBeneficiaire($beneficiaire)
    {
        if (is_null($beneficiaire)) {
            array_push($this->openAPINullablesSetToNull, 'beneficiaire');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('beneficiaire', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['beneficiaire'] = $beneficiaire;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer|string $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


