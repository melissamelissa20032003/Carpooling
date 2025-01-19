<?php



namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Internaute extends ActiveRecord implements IdentityInterface
{
    private $_authKey;


    /**
     * Déclare la table associée à ce modèle.
     */
    public static function tableName()
    {
        return 'fredouil.internaute'; // Replace 'fredouil' with the correct schema if necessary
    }

    // Other relations...
    public function getVoyages()
    {
        return $this->hasMany(Voyage::class, ['conducteur' => 'id'])->all();
    }

    public function getReservations()
    {
        return $this->hasMany(Reservation::class, ['voyageur' => 'id'])->all();
    }

    public static function getUserByIdentifiant($pseudo)
    {
        return self::find()->where(['pseudo' => $pseudo])->one();
    }

    public static function getUserById($userId)
{
    // Vérifier si l'ID est valide et retourner l'utilisateur, sinon null
    return self::findOne(['id' => $userId]);
}

    // Validation rules
    public function rules()
    {
        return [
            [['pseudo', 'pass', 'nom', 'prenom', 'mail'], 'required'],
            [['pseudo'], 'string', 'max' => 255],
            [['pass'], 'string', 'max' => 255],
            [['nom', 'prenom'], 'string', 'max' => 255],
            [['mail'], 'email'],
            [['permis'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    // Attributes labels
    public function attributeLabels()
    {
        return [
            'pseudo' => 'Pseudo',
            'pass' => 'Mot de passe',
            'nom' => 'Nom',
            'prenom' => 'Prénom',
            'mail' => 'Email',
            'photo' => 'Photo',
            'permis' => 'Numéro de permis',
        ];
    }

    /**
     * Hash password using SHA-1.
     */
    public function hashPassword($password)
    {
        return sha1($password); 
        
    }

    /**
     * Save user after hashing the password.
     */
    public function saveUser()
    {
        // Hash the password before saving
        $this->pass = $this->hashPassword($this->pass);

        return $this->save(); // Insert the user into the database
    }

    /**
     * Validate the password using SHA-1.
     */
    public function validatePassword($password)
    {
        // Compare the SHA-1 hashed password
        return sha1($password) === $this->pass;
    }

   

    public function getId()
    {
        return $this->id; // Return the unique identifier of the user (e.g., the 'id' column)
    }

    /**
     * Implémente l'interface IdentityInterface
     * Retourne l'authKey
     */
    public function getAuthKey()
    {
        return $this->_authKey;
    }

    /**
     * Implémente l'interface IdentityInterface
     * Valider l'authKey
     */
    public function validateAuthKey($authKey)
    {
        return $this->_authKey === $authKey;
    }



    /**
     * Implements IdentityInterface
     * Find the user by ID
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * Implements IdentityInterface
     * Find the user by access token (OAuth or API token)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken' => $token]);
    }

    /**
     * Get user by pseudo
     */
   // Exemple de getter pour pseudo
public function getUsername()
{
    return $this->pseudo;
}


    public function getUser()
{
    return Internaute::findOne(['pseudo' => $this->pseudo]);
}

}
