<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\Internaute $internaute */


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
//use yii\helpers\Html;


$this->title = 'Détails du Voyage Réservé';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Détails du Voyage</h2>

    <div class="voyage-detail">
        <h3>Conducteur: <?= Html::encode($conducteur->prenom . ' ' . $conducteur->nom) ?></h3>
        <p><strong>Trajet:</strong> <?= Html::encode($voyage->trajetP->depart . ' - ' . $voyage->trajetP->arrivee) ?></p>
        <p><strong>Heure de départ:</strong> <?= Html::encode($voyage->heuredepart) ?> h</p>
        <p><strong>Nombre de places disponibles:</strong> <?= Html::encode($voyage->nbplacedispo) ?></p>
        <p><strong>Tarif:</strong> <?= Html::encode($voyage->tarif) ?> € par voyageur</p>
        <p><strong>Nombre de bagages autorisés:</strong> <?= Html::encode($voyage->nbbagage) ?></p>
        <p><strong>Contraintes:</strong> <?= Html::encode($voyage->contraintes) ?></p>
    </div>
</div>

<style>
    /* Style global */
    body {
        font-family: 'Arial', sans-serif;
        color: #000; /* Le texte sera en noir */
        background-color: #f9f9f9; /* Arrière-plan gris clair pour un contraste agréable */
    }



    .container {
        background-color: #ffffff; /* Fond blanc pour le conteneur */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre subtile pour le conteneur */
       
    }

    .text-center {
        color: #28a745; /* Vert pour les titres */
        font-size: 2em;
        font-weight: bold;
        margin-top: 100px;
    }

    .voyage-detail {
        background-color: #fafafa; /* Fond gris clair pour la section des détails */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Légère ombre */
        margin-top: 20px;
    }

    .voyage-detail h3 {
        color: #343a40; /* Noir foncé pour le titre des détails */
        font-size: 1.5em;
    }

    .voyage-detail p {
        font-size: 1.2em;
        line-height: 1.6;
        color: #333; /* Le texte des paragraphes est en gris foncé pour une meilleure lisibilité */
        margin-bottom: 15px;
    }

    .voyage-detail strong {
        color: #007bff; /* Utiliser une couleur bleue pour les étiquettes (ex: "Trajet", "Tarif", etc.) */
    }

    /* Ajouter un peu de style pour les marges */
    .voyage-detail p {
        margin-bottom: 15px;
    }
</style>
