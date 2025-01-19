<?php

namespace app\models;

use yii\db\ActiveRecord;

class Trajet extends ActiveRecord
{
    public static function tableName()
    {
        return 'fredouil.trajet';
    }

 



    public function getVoyages()
    {
        return $this->hasMany(Voyage::class, ['trajet' => 'id']);
    }






   public static function getTrajetv($villeD,$villeA){
     return self::find()
            ->where(['depart' => $villeD, 'arrivee' => $villeA])
            ->all();
  }

 // toute la logique et l'intelligence du projet se trouve dans le controlleur 
}
//// Récupérer tous les voyages pour un trajet donné
//$trajet = Trajet::findOne(['villeD' => 'Toulouse', 'villeA' => 'Marseille']);
//if ($trajet) {
  //  $voyages = $trajet->voyages;


