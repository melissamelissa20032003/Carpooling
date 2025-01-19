<?php
namespace app\models;

use yii\base\Model;
use app\models\Internaute;

class RegistrationForm extends Model
{
    public $pseudo;
    public $mail;
    public $pass;
    public $photo;
    public $nom;
    public $prenom;
    public $permis;

    public function rules()
    {
        return [
            [['pseudo', 'mail', 'pass', 'nom', 'prenom'], 'required'],
            ['mail', 'email'],
            [['pass'], 'string', 'min' => 6],
            ['photo', 'url', 'message' => 'Lien vers une photo valide.'],
            [['pseudo', 'nom', 'prenom'], 'string', 'max' => 45],
            ['permis', 'string', 'max' => 12],
        ];
    }

    /**
     * Sauvegarde les données dans la table internaute.
     * @return bool Si l'enregistrement a réussi ou non
     */
    public function saveInternaute()
    {
        $internaute = new Internaute();
        $internaute->pseudo = $this->pseudo;
        $internaute->mail = $this->mail;
        $internaute->pass = sha1($this->pass); 
        $internaute->nom = $this->nom;
        $internaute->prenom = $this->prenom;
        $internaute->photo = $this->photo;
        $internaute->permis = $this->permis;

        return $internaute->save();
    }

    /**
     * Retourne les erreurs d'enregistrement.
     * @return array Les erreurs du modèle Internaute
     */
    public function getErrorsFromInternaute()
    {
        $internaute = new Internaute();
        $internaute->pseudo = $this->pseudo;
        $internaute->mail = $this->mail;
        $internaute->pass = sha1($this->pass);
        $internaute->nom = $this->nom;
        $internaute->prenom = $this->prenom;
        $internaute->photo = $this->photo;
        $internaute->permis = $this->permis;

        $internaute->validate(); // Remplit les erreurs sans les sauvegarder
        return $internaute->errors;
    }
}