<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

namespace app\models;
use yii\db\ActiveRecord;

class MyUsers extends ActiveRecord {
  

   // fonction pour etablire la connection entre la class MyUsers et la tabe fredouil.my_users
   public static function tableName()
   {
    return 'fredouil.my_users';
   }

}

