<?php

namespace app\models;

use Yii;
use yii\base\Model;



class ReservationForm extends Model
{
    public $nbplaces;

    public function rules()
    {
        return [
            [['nbplaces'], 'required'],
            [['nbplaces'], 'integer', 'min' => 1, 'max' => 10], // Assurez-vous que le nombre de places est raisonnable
        ];
    }

    public function attributeLabels()
    {
        return [
            'nbplaces' => 'Nombre de places à réserver',
        ];
    }
}
