<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\Internaute $internaute */

use app\models\Reservation;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
//use yii\helpers\Html;

$this->title = 'Détails de l\'Internaute';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="internaute-details">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?= Html::encode($internaute->id) ?></td>
        </tr>
        <tr>
            <th>Nom</th>
            <td><?= Html::encode($internaute->nom) ?></td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td><?= Html::encode($internaute->prenom) ?></td>
        </tr>
        
        <tr>
            <th>Email</th>
            <td><?= Html::encode($internaute->mail) ?></td>
        </tr>
        <tr>
            <th>Mot de Passe</th>
            <td><?= Html::encode($internaute->pass) ?></td>
        </tr>
        <tr>
            <th>Permis</th>
            <td><?= Html::encode($internaute->permis) ?></td>
        </tr>
        <tr>
            <th>Pseudo</th>
            <td><?= Html::encode($internaute->pseudo) ?></td>
        </tr>
        <tr>
            <th>Photo</th>
            <td>
                <?php if ($internaute->photo): ?>
                    <img src="<?= Html::encode($internaute->photo) ?>" alt="Photo" style="max-width: 200px;">
                <?php else: ?>
                    Pas de photo disponible.
                <?php endif; ?>
            </td>
        </tr>

    </table>


<!-- Affichage des voyages proposés -->
<h2>Voyages proposés :</h2>
<?php if (!empty($voyages)): ?>
    <ul>
        <?php foreach ($voyages as $voyage): ?>
            <li>
                <?php if ($voyage->trajetP): ?>
            <strong>Trajet :</strong>
            <?= Html::encode($voyage->trajetP->depart) ?> -> 
            <?= Html::encode($voyage->trajetP->arrivee) ?><br>
            <?= Html::encode($voyage->trajetP->distance) ?><br>    
            <strong>Conducteur :</strong>
            <?= Html::encode($voyage->conducteurP->pseudo) ?><br>   
            <strong>Nom :</strong> 
            <?= Html::encode($voyage->conducteurP->nom) ?><br>    
            <strong>Type vehicule :</strong>
            <?= Html::encode($voyage->typevehicule) ?><br>    
            <strong>Tarif:</strong>
            <?= Html::encode($voyage->tarif) ?><br>   
            <strong>Nombre de palce dispo  :</strong>
            <?= Html::encode($voyage->nbplacedispo) ?><br>   

        <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun voyage proposé par cet internaute.</p>
<?php endif; ?>

<h2>Reservations effectueés : </h2>
<?php if(!empty($reservations)): ?>
    <ul>
        <?php foreach ($reservations as $reservation): ?>
            <li>
                <?php if($reservation->voyageR): ?>
                    <strong>Reservation de ce voyage </strong>
                    <?= Html::encode($reservation->voyageR->trajetP->depart) ?>->
                    <?= Html::encode($reservation->voyageR->trajetP->arrivee) ?>-><br>

                    <strong>Distance  </strong>
                    <?= Html::encode($reservation->voyageR->trajetP->distance) ?><br>

                    <strong>Conducteur  </strong>
                    <?= Html::encode($reservation->voyageR->conducteurP->pseudo) ?><br>
                    
                    <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
<?php else: ?>
    <p>Aucune reservation par cet internaute.</p>
<?php endif; ?>



</div>



