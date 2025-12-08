<?php
/**
 * ReponseVerificationSucces
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
 * ReponseVerificationSucces Class Doc Comment
 *
 * @category Class
 * @description Réponse de vérification réussie avec données unifiées.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ReponseVerificationSucces implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ReponseVerificationSucces';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'est_conforme' => 'bool',
        'score_conformite' => 'float',
        'champs_verifies' => 'int',
        'champs_conformes' => 'int',
        'est_facturx' => 'bool',
        'profil_facturx' => 'string',
        'champs' => '\FactPulse\SDK\Model\ChampVerifieSchema[]',
        'notes_obligatoires' => '\FactPulse\SDK\Model\NoteObligatoireSchema[]',
        'dimensions_pages' => '\FactPulse\SDK\Model\DimensionPageSchema[]',
        'avertissements' => 'string[]'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'est_conforme' => null,
        'score_conformite' => null,
        'champs_verifies' => null,
        'champs_conformes' => null,
        'est_facturx' => null,
        'profil_facturx' => null,
        'champs' => null,
        'notes_obligatoires' => null,
        'dimensions_pages' => null,
        'avertissements' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'est_conforme' => false,
        'score_conformite' => false,
        'champs_verifies' => false,
        'champs_conformes' => false,
        'est_facturx' => false,
        'profil_facturx' => true,
        'champs' => false,
        'notes_obligatoires' => false,
        'dimensions_pages' => false,
        'avertissements' => false
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
        'est_conforme' => 'est_conforme',
        'score_conformite' => 'score_conformite',
        'champs_verifies' => 'champs_verifies',
        'champs_conformes' => 'champs_conformes',
        'est_facturx' => 'est_facturx',
        'profil_facturx' => 'profil_facturx',
        'champs' => 'champs',
        'notes_obligatoires' => 'notes_obligatoires',
        'dimensions_pages' => 'dimensions_pages',
        'avertissements' => 'avertissements'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'est_conforme' => 'setEstConforme',
        'score_conformite' => 'setScoreConformite',
        'champs_verifies' => 'setChampsVerifies',
        'champs_conformes' => 'setChampsConformes',
        'est_facturx' => 'setEstFacturx',
        'profil_facturx' => 'setProfilFacturx',
        'champs' => 'setChamps',
        'notes_obligatoires' => 'setNotesObligatoires',
        'dimensions_pages' => 'setDimensionsPages',
        'avertissements' => 'setAvertissements'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'est_conforme' => 'getEstConforme',
        'score_conformite' => 'getScoreConformite',
        'champs_verifies' => 'getChampsVerifies',
        'champs_conformes' => 'getChampsConformes',
        'est_facturx' => 'getEstFacturx',
        'profil_facturx' => 'getProfilFacturx',
        'champs' => 'getChamps',
        'notes_obligatoires' => 'getNotesObligatoires',
        'dimensions_pages' => 'getDimensionsPages',
        'avertissements' => 'getAvertissements'
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
        $this->setIfExists('est_conforme', $data ?? [], null);
        $this->setIfExists('score_conformite', $data ?? [], null);
        $this->setIfExists('champs_verifies', $data ?? [], 0);
        $this->setIfExists('champs_conformes', $data ?? [], 0);
        $this->setIfExists('est_facturx', $data ?? [], false);
        $this->setIfExists('profil_facturx', $data ?? [], null);
        $this->setIfExists('champs', $data ?? [], null);
        $this->setIfExists('notes_obligatoires', $data ?? [], null);
        $this->setIfExists('dimensions_pages', $data ?? [], null);
        $this->setIfExists('avertissements', $data ?? [], null);
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

        if ($this->container['est_conforme'] === null) {
            $invalidProperties[] = "'est_conforme' can't be null";
        }
        if ($this->container['score_conformite'] === null) {
            $invalidProperties[] = "'score_conformite' can't be null";
        }
        if (($this->container['score_conformite'] > 100.0)) {
            $invalidProperties[] = "invalid value for 'score_conformite', must be smaller than or equal to 100.0.";
        }

        if (($this->container['score_conformite'] < 0.0)) {
            $invalidProperties[] = "invalid value for 'score_conformite', must be bigger than or equal to 0.0.";
        }

        if (!is_null($this->container['champs_verifies']) && ($this->container['champs_verifies'] < 0)) {
            $invalidProperties[] = "invalid value for 'champs_verifies', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['champs_conformes']) && ($this->container['champs_conformes'] < 0)) {
            $invalidProperties[] = "invalid value for 'champs_conformes', must be bigger than or equal to 0.";
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
     * Gets est_conforme
     *
     * @return bool
     */
    public function getEstConforme()
    {
        return $this->container['est_conforme'];
    }

    /**
     * Sets est_conforme
     *
     * @param bool $est_conforme True si aucun écart critique
     *
     * @return self
     */
    public function setEstConforme($est_conforme)
    {
        if (is_null($est_conforme)) {
            throw new \InvalidArgumentException('non-nullable est_conforme cannot be null');
        }
        $this->container['est_conforme'] = $est_conforme;

        return $this;
    }

    /**
     * Gets score_conformite
     *
     * @return float
     */
    public function getScoreConformite()
    {
        return $this->container['score_conformite'];
    }

    /**
     * Sets score_conformite
     *
     * @param float $score_conformite Score de conformité (0-100%)
     *
     * @return self
     */
    public function setScoreConformite($score_conformite)
    {
        if (is_null($score_conformite)) {
            throw new \InvalidArgumentException('non-nullable score_conformite cannot be null');
        }

        if (($score_conformite > 100.0)) {
            throw new \InvalidArgumentException('invalid value for $score_conformite when calling ReponseVerificationSucces., must be smaller than or equal to 100.0.');
        }
        if (($score_conformite < 0.0)) {
            throw new \InvalidArgumentException('invalid value for $score_conformite when calling ReponseVerificationSucces., must be bigger than or equal to 0.0.');
        }

        $this->container['score_conformite'] = $score_conformite;

        return $this;
    }

    /**
     * Gets champs_verifies
     *
     * @return int|null
     */
    public function getChampsVerifies()
    {
        return $this->container['champs_verifies'];
    }

    /**
     * Sets champs_verifies
     *
     * @param int|null $champs_verifies Nombre de champs vérifiés
     *
     * @return self
     */
    public function setChampsVerifies($champs_verifies)
    {
        if (is_null($champs_verifies)) {
            throw new \InvalidArgumentException('non-nullable champs_verifies cannot be null');
        }

        if (($champs_verifies < 0)) {
            throw new \InvalidArgumentException('invalid value for $champs_verifies when calling ReponseVerificationSucces., must be bigger than or equal to 0.');
        }

        $this->container['champs_verifies'] = $champs_verifies;

        return $this;
    }

    /**
     * Gets champs_conformes
     *
     * @return int|null
     */
    public function getChampsConformes()
    {
        return $this->container['champs_conformes'];
    }

    /**
     * Sets champs_conformes
     *
     * @param int|null $champs_conformes Nombre de champs conformes
     *
     * @return self
     */
    public function setChampsConformes($champs_conformes)
    {
        if (is_null($champs_conformes)) {
            throw new \InvalidArgumentException('non-nullable champs_conformes cannot be null');
        }

        if (($champs_conformes < 0)) {
            throw new \InvalidArgumentException('invalid value for $champs_conformes when calling ReponseVerificationSucces., must be bigger than or equal to 0.');
        }

        $this->container['champs_conformes'] = $champs_conformes;

        return $this;
    }

    /**
     * Gets est_facturx
     *
     * @return bool|null
     */
    public function getEstFacturx()
    {
        return $this->container['est_facturx'];
    }

    /**
     * Sets est_facturx
     *
     * @param bool|null $est_facturx True si le PDF contient du XML Factur-X
     *
     * @return self
     */
    public function setEstFacturx($est_facturx)
    {
        if (is_null($est_facturx)) {
            throw new \InvalidArgumentException('non-nullable est_facturx cannot be null');
        }
        $this->container['est_facturx'] = $est_facturx;

        return $this;
    }

    /**
     * Gets profil_facturx
     *
     * @return string|null
     */
    public function getProfilFacturx()
    {
        return $this->container['profil_facturx'];
    }

    /**
     * Sets profil_facturx
     *
     * @param string|null $profil_facturx profil_facturx
     *
     * @return self
     */
    public function setProfilFacturx($profil_facturx)
    {
        if (is_null($profil_facturx)) {
            array_push($this->openAPINullablesSetToNull, 'profil_facturx');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('profil_facturx', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['profil_facturx'] = $profil_facturx;

        return $this;
    }

    /**
     * Gets champs
     *
     * @return \FactPulse\SDK\Model\ChampVerifieSchema[]|null
     */
    public function getChamps()
    {
        return $this->container['champs'];
    }

    /**
     * Sets champs
     *
     * @param \FactPulse\SDK\Model\ChampVerifieSchema[]|null $champs Liste des champs vérifiés avec valeurs, statuts et coordonnées PDF
     *
     * @return self
     */
    public function setChamps($champs)
    {
        if (is_null($champs)) {
            throw new \InvalidArgumentException('non-nullable champs cannot be null');
        }
        $this->container['champs'] = $champs;

        return $this;
    }

    /**
     * Gets notes_obligatoires
     *
     * @return \FactPulse\SDK\Model\NoteObligatoireSchema[]|null
     */
    public function getNotesObligatoires()
    {
        return $this->container['notes_obligatoires'];
    }

    /**
     * Sets notes_obligatoires
     *
     * @param \FactPulse\SDK\Model\NoteObligatoireSchema[]|null $notes_obligatoires Notes obligatoires (PMT, PMD, AAB) avec localisation PDF
     *
     * @return self
     */
    public function setNotesObligatoires($notes_obligatoires)
    {
        if (is_null($notes_obligatoires)) {
            throw new \InvalidArgumentException('non-nullable notes_obligatoires cannot be null');
        }
        $this->container['notes_obligatoires'] = $notes_obligatoires;

        return $this;
    }

    /**
     * Gets dimensions_pages
     *
     * @return \FactPulse\SDK\Model\DimensionPageSchema[]|null
     */
    public function getDimensionsPages()
    {
        return $this->container['dimensions_pages'];
    }

    /**
     * Sets dimensions_pages
     *
     * @param \FactPulse\SDK\Model\DimensionPageSchema[]|null $dimensions_pages Dimensions de chaque page du PDF (largeur, hauteur)
     *
     * @return self
     */
    public function setDimensionsPages($dimensions_pages)
    {
        if (is_null($dimensions_pages)) {
            throw new \InvalidArgumentException('non-nullable dimensions_pages cannot be null');
        }
        $this->container['dimensions_pages'] = $dimensions_pages;

        return $this;
    }

    /**
     * Gets avertissements
     *
     * @return string[]|null
     */
    public function getAvertissements()
    {
        return $this->container['avertissements'];
    }

    /**
     * Sets avertissements
     *
     * @param string[]|null $avertissements Avertissements non bloquants
     *
     * @return self
     */
    public function setAvertissements($avertissements)
    {
        if (is_null($avertissements)) {
            throw new \InvalidArgumentException('non-nullable avertissements cannot be null');
        }
        $this->container['avertissements'] = $avertissements;

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


