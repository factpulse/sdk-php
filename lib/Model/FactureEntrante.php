<?php
/**
 * FactureEntrante
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
 * FactureEntrante Class Doc Comment
 *
 * @category Class
 * @description Facture reçue d&#39;un fournisseur via PDP/PA.  Ce modèle contient les métadonnées essentielles extraites des factures entrantes, quel que soit leur format source (CII, UBL, Factur-X).  Les montants sont en Decimal en Python mais seront sérialisés en string dans le JSON pour préserver la précision monétaire.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class FactureEntrante implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'FactureEntrante';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'flow_id' => 'string',
        'format_source' => '\FactPulse\SDK\Model\FormatFacture',
        'ref_fournisseur' => 'string',
        'type_document' => '\FactPulse\SDK\Model\TypeDocument',
        'fournisseur' => '\FactPulse\SDK\Model\FournisseurEntrant',
        'site_facturation_nom' => 'string',
        'site_facturation_siret' => 'string',
        'date_de_piece' => 'string',
        'date_reglement' => 'string',
        'devise' => 'string',
        'montant_ht' => 'string',
        'montant_tva' => 'string',
        'montant_ttc' => 'string',
        'numero_bon_commande' => 'string',
        'reference_contrat' => 'string',
        'objet_facture' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'flow_id' => null,
        'format_source' => null,
        'ref_fournisseur' => null,
        'type_document' => null,
        'fournisseur' => null,
        'site_facturation_nom' => null,
        'site_facturation_siret' => null,
        'date_de_piece' => null,
        'date_reglement' => null,
        'devise' => null,
        'montant_ht' => null,
        'montant_tva' => null,
        'montant_ttc' => null,
        'numero_bon_commande' => null,
        'reference_contrat' => null,
        'objet_facture' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'flow_id' => true,
        'format_source' => false,
        'ref_fournisseur' => false,
        'type_document' => false,
        'fournisseur' => false,
        'site_facturation_nom' => false,
        'site_facturation_siret' => true,
        'date_de_piece' => false,
        'date_reglement' => true,
        'devise' => false,
        'montant_ht' => false,
        'montant_tva' => false,
        'montant_ttc' => false,
        'numero_bon_commande' => true,
        'reference_contrat' => true,
        'objet_facture' => true
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
        'flow_id' => 'flow_id',
        'format_source' => 'format_source',
        'ref_fournisseur' => 'ref_fournisseur',
        'type_document' => 'type_document',
        'fournisseur' => 'fournisseur',
        'site_facturation_nom' => 'site_facturation_nom',
        'site_facturation_siret' => 'site_facturation_siret',
        'date_de_piece' => 'date_de_piece',
        'date_reglement' => 'date_reglement',
        'devise' => 'devise',
        'montant_ht' => 'montant_ht',
        'montant_tva' => 'montant_tva',
        'montant_ttc' => 'montant_ttc',
        'numero_bon_commande' => 'numero_bon_commande',
        'reference_contrat' => 'reference_contrat',
        'objet_facture' => 'objet_facture'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'flow_id' => 'setFlowId',
        'format_source' => 'setFormatSource',
        'ref_fournisseur' => 'setRefFournisseur',
        'type_document' => 'setTypeDocument',
        'fournisseur' => 'setFournisseur',
        'site_facturation_nom' => 'setSiteFacturationNom',
        'site_facturation_siret' => 'setSiteFacturationSiret',
        'date_de_piece' => 'setDateDePiece',
        'date_reglement' => 'setDateReglement',
        'devise' => 'setDevise',
        'montant_ht' => 'setMontantHt',
        'montant_tva' => 'setMontantTva',
        'montant_ttc' => 'setMontantTtc',
        'numero_bon_commande' => 'setNumeroBonCommande',
        'reference_contrat' => 'setReferenceContrat',
        'objet_facture' => 'setObjetFacture'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'flow_id' => 'getFlowId',
        'format_source' => 'getFormatSource',
        'ref_fournisseur' => 'getRefFournisseur',
        'type_document' => 'getTypeDocument',
        'fournisseur' => 'getFournisseur',
        'site_facturation_nom' => 'getSiteFacturationNom',
        'site_facturation_siret' => 'getSiteFacturationSiret',
        'date_de_piece' => 'getDateDePiece',
        'date_reglement' => 'getDateReglement',
        'devise' => 'getDevise',
        'montant_ht' => 'getMontantHt',
        'montant_tva' => 'getMontantTva',
        'montant_ttc' => 'getMontantTtc',
        'numero_bon_commande' => 'getNumeroBonCommande',
        'reference_contrat' => 'getReferenceContrat',
        'objet_facture' => 'getObjetFacture'
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
        $this->setIfExists('flow_id', $data ?? [], null);
        $this->setIfExists('format_source', $data ?? [], null);
        $this->setIfExists('ref_fournisseur', $data ?? [], null);
        $this->setIfExists('type_document', $data ?? [], null);
        $this->setIfExists('fournisseur', $data ?? [], null);
        $this->setIfExists('site_facturation_nom', $data ?? [], null);
        $this->setIfExists('site_facturation_siret', $data ?? [], null);
        $this->setIfExists('date_de_piece', $data ?? [], null);
        $this->setIfExists('date_reglement', $data ?? [], null);
        $this->setIfExists('devise', $data ?? [], 'EUR');
        $this->setIfExists('montant_ht', $data ?? [], null);
        $this->setIfExists('montant_tva', $data ?? [], null);
        $this->setIfExists('montant_ttc', $data ?? [], null);
        $this->setIfExists('numero_bon_commande', $data ?? [], null);
        $this->setIfExists('reference_contrat', $data ?? [], null);
        $this->setIfExists('objet_facture', $data ?? [], null);
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

        if ($this->container['format_source'] === null) {
            $invalidProperties[] = "'format_source' can't be null";
        }
        if ($this->container['ref_fournisseur'] === null) {
            $invalidProperties[] = "'ref_fournisseur' can't be null";
        }
        if ($this->container['fournisseur'] === null) {
            $invalidProperties[] = "'fournisseur' can't be null";
        }
        if ($this->container['site_facturation_nom'] === null) {
            $invalidProperties[] = "'site_facturation_nom' can't be null";
        }
        if ($this->container['date_de_piece'] === null) {
            $invalidProperties[] = "'date_de_piece' can't be null";
        }
        if ($this->container['montant_ht'] === null) {
            $invalidProperties[] = "'montant_ht' can't be null";
        }
        if (!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", $this->container['montant_ht'])) {
            $invalidProperties[] = "invalid value for 'montant_ht', must be conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.";
        }

        if ($this->container['montant_tva'] === null) {
            $invalidProperties[] = "'montant_tva' can't be null";
        }
        if (!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", $this->container['montant_tva'])) {
            $invalidProperties[] = "invalid value for 'montant_tva', must be conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.";
        }

        if ($this->container['montant_ttc'] === null) {
            $invalidProperties[] = "'montant_ttc' can't be null";
        }
        if (!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", $this->container['montant_ttc'])) {
            $invalidProperties[] = "invalid value for 'montant_ttc', must be conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.";
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
     * Gets flow_id
     *
     * @return string|null
     */
    public function getFlowId()
    {
        return $this->container['flow_id'];
    }

    /**
     * Sets flow_id
     *
     * @param string|null $flow_id flow_id
     *
     * @return self
     */
    public function setFlowId($flow_id)
    {
        if (is_null($flow_id)) {
            array_push($this->openAPINullablesSetToNull, 'flow_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('flow_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['flow_id'] = $flow_id;

        return $this;
    }

    /**
     * Gets format_source
     *
     * @return \FactPulse\SDK\Model\FormatFacture
     */
    public function getFormatSource()
    {
        return $this->container['format_source'];
    }

    /**
     * Sets format_source
     *
     * @param \FactPulse\SDK\Model\FormatFacture $format_source Format source de la facture
     *
     * @return self
     */
    public function setFormatSource($format_source)
    {
        if (is_null($format_source)) {
            throw new \InvalidArgumentException('non-nullable format_source cannot be null');
        }
        $this->container['format_source'] = $format_source;

        return $this;
    }

    /**
     * Gets ref_fournisseur
     *
     * @return string
     */
    public function getRefFournisseur()
    {
        return $this->container['ref_fournisseur'];
    }

    /**
     * Sets ref_fournisseur
     *
     * @param string $ref_fournisseur Numéro de facture émis par le fournisseur (BT-1)
     *
     * @return self
     */
    public function setRefFournisseur($ref_fournisseur)
    {
        if (is_null($ref_fournisseur)) {
            throw new \InvalidArgumentException('non-nullable ref_fournisseur cannot be null');
        }
        $this->container['ref_fournisseur'] = $ref_fournisseur;

        return $this;
    }

    /**
     * Gets type_document
     *
     * @return \FactPulse\SDK\Model\TypeDocument|null
     */
    public function getTypeDocument()
    {
        return $this->container['type_document'];
    }

    /**
     * Sets type_document
     *
     * @param \FactPulse\SDK\Model\TypeDocument|null $type_document Type de document (BT-3)
     *
     * @return self
     */
    public function setTypeDocument($type_document)
    {
        if (is_null($type_document)) {
            throw new \InvalidArgumentException('non-nullable type_document cannot be null');
        }
        $this->container['type_document'] = $type_document;

        return $this;
    }

    /**
     * Gets fournisseur
     *
     * @return \FactPulse\SDK\Model\FournisseurEntrant
     */
    public function getFournisseur()
    {
        return $this->container['fournisseur'];
    }

    /**
     * Sets fournisseur
     *
     * @param \FactPulse\SDK\Model\FournisseurEntrant $fournisseur Émetteur de la facture (SellerTradeParty)
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
     * Gets site_facturation_nom
     *
     * @return string
     */
    public function getSiteFacturationNom()
    {
        return $this->container['site_facturation_nom'];
    }

    /**
     * Sets site_facturation_nom
     *
     * @param string $site_facturation_nom Nom du destinataire / votre entreprise (BT-44)
     *
     * @return self
     */
    public function setSiteFacturationNom($site_facturation_nom)
    {
        if (is_null($site_facturation_nom)) {
            throw new \InvalidArgumentException('non-nullable site_facturation_nom cannot be null');
        }
        $this->container['site_facturation_nom'] = $site_facturation_nom;

        return $this;
    }

    /**
     * Gets site_facturation_siret
     *
     * @return string|null
     */
    public function getSiteFacturationSiret()
    {
        return $this->container['site_facturation_siret'];
    }

    /**
     * Sets site_facturation_siret
     *
     * @param string|null $site_facturation_siret site_facturation_siret
     *
     * @return self
     */
    public function setSiteFacturationSiret($site_facturation_siret)
    {
        if (is_null($site_facturation_siret)) {
            array_push($this->openAPINullablesSetToNull, 'site_facturation_siret');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('site_facturation_siret', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['site_facturation_siret'] = $site_facturation_siret;

        return $this;
    }

    /**
     * Gets date_de_piece
     *
     * @return string
     */
    public function getDateDePiece()
    {
        return $this->container['date_de_piece'];
    }

    /**
     * Sets date_de_piece
     *
     * @param string $date_de_piece Date de la facture (BT-2) - YYYY-MM-DD
     *
     * @return self
     */
    public function setDateDePiece($date_de_piece)
    {
        if (is_null($date_de_piece)) {
            throw new \InvalidArgumentException('non-nullable date_de_piece cannot be null');
        }
        $this->container['date_de_piece'] = $date_de_piece;

        return $this;
    }

    /**
     * Gets date_reglement
     *
     * @return string|null
     */
    public function getDateReglement()
    {
        return $this->container['date_reglement'];
    }

    /**
     * Sets date_reglement
     *
     * @param string|null $date_reglement date_reglement
     *
     * @return self
     */
    public function setDateReglement($date_reglement)
    {
        if (is_null($date_reglement)) {
            array_push($this->openAPINullablesSetToNull, 'date_reglement');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_reglement', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_reglement'] = $date_reglement;

        return $this;
    }

    /**
     * Gets devise
     *
     * @return string|null
     */
    public function getDevise()
    {
        return $this->container['devise'];
    }

    /**
     * Sets devise
     *
     * @param string|null $devise Code devise ISO (BT-5)
     *
     * @return self
     */
    public function setDevise($devise)
    {
        if (is_null($devise)) {
            throw new \InvalidArgumentException('non-nullable devise cannot be null');
        }
        $this->container['devise'] = $devise;

        return $this;
    }

    /**
     * Gets montant_ht
     *
     * @return string
     */
    public function getMontantHt()
    {
        return $this->container['montant_ht'];
    }

    /**
     * Sets montant_ht
     *
     * @param string $montant_ht Montant HT total (BT-109)
     *
     * @return self
     */
    public function setMontantHt($montant_ht)
    {
        if (is_null($montant_ht)) {
            throw new \InvalidArgumentException('non-nullable montant_ht cannot be null');
        }

        if ((!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", ObjectSerializer::toString($montant_ht)))) {
            throw new \InvalidArgumentException("invalid value for \$montant_ht when calling FactureEntrante., must conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.");
        }

        $this->container['montant_ht'] = $montant_ht;

        return $this;
    }

    /**
     * Gets montant_tva
     *
     * @return string
     */
    public function getMontantTva()
    {
        return $this->container['montant_tva'];
    }

    /**
     * Sets montant_tva
     *
     * @param string $montant_tva Montant TVA total (BT-110)
     *
     * @return self
     */
    public function setMontantTva($montant_tva)
    {
        if (is_null($montant_tva)) {
            throw new \InvalidArgumentException('non-nullable montant_tva cannot be null');
        }

        if ((!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", ObjectSerializer::toString($montant_tva)))) {
            throw new \InvalidArgumentException("invalid value for \$montant_tva when calling FactureEntrante., must conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.");
        }

        $this->container['montant_tva'] = $montant_tva;

        return $this;
    }

    /**
     * Gets montant_ttc
     *
     * @return string
     */
    public function getMontantTtc()
    {
        return $this->container['montant_ttc'];
    }

    /**
     * Sets montant_ttc
     *
     * @param string $montant_ttc Montant TTC total (BT-112)
     *
     * @return self
     */
    public function setMontantTtc($montant_ttc)
    {
        if (is_null($montant_ttc)) {
            throw new \InvalidArgumentException('non-nullable montant_ttc cannot be null');
        }

        if ((!preg_match("/^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/", ObjectSerializer::toString($montant_ttc)))) {
            throw new \InvalidArgumentException("invalid value for \$montant_ttc when calling FactureEntrante., must conform to the pattern /^(?!^[-+.]*$)[+-]?0*\\d*\\.?\\d*$/.");
        }

        $this->container['montant_ttc'] = $montant_ttc;

        return $this;
    }

    /**
     * Gets numero_bon_commande
     *
     * @return string|null
     */
    public function getNumeroBonCommande()
    {
        return $this->container['numero_bon_commande'];
    }

    /**
     * Sets numero_bon_commande
     *
     * @param string|null $numero_bon_commande numero_bon_commande
     *
     * @return self
     */
    public function setNumeroBonCommande($numero_bon_commande)
    {
        if (is_null($numero_bon_commande)) {
            array_push($this->openAPINullablesSetToNull, 'numero_bon_commande');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('numero_bon_commande', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['numero_bon_commande'] = $numero_bon_commande;

        return $this;
    }

    /**
     * Gets reference_contrat
     *
     * @return string|null
     */
    public function getReferenceContrat()
    {
        return $this->container['reference_contrat'];
    }

    /**
     * Sets reference_contrat
     *
     * @param string|null $reference_contrat reference_contrat
     *
     * @return self
     */
    public function setReferenceContrat($reference_contrat)
    {
        if (is_null($reference_contrat)) {
            array_push($this->openAPINullablesSetToNull, 'reference_contrat');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('reference_contrat', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['reference_contrat'] = $reference_contrat;

        return $this;
    }

    /**
     * Gets objet_facture
     *
     * @return string|null
     */
    public function getObjetFacture()
    {
        return $this->container['objet_facture'];
    }

    /**
     * Sets objet_facture
     *
     * @param string|null $objet_facture objet_facture
     *
     * @return self
     */
    public function setObjetFacture($objet_facture)
    {
        if (is_null($objet_facture)) {
            array_push($this->openAPINullablesSetToNull, 'objet_facture');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('objet_facture', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['objet_facture'] = $objet_facture;

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


