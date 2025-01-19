<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

namespace app\models;

use yii\db\ActiveRecord;

class Voyage extends ActiveRecord 
{

public static  function tableName()
{

return "fredouil.voyage";
}


public function getConducteurP()
{

return  $this->hasOne(Internaute::class,['id' => 'conducteur']);


}


public static function getVoyageById($voyageId)
{
    return self::findOne($voyageId);  // Equivalent à Voyage::findOne($voyageId)
}



public function getTrajetP()
{

return $this->hasOne(Trajet::class, ['id' => 'trajet']);

}



public  function getReservations()
{

return $this->hasMany(Reservation::class, ['voyage' => 'id']);

}

//interroger la table des réservations pour le voyage ciblé.
public function getPlacesReservees() //la some de toutes les reservation pour un voyage specifique 
{
    return (int) Reservation::find()
        ->where(['voyage' => $this->id])
        ->sum('nbplaceresa') ?: 0; // Retourne 0 si aucune réservation
}


public function getPlacesDisponibles() // la soustraction pour savoir combient de places il rest 
{
    // Nombre de places disponibles = places max - places réservées
    $placesReservees = $this->getPlacesReservees();
    return max($this->nbplacedispo - $placesReservees, 0);
}



//pour enlever la boucle 
// Dans le modèle Voyage
public static function getVoyagesByTrajet($trajetId)
{
    return self::find()->where(['trajet' => $trajetId])->all();  // Retourne tous les voyages associés à un trajet donné
}





// elle retourne un tableau de voyagesssss avec un  s
public static function getVoyagesByTrajets($trajets)
{
    // Récupérer tous les voyages associés aux trajets donnés
    $voyages = [];
    
    // Parcourir tous les trajets pour récupérer leurs voyages
    foreach ($trajets as $trajet) {
        $trajetVoyages = self::find()->where(['trajet' => $trajet->id])->all();
        $voyages = array_merge($voyages, $trajetVoyages);
    }

    return $voyages;
}





}
