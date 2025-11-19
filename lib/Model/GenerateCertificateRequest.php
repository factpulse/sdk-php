<?php
/**
 * GenerateCertificateRequest
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
 * GenerateCertificateRequest Class Doc Comment
 *
 * @category Class
 * @description Requête pour générer un certificat X.509 auto-signé de test.  ⚠️ ATTENTION : Ce certificat est destiné uniquement aux TESTS. NE PAS utiliser en production ! Niveau eIDAS : SES (Simple Electronic Signature)
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class GenerateCertificateRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'GenerateCertificateRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'cn' => 'string',
        'organisation' => 'string',
        'pays' => 'string',
        'ville' => 'string',
        'province' => 'string',
        'email' => 'string',
        'duree_jours' => 'int',
        'taille_cle' => 'int',
        'passphrase_cle' => 'string',
        'generer_p12' => 'bool',
        'passphrase_p12' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'cn' => null,
        'organisation' => null,
        'pays' => null,
        'ville' => null,
        'province' => null,
        'email' => null,
        'duree_jours' => null,
        'taille_cle' => null,
        'passphrase_cle' => null,
        'generer_p12' => null,
        'passphrase_p12' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'cn' => false,
        'organisation' => false,
        'pays' => false,
        'ville' => false,
        'province' => false,
        'email' => true,
        'duree_jours' => false,
        'taille_cle' => false,
        'passphrase_cle' => true,
        'generer_p12' => false,
        'passphrase_p12' => false
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
        'cn' => 'cn',
        'organisation' => 'organisation',
        'pays' => 'pays',
        'ville' => 'ville',
        'province' => 'province',
        'email' => 'email',
        'duree_jours' => 'duree_jours',
        'taille_cle' => 'taille_cle',
        'passphrase_cle' => 'passphrase_cle',
        'generer_p12' => 'generer_p12',
        'passphrase_p12' => 'passphrase_p12'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cn' => 'setCn',
        'organisation' => 'setOrganisation',
        'pays' => 'setPays',
        'ville' => 'setVille',
        'province' => 'setProvince',
        'email' => 'setEmail',
        'duree_jours' => 'setDureeJours',
        'taille_cle' => 'setTailleCle',
        'passphrase_cle' => 'setPassphraseCle',
        'generer_p12' => 'setGenererP12',
        'passphrase_p12' => 'setPassphraseP12'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cn' => 'getCn',
        'organisation' => 'getOrganisation',
        'pays' => 'getPays',
        'ville' => 'getVille',
        'province' => 'getProvince',
        'email' => 'getEmail',
        'duree_jours' => 'getDureeJours',
        'taille_cle' => 'getTailleCle',
        'passphrase_cle' => 'getPassphraseCle',
        'generer_p12' => 'getGenererP12',
        'passphrase_p12' => 'getPassphraseP12'
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
        $this->setIfExists('cn', $data ?? [], 'Test Signature FactPulse');
        $this->setIfExists('organisation', $data ?? [], 'FactPulse Test');
        $this->setIfExists('pays', $data ?? [], 'FR');
        $this->setIfExists('ville', $data ?? [], 'Paris');
        $this->setIfExists('province', $data ?? [], 'Ile-de-France');
        $this->setIfExists('email', $data ?? [], null);
        $this->setIfExists('duree_jours', $data ?? [], 365);
        $this->setIfExists('taille_cle', $data ?? [], 2048);
        $this->setIfExists('passphrase_cle', $data ?? [], null);
        $this->setIfExists('generer_p12', $data ?? [], false);
        $this->setIfExists('passphrase_p12', $data ?? [], 'changeme');
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

        if (!is_null($this->container['pays']) && (mb_strlen($this->container['pays']) > 2)) {
            $invalidProperties[] = "invalid value for 'pays', the character length must be smaller than or equal to 2.";
        }

        if (!is_null($this->container['pays']) && (mb_strlen($this->container['pays']) < 2)) {
            $invalidProperties[] = "invalid value for 'pays', the character length must be bigger than or equal to 2.";
        }

        if (!is_null($this->container['duree_jours']) && ($this->container['duree_jours'] > 3650)) {
            $invalidProperties[] = "invalid value for 'duree_jours', must be smaller than or equal to 3650.";
        }

        if (!is_null($this->container['duree_jours']) && ($this->container['duree_jours'] < 1)) {
            $invalidProperties[] = "invalid value for 'duree_jours', must be bigger than or equal to 1.";
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
     * Gets cn
     *
     * @return string|null
     */
    public function getCn()
    {
        return $this->container['cn'];
    }

    /**
     * Sets cn
     *
     * @param string|null $cn Common Name (CN) - Nom du certificat
     *
     * @return self
     */
    public function setCn($cn)
    {
        if (is_null($cn)) {
            throw new \InvalidArgumentException('non-nullable cn cannot be null');
        }
        $this->container['cn'] = $cn;

        return $this;
    }

    /**
     * Gets organisation
     *
     * @return string|null
     */
    public function getOrganisation()
    {
        return $this->container['organisation'];
    }

    /**
     * Sets organisation
     *
     * @param string|null $organisation Organisation (O)
     *
     * @return self
     */
    public function setOrganisation($organisation)
    {
        if (is_null($organisation)) {
            throw new \InvalidArgumentException('non-nullable organisation cannot be null');
        }
        $this->container['organisation'] = $organisation;

        return $this;
    }

    /**
     * Gets pays
     *
     * @return string|null
     */
    public function getPays()
    {
        return $this->container['pays'];
    }

    /**
     * Sets pays
     *
     * @param string|null $pays Code pays ISO 2 lettres (C)
     *
     * @return self
     */
    public function setPays($pays)
    {
        if (is_null($pays)) {
            throw new \InvalidArgumentException('non-nullable pays cannot be null');
        }
        if ((mb_strlen($pays) > 2)) {
            throw new \InvalidArgumentException('invalid length for $pays when calling GenerateCertificateRequest., must be smaller than or equal to 2.');
        }
        if ((mb_strlen($pays) < 2)) {
            throw new \InvalidArgumentException('invalid length for $pays when calling GenerateCertificateRequest., must be bigger than or equal to 2.');
        }

        $this->container['pays'] = $pays;

        return $this;
    }

    /**
     * Gets ville
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->container['ville'];
    }

    /**
     * Sets ville
     *
     * @param string|null $ville Ville (L)
     *
     * @return self
     */
    public function setVille($ville)
    {
        if (is_null($ville)) {
            throw new \InvalidArgumentException('non-nullable ville cannot be null');
        }
        $this->container['ville'] = $ville;

        return $this;
    }

    /**
     * Gets province
     *
     * @return string|null
     */
    public function getProvince()
    {
        return $this->container['province'];
    }

    /**
     * Sets province
     *
     * @param string|null $province Province/État (ST)
     *
     * @return self
     */
    public function setProvince($province)
    {
        if (is_null($province)) {
            throw new \InvalidArgumentException('non-nullable province cannot be null');
        }
        $this->container['province'] = $province;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string|null $email email
     *
     * @return self
     */
    public function setEmail($email)
    {
        if (is_null($email)) {
            array_push($this->openAPINullablesSetToNull, 'email');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('email', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets duree_jours
     *
     * @return int|null
     */
    public function getDureeJours()
    {
        return $this->container['duree_jours'];
    }

    /**
     * Sets duree_jours
     *
     * @param int|null $duree_jours Durée de validité en jours
     *
     * @return self
     */
    public function setDureeJours($duree_jours)
    {
        if (is_null($duree_jours)) {
            throw new \InvalidArgumentException('non-nullable duree_jours cannot be null');
        }

        if (($duree_jours > 3650)) {
            throw new \InvalidArgumentException('invalid value for $duree_jours when calling GenerateCertificateRequest., must be smaller than or equal to 3650.');
        }
        if (($duree_jours < 1)) {
            throw new \InvalidArgumentException('invalid value for $duree_jours when calling GenerateCertificateRequest., must be bigger than or equal to 1.');
        }

        $this->container['duree_jours'] = $duree_jours;

        return $this;
    }

    /**
     * Gets taille_cle
     *
     * @return int|null
     */
    public function getTailleCle()
    {
        return $this->container['taille_cle'];
    }

    /**
     * Sets taille_cle
     *
     * @param int|null $taille_cle Taille de la clé RSA en bits
     *
     * @return self
     */
    public function setTailleCle($taille_cle)
    {
        if (is_null($taille_cle)) {
            throw new \InvalidArgumentException('non-nullable taille_cle cannot be null');
        }
        $this->container['taille_cle'] = $taille_cle;

        return $this;
    }

    /**
     * Gets passphrase_cle
     *
     * @return string|null
     */
    public function getPassphraseCle()
    {
        return $this->container['passphrase_cle'];
    }

    /**
     * Sets passphrase_cle
     *
     * @param string|null $passphrase_cle passphrase_cle
     *
     * @return self
     */
    public function setPassphraseCle($passphrase_cle)
    {
        if (is_null($passphrase_cle)) {
            array_push($this->openAPINullablesSetToNull, 'passphrase_cle');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('passphrase_cle', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['passphrase_cle'] = $passphrase_cle;

        return $this;
    }

    /**
     * Gets generer_p12
     *
     * @return bool|null
     */
    public function getGenererP12()
    {
        return $this->container['generer_p12'];
    }

    /**
     * Sets generer_p12
     *
     * @param bool|null $generer_p12 Générer aussi un fichier PKCS#12 (.p12)
     *
     * @return self
     */
    public function setGenererP12($generer_p12)
    {
        if (is_null($generer_p12)) {
            throw new \InvalidArgumentException('non-nullable generer_p12 cannot be null');
        }
        $this->container['generer_p12'] = $generer_p12;

        return $this;
    }

    /**
     * Gets passphrase_p12
     *
     * @return string|null
     */
    public function getPassphraseP12()
    {
        return $this->container['passphrase_p12'];
    }

    /**
     * Sets passphrase_p12
     *
     * @param string|null $passphrase_p12 Passphrase pour le fichier PKCS#12
     *
     * @return self
     */
    public function setPassphraseP12($passphrase_p12)
    {
        if (is_null($passphrase_p12)) {
            throw new \InvalidArgumentException('non-nullable passphrase_p12 cannot be null');
        }
        $this->container['passphrase_p12'] = $passphrase_p12;

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


