<?php


namespace app\models;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

//
/**
* Helloworld is the model behind the Helloworld Form.
*
*/

class Helloworld extends Model
{

  public  $produit= [];
 


public function __construct()
{
    $this->produit = [ 
          '1' => [
                  'id' => '1',
                  'produit' => 'Rose',
                 ],
           '2' => [
                  'id' => '2',
                  'produit' => 'Tulipe',
                 ],
           '3' => [
                  'id' => '3',
                  'produit' => 'Jasmin',
                  ],
           '4' => [
                  'id' => '4',
                  'produit' => 'Laurier Rose',
                  ],
           '5' => [
                  'id' => '5',
                  'produit' => 'Orchidee',
                  ]
                  ];
}

public function getArray()
{
  return $this->produit;
}


}
