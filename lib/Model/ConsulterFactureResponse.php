<?php
/**
 * ConsulterFactureResponse
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
 * ConsulterFactureResponse Class Doc Comment
 *
 * @category Class
 * @description Détails d&#39;une facture.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ConsulterFactureResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ConsulterFactureResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'code_retour' => 'int',
        'libelle' => 'string',
        'identifiant_facture_cpp' => 'int',
        'numero_facture' => 'string',
        'date_facture' => 'string',
        'montant_ttc_total' => 'string',
        'statut_courant' => '\FactPulse\SDK\Model\StatutFacture',
        'id_structure_cpp_destinataire' => 'int',
        'designation_structure_destinataire' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'code_retour' => null,
        'libelle' => null,
        'identifiant_facture_cpp' => null,
        'numero_facture' => null,
        'date_facture' => null,
        'montant_ttc_total' => null,
        'statut_courant' => null,
        'id_structure_cpp_destinataire' => null,
        'designation_structure_destinataire' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'code_retour' => false,
        'libelle' => false,
        'identifiant_facture_cpp' => true,
        'numero_facture' => true,
        'date_facture' => true,
        'montant_ttc_total' => true,
        'statut_courant' => true,
        'id_structure_cpp_destinataire' => true,
        'designation_structure_destinataire' => true
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
        'code_retour' => 'code_retour',
        'libelle' => 'libelle',
        'identifiant_facture_cpp' => 'identifiant_facture_cpp',
        'numero_facture' => 'numero_facture',
        'date_facture' => 'date_facture',
        'montant_ttc_total' => 'montant_ttc_total',
        'statut_courant' => 'statut_courant',
        'id_structure_cpp_destinataire' => 'id_structure_cpp_destinataire',
        'designation_structure_destinataire' => 'designation_structure_destinataire'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'code_retour' => 'setCodeRetour',
        'libelle' => 'setLibelle',
        'identifiant_facture_cpp' => 'setIdentifiantFactureCpp',
        'numero_facture' => 'setNumeroFacture',
        'date_facture' => 'setDateFacture',
        'montant_ttc_total' => 'setMontantTtcTotal',
        'statut_courant' => 'setStatutCourant',
        'id_structure_cpp_destinataire' => 'setIdStructureCppDestinataire',
        'designation_structure_destinataire' => 'setDesignationStructureDestinataire'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'code_retour' => 'getCodeRetour',
        'libelle' => 'getLibelle',
        'identifiant_facture_cpp' => 'getIdentifiantFactureCpp',
        'numero_facture' => 'getNumeroFacture',
        'date_facture' => 'getDateFacture',
        'montant_ttc_total' => 'getMontantTtcTotal',
        'statut_courant' => 'getStatutCourant',
        'id_structure_cpp_destinataire' => 'getIdStructureCppDestinataire',
        'designation_structure_destinataire' => 'getDesignationStructureDestinataire'
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
        $this->setIfExists('code_retour', $data ?? [], null);
        $this->setIfExists('libelle', $data ?? [], null);
        $this->setIfExists('identifiant_facture_cpp', $data ?? [], null);
        $this->setIfExists('numero_facture', $data ?? [], null);
        $this->setIfExists('date_facture', $data ?? [], null);
        $this->setIfExists('montant_ttc_total', $data ?? [], null);
        $this->setIfExists('statut_courant', $data ?? [], null);
        $this->setIfExists('id_structure_cpp_destinataire', $data ?? [], null);
        $this->setIfExists('designation_structure_destinataire', $data ?? [], null);
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

        if ($this->container['code_retour'] === null) {
            $invalidProperties[] = "'code_retour' can't be null";
        }
        if ($this->container['libelle'] === null) {
            $invalidProperties[] = "'libelle' can't be null";
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
     * Gets code_retour
     *
     * @return int
     */
    public function getCodeRetour()
    {
        return $this->container['code_retour'];
    }

    /**
     * Sets code_retour
     *
     * @param int $code_retour code_retour
     *
     * @return self
     */
    public function setCodeRetour($code_retour)
    {
        if (is_null($code_retour)) {
            throw new \InvalidArgumentException('non-nullable code_retour cannot be null');
        }
        $this->container['code_retour'] = $code_retour;

        return $this;
    }

    /**
     * Gets libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->container['libelle'];
    }

    /**
     * Sets libelle
     *
     * @param string $libelle libelle
     *
     * @return self
     */
    public function setLibelle($libelle)
    {
        if (is_null($libelle)) {
            throw new \InvalidArgumentException('non-nullable libelle cannot be null');
        }
        $this->container['libelle'] = $libelle;

        return $this;
    }

    /**
     * Gets identifiant_facture_cpp
     *
     * @return int|null
     */
    public function getIdentifiantFactureCpp()
    {
        return $this->container['identifiant_facture_cpp'];
    }

    /**
     * Sets identifiant_facture_cpp
     *
     * @param int|null $identifiant_facture_cpp identifiant_facture_cpp
     *
     * @return self
     */
    public function setIdentifiantFactureCpp($identifiant_facture_cpp)
    {
        if (is_null($identifiant_facture_cpp)) {
            array_push($this->openAPINullablesSetToNull, 'identifiant_facture_cpp');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('identifiant_facture_cpp', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['identifiant_facture_cpp'] = $identifiant_facture_cpp;

        return $this;
    }

    /**
     * Gets numero_facture
     *
     * @return string|null
     */
    public function getNumeroFacture()
    {
        return $this->container['numero_facture'];
    }

    /**
     * Sets numero_facture
     *
     * @param string|null $numero_facture numero_facture
     *
     * @return self
     */
    public function setNumeroFacture($numero_facture)
    {
        if (is_null($numero_facture)) {
            array_push($this->openAPINullablesSetToNull, 'numero_facture');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('numero_facture', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['numero_facture'] = $numero_facture;

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
            array_push($this->openAPINullablesSetToNull, 'date_facture');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_facture', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_facture'] = $date_facture;

        return $this;
    }

    /**
     * Gets montant_ttc_total
     *
     * @return string|null
     */
    public function getMontantTtcTotal()
    {
        return $this->container['montant_ttc_total'];
    }

    /**
     * Sets montant_ttc_total
     *
     * @param string|null $montant_ttc_total montant_ttc_total
     *
     * @return self
     */
    public function setMontantTtcTotal($montant_ttc_total)
    {
        if (is_null($montant_ttc_total)) {
            array_push($this->openAPINullablesSetToNull, 'montant_ttc_total');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('montant_ttc_total', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['montant_ttc_total'] = $montant_ttc_total;

        return $this;
    }

    /**
     * Gets statut_courant
     *
     * @return \FactPulse\SDK\Model\StatutFacture|null
     */
    public function getStatutCourant()
    {
        return $this->container['statut_courant'];
    }

    /**
     * Sets statut_courant
     *
     * @param \FactPulse\SDK\Model\StatutFacture|null $statut_courant statut_courant
     *
     * @return self
     */
    public function setStatutCourant($statut_courant)
    {
        if (is_null($statut_courant)) {
            array_push($this->openAPINullablesSetToNull, 'statut_courant');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('statut_courant', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['statut_courant'] = $statut_courant;

        return $this;
    }

    /**
     * Gets id_structure_cpp_destinataire
     *
     * @return int|null
     */
    public function getIdStructureCppDestinataire()
    {
        return $this->container['id_structure_cpp_destinataire'];
    }

    /**
     * Sets id_structure_cpp_destinataire
     *
     * @param int|null $id_structure_cpp_destinataire id_structure_cpp_destinataire
     *
     * @return self
     */
    public function setIdStructureCppDestinataire($id_structure_cpp_destinataire)
    {
        if (is_null($id_structure_cpp_destinataire)) {
            array_push($this->openAPINullablesSetToNull, 'id_structure_cpp_destinataire');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('id_structure_cpp_destinataire', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['id_structure_cpp_destinataire'] = $id_structure_cpp_destinataire;

        return $this;
    }

    /**
     * Gets designation_structure_destinataire
     *
     * @return string|null
     */
    public function getDesignationStructureDestinataire()
    {
        return $this->container['designation_structure_destinataire'];
    }

    /**
     * Sets designation_structure_destinataire
     *
     * @param string|null $designation_structure_destinataire designation_structure_destinataire
     *
     * @return self
     */
    public function setDesignationStructureDestinataire($designation_structure_destinataire)
    {
        if (is_null($designation_structure_destinataire)) {
            array_push($this->openAPINullablesSetToNull, 'designation_structure_destinataire');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('designation_structure_destinataire', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['designation_structure_destinataire'] = $designation_structure_destinataire;

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


