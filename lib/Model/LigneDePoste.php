<?php
/**
 * LigneDePoste
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
 * LigneDePoste Class Doc Comment
 *
 * @category Class
 * @description Représente une ligne de détail dans une facture.
 * @package  FactPulse\SDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class LigneDePoste implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'LigneDePoste';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'numero' => 'int',
        'reference' => 'string',
        'denomination' => 'string',
        'quantite' => '\FactPulse\SDK\Model\Quantite',
        'unite' => '\FactPulse\SDK\Model\Unite',
        'montant_unitaire_ht' => '\FactPulse\SDK\Model\MontantUnitaireHt',
        'montant_remise_ht' => '\FactPulse\SDK\Model\LigneDePosteMontantRemiseHt',
        'montant_total_ligne_ht' => '\FactPulse\SDK\Model\MontantTotalLigneHt',
        'taux_tva' => 'string',
        'taux_tva_manuel' => '\FactPulse\SDK\Model\LigneDePosteTauxTvaManuel',
        'categorie_tva' => '\FactPulse\SDK\Model\CategorieTVA',
        'date_debut_periode' => 'string',
        'date_fin_periode' => 'string',
        'code_raison_reduction' => '\FactPulse\SDK\Model\CodeRaisonReduction',
        'raison_reduction' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'numero' => null,
        'reference' => null,
        'denomination' => null,
        'quantite' => null,
        'unite' => null,
        'montant_unitaire_ht' => null,
        'montant_remise_ht' => null,
        'montant_total_ligne_ht' => null,
        'taux_tva' => null,
        'taux_tva_manuel' => null,
        'categorie_tva' => null,
        'date_debut_periode' => null,
        'date_fin_periode' => null,
        'code_raison_reduction' => null,
        'raison_reduction' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'numero' => false,
        'reference' => true,
        'denomination' => false,
        'quantite' => false,
        'unite' => false,
        'montant_unitaire_ht' => false,
        'montant_remise_ht' => true,
        'montant_total_ligne_ht' => false,
        'taux_tva' => true,
        'taux_tva_manuel' => true,
        'categorie_tva' => true,
        'date_debut_periode' => true,
        'date_fin_periode' => true,
        'code_raison_reduction' => true,
        'raison_reduction' => true
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
        'numero' => 'numero',
        'reference' => 'reference',
        'denomination' => 'denomination',
        'quantite' => 'quantite',
        'unite' => 'unite',
        'montant_unitaire_ht' => 'montantUnitaireHt',
        'montant_remise_ht' => 'montantRemiseHt',
        'montant_total_ligne_ht' => 'montantTotalLigneHt',
        'taux_tva' => 'tauxTva',
        'taux_tva_manuel' => 'tauxTvaManuel',
        'categorie_tva' => 'categorieTva',
        'date_debut_periode' => 'dateDebutPeriode',
        'date_fin_periode' => 'dateFinPeriode',
        'code_raison_reduction' => 'codeRaisonReduction',
        'raison_reduction' => 'raisonReduction'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'numero' => 'setNumero',
        'reference' => 'setReference',
        'denomination' => 'setDenomination',
        'quantite' => 'setQuantite',
        'unite' => 'setUnite',
        'montant_unitaire_ht' => 'setMontantUnitaireHt',
        'montant_remise_ht' => 'setMontantRemiseHt',
        'montant_total_ligne_ht' => 'setMontantTotalLigneHt',
        'taux_tva' => 'setTauxTva',
        'taux_tva_manuel' => 'setTauxTvaManuel',
        'categorie_tva' => 'setCategorieTva',
        'date_debut_periode' => 'setDateDebutPeriode',
        'date_fin_periode' => 'setDateFinPeriode',
        'code_raison_reduction' => 'setCodeRaisonReduction',
        'raison_reduction' => 'setRaisonReduction'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'numero' => 'getNumero',
        'reference' => 'getReference',
        'denomination' => 'getDenomination',
        'quantite' => 'getQuantite',
        'unite' => 'getUnite',
        'montant_unitaire_ht' => 'getMontantUnitaireHt',
        'montant_remise_ht' => 'getMontantRemiseHt',
        'montant_total_ligne_ht' => 'getMontantTotalLigneHt',
        'taux_tva' => 'getTauxTva',
        'taux_tva_manuel' => 'getTauxTvaManuel',
        'categorie_tva' => 'getCategorieTva',
        'date_debut_periode' => 'getDateDebutPeriode',
        'date_fin_periode' => 'getDateFinPeriode',
        'code_raison_reduction' => 'getCodeRaisonReduction',
        'raison_reduction' => 'getRaisonReduction'
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
        $this->setIfExists('numero', $data ?? [], null);
        $this->setIfExists('reference', $data ?? [], null);
        $this->setIfExists('denomination', $data ?? [], null);
        $this->setIfExists('quantite', $data ?? [], null);
        $this->setIfExists('unite', $data ?? [], null);
        $this->setIfExists('montant_unitaire_ht', $data ?? [], null);
        $this->setIfExists('montant_remise_ht', $data ?? [], null);
        $this->setIfExists('montant_total_ligne_ht', $data ?? [], null);
        $this->setIfExists('taux_tva', $data ?? [], null);
        $this->setIfExists('taux_tva_manuel', $data ?? [], null);
        $this->setIfExists('categorie_tva', $data ?? [], null);
        $this->setIfExists('date_debut_periode', $data ?? [], null);
        $this->setIfExists('date_fin_periode', $data ?? [], null);
        $this->setIfExists('code_raison_reduction', $data ?? [], null);
        $this->setIfExists('raison_reduction', $data ?? [], null);
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

        if ($this->container['numero'] === null) {
            $invalidProperties[] = "'numero' can't be null";
        }
        if ($this->container['denomination'] === null) {
            $invalidProperties[] = "'denomination' can't be null";
        }
        if ($this->container['quantite'] === null) {
            $invalidProperties[] = "'quantite' can't be null";
        }
        if ($this->container['unite'] === null) {
            $invalidProperties[] = "'unite' can't be null";
        }
        if ($this->container['montant_unitaire_ht'] === null) {
            $invalidProperties[] = "'montant_unitaire_ht' can't be null";
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
     * Gets numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->container['numero'];
    }

    /**
     * Sets numero
     *
     * @param int $numero numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        if (is_null($numero)) {
            throw new \InvalidArgumentException('non-nullable numero cannot be null');
        }
        $this->container['numero'] = $numero;

        return $this;
    }

    /**
     * Gets reference
     *
     * @return string|null
     */
    public function getReference()
    {
        return $this->container['reference'];
    }

    /**
     * Sets reference
     *
     * @param string|null $reference reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        if (is_null($reference)) {
            array_push($this->openAPINullablesSetToNull, 'reference');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('reference', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['reference'] = $reference;

        return $this;
    }

    /**
     * Gets denomination
     *
     * @return string
     */
    public function getDenomination()
    {
        return $this->container['denomination'];
    }

    /**
     * Sets denomination
     *
     * @param string $denomination denomination
     *
     * @return self
     */
    public function setDenomination($denomination)
    {
        if (is_null($denomination)) {
            throw new \InvalidArgumentException('non-nullable denomination cannot be null');
        }
        $this->container['denomination'] = $denomination;

        return $this;
    }

    /**
     * Gets quantite
     *
     * @return \FactPulse\SDK\Model\Quantite
     */
    public function getQuantite()
    {
        return $this->container['quantite'];
    }

    /**
     * Sets quantite
     *
     * @param \FactPulse\SDK\Model\Quantite $quantite quantite
     *
     * @return self
     */
    public function setQuantite($quantite)
    {
        if (is_null($quantite)) {
            throw new \InvalidArgumentException('non-nullable quantite cannot be null');
        }
        $this->container['quantite'] = $quantite;

        return $this;
    }

    /**
     * Gets unite
     *
     * @return \FactPulse\SDK\Model\Unite
     */
    public function getUnite()
    {
        return $this->container['unite'];
    }

    /**
     * Sets unite
     *
     * @param \FactPulse\SDK\Model\Unite $unite unite
     *
     * @return self
     */
    public function setUnite($unite)
    {
        if (is_null($unite)) {
            throw new \InvalidArgumentException('non-nullable unite cannot be null');
        }
        $this->container['unite'] = $unite;

        return $this;
    }

    /**
     * Gets montant_unitaire_ht
     *
     * @return \FactPulse\SDK\Model\MontantUnitaireHt
     */
    public function getMontantUnitaireHt()
    {
        return $this->container['montant_unitaire_ht'];
    }

    /**
     * Sets montant_unitaire_ht
     *
     * @param \FactPulse\SDK\Model\MontantUnitaireHt $montant_unitaire_ht montant_unitaire_ht
     *
     * @return self
     */
    public function setMontantUnitaireHt($montant_unitaire_ht)
    {
        if (is_null($montant_unitaire_ht)) {
            throw new \InvalidArgumentException('non-nullable montant_unitaire_ht cannot be null');
        }
        $this->container['montant_unitaire_ht'] = $montant_unitaire_ht;

        return $this;
    }

    /**
     * Gets montant_remise_ht
     *
     * @return \FactPulse\SDK\Model\LigneDePosteMontantRemiseHt|null
     */
    public function getMontantRemiseHt()
    {
        return $this->container['montant_remise_ht'];
    }

    /**
     * Sets montant_remise_ht
     *
     * @param \FactPulse\SDK\Model\LigneDePosteMontantRemiseHt|null $montant_remise_ht montant_remise_ht
     *
     * @return self
     */
    public function setMontantRemiseHt($montant_remise_ht)
    {
        if (is_null($montant_remise_ht)) {
            array_push($this->openAPINullablesSetToNull, 'montant_remise_ht');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('montant_remise_ht', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['montant_remise_ht'] = $montant_remise_ht;

        return $this;
    }

    /**
     * Gets montant_total_ligne_ht
     *
     * @return \FactPulse\SDK\Model\MontantTotalLigneHt|null
     */
    public function getMontantTotalLigneHt()
    {
        return $this->container['montant_total_ligne_ht'];
    }

    /**
     * Sets montant_total_ligne_ht
     *
     * @param \FactPulse\SDK\Model\MontantTotalLigneHt|null $montant_total_ligne_ht montant_total_ligne_ht
     *
     * @return self
     */
    public function setMontantTotalLigneHt($montant_total_ligne_ht)
    {
        if (is_null($montant_total_ligne_ht)) {
            throw new \InvalidArgumentException('non-nullable montant_total_ligne_ht cannot be null');
        }
        $this->container['montant_total_ligne_ht'] = $montant_total_ligne_ht;

        return $this;
    }

    /**
     * Gets taux_tva
     *
     * @return string|null
     */
    public function getTauxTva()
    {
        return $this->container['taux_tva'];
    }

    /**
     * Sets taux_tva
     *
     * @param string|null $taux_tva taux_tva
     *
     * @return self
     */
    public function setTauxTva($taux_tva)
    {
        if (is_null($taux_tva)) {
            array_push($this->openAPINullablesSetToNull, 'taux_tva');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('taux_tva', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['taux_tva'] = $taux_tva;

        return $this;
    }

    /**
     * Gets taux_tva_manuel
     *
     * @return \FactPulse\SDK\Model\LigneDePosteTauxTvaManuel|null
     */
    public function getTauxTvaManuel()
    {
        return $this->container['taux_tva_manuel'];
    }

    /**
     * Sets taux_tva_manuel
     *
     * @param \FactPulse\SDK\Model\LigneDePosteTauxTvaManuel|null $taux_tva_manuel taux_tva_manuel
     *
     * @return self
     */
    public function setTauxTvaManuel($taux_tva_manuel)
    {
        if (is_null($taux_tva_manuel)) {
            array_push($this->openAPINullablesSetToNull, 'taux_tva_manuel');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('taux_tva_manuel', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['taux_tva_manuel'] = $taux_tva_manuel;

        return $this;
    }

    /**
     * Gets categorie_tva
     *
     * @return \FactPulse\SDK\Model\CategorieTVA|null
     */
    public function getCategorieTva()
    {
        return $this->container['categorie_tva'];
    }

    /**
     * Sets categorie_tva
     *
     * @param \FactPulse\SDK\Model\CategorieTVA|null $categorie_tva categorie_tva
     *
     * @return self
     */
    public function setCategorieTva($categorie_tva)
    {
        if (is_null($categorie_tva)) {
            array_push($this->openAPINullablesSetToNull, 'categorie_tva');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('categorie_tva', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['categorie_tva'] = $categorie_tva;

        return $this;
    }

    /**
     * Gets date_debut_periode
     *
     * @return string|null
     */
    public function getDateDebutPeriode()
    {
        return $this->container['date_debut_periode'];
    }

    /**
     * Sets date_debut_periode
     *
     * @param string|null $date_debut_periode date_debut_periode
     *
     * @return self
     */
    public function setDateDebutPeriode($date_debut_periode)
    {
        if (is_null($date_debut_periode)) {
            array_push($this->openAPINullablesSetToNull, 'date_debut_periode');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_debut_periode', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_debut_periode'] = $date_debut_periode;

        return $this;
    }

    /**
     * Gets date_fin_periode
     *
     * @return string|null
     */
    public function getDateFinPeriode()
    {
        return $this->container['date_fin_periode'];
    }

    /**
     * Sets date_fin_periode
     *
     * @param string|null $date_fin_periode date_fin_periode
     *
     * @return self
     */
    public function setDateFinPeriode($date_fin_periode)
    {
        if (is_null($date_fin_periode)) {
            array_push($this->openAPINullablesSetToNull, 'date_fin_periode');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('date_fin_periode', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['date_fin_periode'] = $date_fin_periode;

        return $this;
    }

    /**
     * Gets code_raison_reduction
     *
     * @return \FactPulse\SDK\Model\CodeRaisonReduction|null
     */
    public function getCodeRaisonReduction()
    {
        return $this->container['code_raison_reduction'];
    }

    /**
     * Sets code_raison_reduction
     *
     * @param \FactPulse\SDK\Model\CodeRaisonReduction|null $code_raison_reduction code_raison_reduction
     *
     * @return self
     */
    public function setCodeRaisonReduction($code_raison_reduction)
    {
        if (is_null($code_raison_reduction)) {
            array_push($this->openAPINullablesSetToNull, 'code_raison_reduction');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('code_raison_reduction', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['code_raison_reduction'] = $code_raison_reduction;

        return $this;
    }

    /**
     * Gets raison_reduction
     *
     * @return string|null
     */
    public function getRaisonReduction()
    {
        return $this->container['raison_reduction'];
    }

    /**
     * Sets raison_reduction
     *
     * @param string|null $raison_reduction raison_reduction
     *
     * @return self
     */
    public function setRaisonReduction($raison_reduction)
    {
        if (is_null($raison_reduction)) {
            array_push($this->openAPINullablesSetToNull, 'raison_reduction');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('raison_reduction', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['raison_reduction'] = $raison_reduction;

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


