<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

namespace app\models;


use Yii;
use yii\base\Model;

class VoyageForm extends \yii\base\Model
{
    public $depart;
    public $arrivee;
    public $heuredepart;
    public $nbplacedispo;
    public $tarif;
    public $nbbagages;
    public $contraintes;
    public $typevehicule;
    public $marque;

    public function rules()
    {
        return [
            [['depart', 'arrivee', 'heuredepart', 'nbplacedispo', 'tarif', 'typevehicule', 'marque'], 'required'],
            [['depart', 'arrivee', 'typevehicule', 'marque'], 'string', 'max' => 255],
            [['heuredepart'], 'integer', 'min' => 0, 'max' => 23],
            [['nbplacedispo', 'tarif', 'nbbagages'], 'integer'],
            [['contraintes'], 'string', 'max' => 500],
        ];
    }

        /**
         * Retourne les étiquettes des attributs.
         */
        public function attributeLabels()
        {
            return [
                'depart' => 'Ville de départ',
                'arrivee' => 'Ville d\'arrivée',
                'heuredepart' => 'Heure de départ',
                'nbplacedispo' => 'Nombre de places maximum',
                'tarif' => 'Tarif par voyageur (€)',
                'nbbagages' => 'Nombre de bagages autorisés',
                'contraintes' => 'Contraintes particulières',
            ];
        }
    }
