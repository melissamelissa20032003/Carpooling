<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

namespace app\models;


use yii\base\Model;

class RechercheForm extends Model{

    public $villeD;
    public $villeA;
    public $nombrePersonnes;


  // à supprimé
  public function rules()
  {
      return [
          [['villeD', 'villeA'], 'string', 'max' => 255],
          ['nombrePersonnes', 'integer'],
          ['nombrePersonnes', 'compare', 'compareValue' => 0, 'operator' => '>', 'message' => 'Le nombre de personnes doit être supérieur à zéro.'],
          ['villeD', 'validateVilleExists'],
          ['villeA', 'validateVilleExists'],
      ];
  }
  
  public function validateVilleExists($attribute, $params)
  {
      // Convertir en minuscule pour éviter les problèmes de casse
      $ville = ucfirst(strtolower($this->$attribute));  // Première lettre en majuscule
      // Vérifier si la ville existe dans la base de données
      $existingVille = Trajet::find()->where(['depart' => $ville])->orWhere(['arrivee' => $ville])->one();
      
      if (!$existingVille) {
          $this->addError($attribute, 'La ville "'.$this->$attribute.'" n\'existe pas dans notre base de données.');
      }
  }
  




}