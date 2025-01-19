<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

namespace app\models;

use yii\db\ActiveRecord;

class Reservation extends ActiveRecord
{
    public static function tableName()
    {
        return 'fredouil.reservation'; // Nom de la table
    }

    /**
     * Relation : Une réservation appartient à un voyage.
     */
    public function getVoyageR()
    {
        return $this->hasOne(Voyage::class, ['id' => 'voyage']);
    }

    /**
     * Relation : Une réservation est effectuée par un voyageur (internaute).
     */
    public function getInternaute()//methode normal on l'apple avec un
    {
        return $this->hasOne(Internaute::class, ['id' => 'voyageur']);
    }
    //on l'apple avec le nom de la class car elle est static 
    public static function getReservationByVoyage($idVoyage)
   {
    return self::find()->where(['voyage'=>$idVoyage])->all();
   }






}




