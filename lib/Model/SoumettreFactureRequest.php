<?php
/**
 * SoumettreFactureRequest
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
 * SoumettreFactureRequest Class Doc Comment
 *
 * @category Class
 * @description Soumission d&#39;une facture Chorus Pro.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SoumettreFactureRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SoumettreFactureRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'credentials' => '\FactPulse\SDK\Model\ChorusProCredentials',
        'numero_facture' => 'string',
        'date_facture' => 'string',
        'date_echeance_paiement' => 'string',
        'id_structure_cpp' => 'int',
        'code_service' => 'string',
        'numero_engagement' => 'string',
        'montant_ht_total' => '\FactPulse\SDK\Model\MontantHtTotal',
        'montant_tva' => '\FactPulse\SDK\Model\MontantTva',
        'montant_ttc_total' => '\FactPulse\SDK\Model\MontantTtcTotal',
        'piece_jointe_principale_id' => 'int',
        'piece_jointe_principale_designation' => 'string',
        'commentaire' => 'string',
        'numero_bon_commande' => 'string',
        'numero_marche' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'credentials' => null,
        'numero_facture' => null,
        'date_facture' => null,
        'date_echeance_paiement' => null,
        'id_structure_cpp' => null,
        'code_service' => null,
        'numero_engagement' => null,
        'montant_ht_total' => null,
        'montant_tva' => null,
        'montant_ttc_total' => null,
        'piece_jointe_principale_id' => null,
        'piece_jointe_principale_designation' => null,
        'commentaire' => null,
        'numero_bon_commande' => null,
        'numero_marche' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'credentials' => true,
        'numero_facture' => false,
        'date_facture' => false,
        'date_echeance_paiement' => true,
        'id_structure_cpp' => false,
        'code_service' => true,
        'numero_engagement' => true,
        'montant_ht_total' => false,
        'montant_tva' => false,
        'montant_ttc_total' => false,
        'piece_jointe_principale_id' => true,
        'piece_jointe_principale_designation' => true,
        'commentaire' => true,
        'numero_bon_commande' => true,
        'numero_marche' => true
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
        'credentials' => 'credentials',
        'numero_facture' => 'numero_facture',
        'date_facture' => 'date_facture',
        'date_echeance_paiement' => 'date_echeance_paiement',
        'id_structure_cpp' => 'id_structure_cpp',
        'code_service' => 'code_service',
        'numero_engagement' => 'numero_engagement',
        'montant_ht_total' => 'montant_ht_total',
        'montant_tva' => 'montant_tva',
        'montant_ttc_total' => 'montant_ttc_total',
        'piece_jointe_principale_id' => 'piece_jointe_principale_id',
        'piece_jointe_principale_designation' => 'piece_jointe_principale_designation',
        'commentaire' => 'commentaire',
        'numero_bon_commande' => 'numero_bon_commande',
        'numero_marche' => 'numero_marche'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'credentials' => 'setCredentials',
        'numero_facture' => 'setNumeroFacture',
        'date_facture' => 'setDateFacture',
        'date_echeance_paiement' => 'setDateEcheancePaiement',
        'id_structure_cpp' => 'setIdStructureCpp',
        'code_service' => 'setCodeService',
        'numero_engagement' => 'setNumeroEngagement',
        'montant_ht_total' => 'setMontantHtTotal',
        'montant_tva' => 'setMontantTva',
        'montant_ttc_total' => 'setMontantTtcTotal',
        'piece_jointe_principale_id' => 'setPieceJointePrincipaleId',
        'piece_jointe_principale_designation' => 'setPieceJointePrincipaleDesignation',
        'commentaire' => 'setCommentaire',
        'numero_bon_commande' => 'setNumeroBonCommande',
        'numero_marche' => 'setNumeroMarche'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'credentials' => 'getCredentials',
        'numero_facture' => 'getNumeroFacture',
        'date_facture' => 'getDateFacture',
        'date_echeance_paiement' => 'getDateEcheancePaiement',
        'id_structure_cpp' => 'getIdStructureCpp',
        'code_service' => 'getCodeService',
        'numero_engagement' => 'getNumeroEngagement',
        'montant_ht_total' => 'getMontantHtTotal',
        'montant_tva' => 'getMontantTva',
        'montant_ttc_total' => 'getMontantTtcTotal',
        'piece_jointe_principale_id' => 'getPieceJointePrincipaleId',
        'piece_jointe_principale_designation' => 'getPieceJointePrincipaleDesignation',
        'commentaire' => 'getCommentaire',
        'numero_bon_commande' => 'getNumeroBonCommande',
        'numero_marche' => 'getNumeroMarche'
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
        $this->setIfExists('credentials', $data ?? [], null);
        $this->setIfExists('numero_facture', $data ?? [], null);
        $this->setIfExists('date_facture', $data ?? [], null);
        $this->setIfExists('date_echeance_paiement', $data ?? [], null);
        $this->setIfExists('id_structure_cpp', $data ?? [], null);
        $this->setIfExists('code_service', $data ?? [], null);
        $this->setIfExists('numero_engagement', $data ?? [], null);
        $this->setIfExists('montant_ht_total', $data ?? [], null);
        $this->setIfExists('montant_tva', $data ?? [], null);
        $this->setIfExists('montant_ttc_total', $data ?? [], null);
        $this->setIfExists('piece_jointe_principale_id', $data ?? [], null);
        $this->setIfExists('piece_jointe_principale_designation', $data ?? [], null);
        $this->setIfExists('commentaire', $data ?? [], null);
        $this->setIfExists('numero_bon_commande', $data ?? [], null);
        $this->setIfExists('numero_marche', $data ?? [], null);
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
        if ($this->container['date_facture'] === null) {
            $invalidProperties[] = "'date_facture' can't be null";
        }
        if ($this->container['id_structure_cpp'] === null) {
            $invalidProperties[] = "'id_structure_cpp' can't be null";
        }
        if ($this->container['montant_ht_total'] === null) {
            $invalidProperties[] = "'montant_ht_total' can't be null";
        }
        if ($this->container['montant_tva'] === null) {
            $invalidProperties[] = "'montant_tva' can't be null";
        }
        if ($this->container['montant_ttc_total'] === null) {
            $invalidProperties[] = "'montant_ttc_total' can't be null";
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
     * Gets credentials
     *
     * @return \FactPulse\SDK\Model\ChorusProCredentials|null
     */
    public function getCredentials()
    {
        return $this->container['credentials'];
    }

    /**
     * Sets credentials
     *
     * @param \FactPulse\SDK\Model\ChorusProCredentials|null $credentials credentials
     *
     * @return self
     */
    public function setCredentials($credentials)
    {
        if (is_null($credentials)) {
            array_push($this->openAPINullablesSetToNull, 'credentials');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('credentials', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['credentials'] = $credentials;

        return $this;
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
     * @param string $numero_facture Numéro de la facture
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
     * Gets date_facture
     *
     * @return string
     */
    public function getDateFacture()
    {
        return $this->container['date_facture'];
    }

    /**
     * Sets date_facture
     *
     * @param string $date_facture Date de facture (format ISO: YYYY-MM-DD)
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
     * Gets date_echeance_paiement
     *
     * @return string|null
     */
    public function getDateEcheancePaiement()
    {
        return $this->container['date_echeance_paiement'];
    }

    /**
     * Sets date_echeance_paiement
     *
     * @param string|null $date_echeance_paiement date_echeance_paiement
     *
     * @return self
     */
    public function setDateEcheancePaiement($date_echeance_paiement)
    {
        if (is_null($date_echeance_paiement)) {
            array_push($this->openAPINullablesSetToNull, 'date_echeance_paiement');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_echeance_paiement', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_echeance_paiement'] = $date_echeance_paiement;

        return $this;
    }

    /**
     * Gets id_structure_cpp
     *
     * @return int
     */
    public function getIdStructureCpp()
    {
        return $this->container['id_structure_cpp'];
    }

    /**
     * Sets id_structure_cpp
     *
     * @param int $id_structure_cpp ID Chorus Pro de la structure destinataire
     *
     * @return self
     */
    public function setIdStructureCpp($id_structure_cpp)
    {
        if (is_null($id_structure_cpp)) {
            throw new \InvalidArgumentException('non-nullable id_structure_cpp cannot be null');
        }
        $this->container['id_structure_cpp'] = $id_structure_cpp;

        return $this;
    }

    /**
     * Gets code_service
     *
     * @return string|null
     */
    public function getCodeService()
    {
        return $this->container['code_service'];
    }

    /**
     * Sets code_service
     *
     * @param string|null $code_service code_service
     *
     * @return self
     */
    public function setCodeService($code_service)
    {
        if (is_null($code_service)) {
            array_push($this->openAPINullablesSetToNull, 'code_service');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('code_service', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['code_service'] = $code_service;

        return $this;
    }

    /**
     * Gets numero_engagement
     *
     * @return string|null
     */
    public function getNumeroEngagement()
    {
        return $this->container['numero_engagement'];
    }

    /**
     * Sets numero_engagement
     *
     * @param string|null $numero_engagement numero_engagement
     *
     * @return self
     */
    public function setNumeroEngagement($numero_engagement)
    {
        if (is_null($numero_engagement)) {
            array_push($this->openAPINullablesSetToNull, 'numero_engagement');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('numero_engagement', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['numero_engagement'] = $numero_engagement;

        return $this;
    }

    /**
     * Gets montant_ht_total
     *
     * @return \FactPulse\SDK\Model\MontantHtTotal
     */
    public function getMontantHtTotal()
    {
        return $this->container['montant_ht_total'];
    }

    /**
     * Sets montant_ht_total
     *
     * @param \FactPulse\SDK\Model\MontantHtTotal $montant_ht_total montant_ht_total
     *
     * @return self
     */
    public function setMontantHtTotal($montant_ht_total)
    {
        if (is_null($montant_ht_total)) {
            throw new \InvalidArgumentException('non-nullable montant_ht_total cannot be null');
        }
        $this->container['montant_ht_total'] = $montant_ht_total;

        return $this;
    }

    /**
     * Gets montant_tva
     *
     * @return \FactPulse\SDK\Model\MontantTva
     */
    public function getMontantTva()
    {
        return $this->container['montant_tva'];
    }

    /**
     * Sets montant_tva
     *
     * @param \FactPulse\SDK\Model\MontantTva $montant_tva montant_tva
     *
     * @return self
     */
    public function setMontantTva($montant_tva)
    {
        if (is_null($montant_tva)) {
            throw new \InvalidArgumentException('non-nullable montant_tva cannot be null');
        }
        $this->container['montant_tva'] = $montant_tva;

        return $this;
    }

    /**
     * Gets montant_ttc_total
     *
     * @return \FactPulse\SDK\Model\MontantTtcTotal
     */
    public function getMontantTtcTotal()
    {
        return $this->container['montant_ttc_total'];
    }

    /**
     * Sets montant_ttc_total
     *
     * @param \FactPulse\SDK\Model\MontantTtcTotal $montant_ttc_total montant_ttc_total
     *
     * @return self
     */
    public function setMontantTtcTotal($montant_ttc_total)
    {
        if (is_null($montant_ttc_total)) {
            throw new \InvalidArgumentException('non-nullable montant_ttc_total cannot be null');
        }
        $this->container['montant_ttc_total'] = $montant_ttc_total;

        return $this;
    }

    /**
     * Gets piece_jointe_principale_id
     *
     * @return int|null
     */
    public function getPieceJointePrincipaleId()
    {
        return $this->container['piece_jointe_principale_id'];
    }

    /**
     * Sets piece_jointe_principale_id
     *
     * @param int|null $piece_jointe_principale_id piece_jointe_principale_id
     *
     * @return self
     */
    public function setPieceJointePrincipaleId($piece_jointe_principale_id)
    {
        if (is_null($piece_jointe_principale_id)) {
            array_push($this->openAPINullablesSetToNull, 'piece_jointe_principale_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('piece_jointe_principale_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['piece_jointe_principale_id'] = $piece_jointe_principale_id;

        return $this;
    }

    /**
     * Gets piece_jointe_principale_designation
     *
     * @return string|null
     */
    public function getPieceJointePrincipaleDesignation()
    {
        return $this->container['piece_jointe_principale_designation'];
    }

    /**
     * Sets piece_jointe_principale_designation
     *
     * @param string|null $piece_jointe_principale_designation piece_jointe_principale_designation
     *
     * @return self
     */
    public function setPieceJointePrincipaleDesignation($piece_jointe_principale_designation)
    {
        if (is_null($piece_jointe_principale_designation)) {
            array_push($this->openAPINullablesSetToNull, 'piece_jointe_principale_designation');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('piece_jointe_principale_designation', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['piece_jointe_principale_designation'] = $piece_jointe_principale_designation;

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
     * Gets numero_marche
     *
     * @return string|null
     */
    public function getNumeroMarche()
    {
        return $this->container['numero_marche'];
    }

    /**
     * Sets numero_marche
     *
     * @param string|null $numero_marche numero_marche
     *
     * @return self
     */
    public function setNumeroMarche($numero_marche)
    {
        if (is_null($numero_marche)) {
            array_push($this->openAPINullablesSetToNull, 'numero_marche');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('numero_marche', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['numero_marche'] = $numero_marche;

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


