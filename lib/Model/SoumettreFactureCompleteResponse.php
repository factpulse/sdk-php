<?php
/**
 * SoumettreFactureCompleteResponse
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
 * SoumettreFactureCompleteResponse Class Doc Comment
 *
 * @category Class
 * @description Réponse complète après soumission automatisée.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SoumettreFactureCompleteResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'SoumettreFactureCompleteResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'succes' => 'bool',
        'destination_type' => 'string',
        'resultat_chorus' => '\FactPulse\SDK\Model\ResultatChorusPro',
        'resultat_afnor' => '\FactPulse\SDK\Model\ResultatAFNOR',
        'facture_enrichie' => '\FactPulse\SDK\Model\FactureEnrichieInfo',
        'pdf_facturx' => '\FactPulse\SDK\Model\PDFFacturXInfo',
        'signature' => '\FactPulse\SDK\Model\SignatureInfo',
        'pdf_base64' => 'string',
        'message' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'succes' => null,
        'destination_type' => null,
        'resultat_chorus' => null,
        'resultat_afnor' => null,
        'facture_enrichie' => null,
        'pdf_facturx' => null,
        'signature' => null,
        'pdf_base64' => null,
        'message' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'succes' => false,
        'destination_type' => false,
        'resultat_chorus' => true,
        'resultat_afnor' => true,
        'facture_enrichie' => false,
        'pdf_facturx' => false,
        'signature' => true,
        'pdf_base64' => false,
        'message' => false
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
        'succes' => 'succes',
        'destination_type' => 'destination_type',
        'resultat_chorus' => 'resultat_chorus',
        'resultat_afnor' => 'resultat_afnor',
        'facture_enrichie' => 'facture_enrichie',
        'pdf_facturx' => 'pdf_facturx',
        'signature' => 'signature',
        'pdf_base64' => 'pdf_base64',
        'message' => 'message'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'succes' => 'setSucces',
        'destination_type' => 'setDestinationType',
        'resultat_chorus' => 'setResultatChorus',
        'resultat_afnor' => 'setResultatAfnor',
        'facture_enrichie' => 'setFactureEnrichie',
        'pdf_facturx' => 'setPdfFacturx',
        'signature' => 'setSignature',
        'pdf_base64' => 'setPdfBase64',
        'message' => 'setMessage'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'succes' => 'getSucces',
        'destination_type' => 'getDestinationType',
        'resultat_chorus' => 'getResultatChorus',
        'resultat_afnor' => 'getResultatAfnor',
        'facture_enrichie' => 'getFactureEnrichie',
        'pdf_facturx' => 'getPdfFacturx',
        'signature' => 'getSignature',
        'pdf_base64' => 'getPdfBase64',
        'message' => 'getMessage'
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

    public const DESTINATION_TYPE_CHORUS_PRO = 'chorus_pro';
    public const DESTINATION_TYPE_AFNOR = 'afnor';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getDestinationTypeAllowableValues()
    {
        return [
            self::DESTINATION_TYPE_CHORUS_PRO,
            self::DESTINATION_TYPE_AFNOR,
        ];
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
        $this->setIfExists('succes', $data ?? [], null);
        $this->setIfExists('destination_type', $data ?? [], null);
        $this->setIfExists('resultat_chorus', $data ?? [], null);
        $this->setIfExists('resultat_afnor', $data ?? [], null);
        $this->setIfExists('facture_enrichie', $data ?? [], null);
        $this->setIfExists('pdf_facturx', $data ?? [], null);
        $this->setIfExists('signature', $data ?? [], null);
        $this->setIfExists('pdf_base64', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
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

        if ($this->container['succes'] === null) {
            $invalidProperties[] = "'succes' can't be null";
        }
        if ($this->container['destination_type'] === null) {
            $invalidProperties[] = "'destination_type' can't be null";
        }
        $allowedValues = $this->getDestinationTypeAllowableValues();
        if (!is_null($this->container['destination_type']) && !in_array($this->container['destination_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'destination_type', must be one of '%s'",
                $this->container['destination_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['facture_enrichie'] === null) {
            $invalidProperties[] = "'facture_enrichie' can't be null";
        }
        if ($this->container['pdf_facturx'] === null) {
            $invalidProperties[] = "'pdf_facturx' can't be null";
        }
        if ($this->container['pdf_base64'] === null) {
            $invalidProperties[] = "'pdf_base64' can't be null";
        }
        if ($this->container['message'] === null) {
            $invalidProperties[] = "'message' can't be null";
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
     * Gets succes
     *
     * @return bool
     */
    public function getSucces()
    {
        return $this->container['succes'];
    }

    /**
     * Sets succes
     *
     * @param bool $succes La facture a été soumise avec succès
     *
     * @return self
     */
    public function setSucces($succes)
    {
        if (is_null($succes)) {
            throw new \InvalidArgumentException('non-nullable succes cannot be null');
        }
        $this->container['succes'] = $succes;

        return $this;
    }

    /**
     * Gets destination_type
     *
     * @return string
     */
    public function getDestinationType()
    {
        return $this->container['destination_type'];
    }

    /**
     * Sets destination_type
     *
     * @param string $destination_type Type de destination
     *
     * @return self
     */
    public function setDestinationType($destination_type)
    {
        if (is_null($destination_type)) {
            throw new \InvalidArgumentException('non-nullable destination_type cannot be null');
        }
        $allowedValues = $this->getDestinationTypeAllowableValues();
        if (!in_array($destination_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'destination_type', must be one of '%s'",
                    $destination_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['destination_type'] = $destination_type;

        return $this;
    }

    /**
     * Gets resultat_chorus
     *
     * @return \FactPulse\SDK\Model\ResultatChorusPro|null
     */
    public function getResultatChorus()
    {
        return $this->container['resultat_chorus'];
    }

    /**
     * Sets resultat_chorus
     *
     * @param \FactPulse\SDK\Model\ResultatChorusPro|null $resultat_chorus resultat_chorus
     *
     * @return self
     */
    public function setResultatChorus($resultat_chorus)
    {
        if (is_null($resultat_chorus)) {
            array_push($this->openAPINullablesSetToNull, 'resultat_chorus');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('resultat_chorus', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['resultat_chorus'] = $resultat_chorus;

        return $this;
    }

    /**
     * Gets resultat_afnor
     *
     * @return \FactPulse\SDK\Model\ResultatAFNOR|null
     */
    public function getResultatAfnor()
    {
        return $this->container['resultat_afnor'];
    }

    /**
     * Sets resultat_afnor
     *
     * @param \FactPulse\SDK\Model\ResultatAFNOR|null $resultat_afnor resultat_afnor
     *
     * @return self
     */
    public function setResultatAfnor($resultat_afnor)
    {
        if (is_null($resultat_afnor)) {
            array_push($this->openAPINullablesSetToNull, 'resultat_afnor');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('resultat_afnor', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['resultat_afnor'] = $resultat_afnor;

        return $this;
    }

    /**
     * Gets facture_enrichie
     *
     * @return \FactPulse\SDK\Model\FactureEnrichieInfo
     */
    public function getFactureEnrichie()
    {
        return $this->container['facture_enrichie'];
    }

    /**
     * Sets facture_enrichie
     *
     * @param \FactPulse\SDK\Model\FactureEnrichieInfo $facture_enrichie Données de la facture enrichie
     *
     * @return self
     */
    public function setFactureEnrichie($facture_enrichie)
    {
        if (is_null($facture_enrichie)) {
            throw new \InvalidArgumentException('non-nullable facture_enrichie cannot be null');
        }
        $this->container['facture_enrichie'] = $facture_enrichie;

        return $this;
    }

    /**
     * Gets pdf_facturx
     *
     * @return \FactPulse\SDK\Model\PDFFacturXInfo
     */
    public function getPdfFacturx()
    {
        return $this->container['pdf_facturx'];
    }

    /**
     * Sets pdf_facturx
     *
     * @param \FactPulse\SDK\Model\PDFFacturXInfo $pdf_facturx Informations sur le PDF généré
     *
     * @return self
     */
    public function setPdfFacturx($pdf_facturx)
    {
        if (is_null($pdf_facturx)) {
            throw new \InvalidArgumentException('non-nullable pdf_facturx cannot be null');
        }
        $this->container['pdf_facturx'] = $pdf_facturx;

        return $this;
    }

    /**
     * Gets signature
     *
     * @return \FactPulse\SDK\Model\SignatureInfo|null
     */
    public function getSignature()
    {
        return $this->container['signature'];
    }

    /**
     * Sets signature
     *
     * @param \FactPulse\SDK\Model\SignatureInfo|null $signature signature
     *
     * @return self
     */
    public function setSignature($signature)
    {
        if (is_null($signature)) {
            array_push($this->openAPINullablesSetToNull, 'signature');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('signature', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['signature'] = $signature;

        return $this;
    }

    /**
     * Gets pdf_base64
     *
     * @return string
     */
    public function getPdfBase64()
    {
        return $this->container['pdf_base64'];
    }

    /**
     * Sets pdf_base64
     *
     * @param string $pdf_base64 PDF Factur-X généré (et signé si demandé) encodé en base64
     *
     * @return self
     */
    public function setPdfBase64($pdf_base64)
    {
        if (is_null($pdf_base64)) {
            throw new \InvalidArgumentException('non-nullable pdf_base64 cannot be null');
        }
        $this->container['pdf_base64'] = $pdf_base64;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string $message Message de retour
     *
     * @return self
     */
    public function setMessage($message)
    {
        if (is_null($message)) {
            throw new \InvalidArgumentException('non-nullable message cannot be null');
        }
        $this->container['message'] = $message;

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


