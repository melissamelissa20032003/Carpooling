<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class User extends \yii\base\BaseObject implements IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $motpasse;
    public $nom;
    public $prenom;
    public $avatar;
    public $statut_connexion;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
       
        $user = Internaute::findOne(['id' => $id]);
        return $user ? new static($user->attributes) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // You can add custom logic to find the user by access token
        return null;
    }

    /**
     * Finds user by username (pseudo)
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        // Replacing 'MyUsers' with the 'Internaute' model for database query
        $user = Internaute::findOne(['pseudo' => $username]);
        return $user ? new static($user->attributes) : null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password using the password hash.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // Use Yii's built-in validatePassword method to compare the password securely
        return Yii::$app->security->validatePassword($password, $this->motpasse);
    }
}
