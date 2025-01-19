

<?php
/** @var yii\web\View $this */
/** @var app\models\Internaute $internaute */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = "Mon Profil";
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Profil de <?= Html::encode($internaute->pseudo) ?></h2>


    <!-- Affichage des messages flash -->
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>






    <!-- Formulaire pour mettre à jour le permis -->
    <?php $form = ActiveForm::begin([
        'id' => 'update-permis-form',
        'method' => 'post',
    ]); ?>

    <div class="profile-info mb-5">
        <h3>Informations personnelles</h3>
        <p><strong>Pseudo:</strong> <?= Html::encode($internaute->pseudo) ?></p>
        <p><strong>Nom:</strong> <?= Html::encode($internaute->nom) ?></p>
        <p><strong>Prénom:</strong> <?= Html::encode($internaute->prenom) ?></p>
        <p><strong>Email:</strong> <?= Html::encode($internaute->mail) ?></p>
        
       <!-- Field to update permis -->
     <?= $form->field($internaute, 'permis')->textInput([
        'value' => $internaute->permis,  // Enlevez Html::encode ici
        'placeholder' => 'Entrez votre numéro de permis',
        'class' => 'form-control permis-field'
    ]) ?>

      <!-- Submit button -->
    <div class="form-group text-center">
    <?= Html::submitButton('Mettre à jour mon permis', ['class' => 'btn btn-primary btn-lg']) ?>
   </div>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- Displaying permis and photo -->
    <div class="profile-info mt-4">
        <p><strong>Numéro de permis:</strong> <?= Html::encode($internaute->permis) ?></p>
        
        <?php if ($internaute->photo): ?>
            <div class="profile-photo">
                <img src="<?= Html::encode($internaute->photo) ?>" alt="Photo" style="max-width: 200px;">
            </div>
        <?php else: ?>
            <p>Pas de photo disponible.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Add some custom CSS to style the fields and text visibility -->
<style>
    .profile-info {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-info p {
        font-size: 1.1em;
        color: #333; /* Ensure text is black */
    }

    .profile-info h3 {
        color: #28a745;
    }

    .permis-field {
        background-color: #ffffff;
        color: #000000;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .profile-photo img {
        border-radius: 50%;
    }

    /* Style for the submit button */
    .form-group .btn {
        background-color: #28a745;
        border-color: #28a745;
    }

    .form-group .btn:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    #update-permis-form{
        color: black;
    }
</style>

   
    <!-- Réservations -->
    <div class="reservations mb-4 p-4 rounded shadow-sm bg-white">
        <h3>Mes réservations</h3>
        <?php if (!empty($reservations)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Voyage</th>
                            <th>Type de véhicule</th>
                            <th>Marque</th>
                            <th>Tarif Total</th>
                            <th>Nombre de places réservées</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $reservation): ?>
                            <tr>
                                <td><?= Html::encode($reservation->voyageR->conducteur) ?></td>
                                <td><?= Html::encode($reservation->voyageR->typevehicule) ?></td>
                                <td><?= Html::encode($reservation->voyageR->marque) ?></td>
                                <td><?= Html::encode($reservation->voyageR->tarif * $reservation->nbplaceresa) ?> €</td>
                                <td><?= Html::encode($reservation->nbplaceresa) ?></td>
                                <td><?= $reservation->voyageR->nbplacedispo < $reservation->nbplaceresa ? 'Réservation complète' : 'Réservation confirmée' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>Aucune réservation trouvée.</p>
        <?php endif; ?>
    </div>


 <!-- Affichage des voyages proposés par l'internaute -->
 <div class="voyages-proposes mb-5">
        <h3>Voyages proposés</h3>
        <?php if (!empty($voyages)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Trajet</th>
                        <th>Heure de départ</th>
                        <th>Places disponibles</th>
                        <th>Tarif par voyageur (€)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($voyages as $voyage): ?>
                        <tr>
                            <td><?= Html::encode($voyage->id) ?></td>
                            <td><?= Html::encode($voyage->trajet) ?></td>
                            <td><?= Html::encode($voyage->heuredepart) ?></td>
                            <td><?= Html::encode($voyage->nbplacedispo) ?></td>
                            <td><?= Html::encode($voyage->tarif) ?> €</td>
                            <td>
                                <!-- Actions: Voir et Supprimer -->
                                <?= Html::a('Voir', ['site/voir-voyage', 'id' => $voyage->id], ['class' => 'btn btn-info']) ?>
                                <?= Html::a('Supprimer', ['site/supprimer-voyage', 'id' => $voyage->id], [
                                    'class' => 'btn btn-danger',
                                    'data-confirm' => 'Êtes-vous sûr de vouloir supprimer ce voyage ?',
                                    'data-method' => 'post',
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun voyage proposé pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

</div>


<style>



/* Style pour le profil de l'internaute */
.internaute-info {
    background-color: #ffffff;
    color : black;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.internaute-info h3 {
    font-size: 1.5em;
    color: #28a745;
}

.reservations {
    margin-top: 30px;
    background-color: #ffffff;
    color : black;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.reservations table {
    width: 100%;
    margin-top: 10px;
    border-collapse: collapse;
}

.reservations table th, .reservations table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

.reservations table th {
    background-color: #28a745;
    color: white;
}

.reservations table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.reservations table tbody tr:hover {
    background-color: #e9e9e9;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

</style>




<!-- Ajouter un peu de style -->
<style>
    .container {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .profile-info h3, .voyages-proposes h3 {
        color: #28a745;
    }

    .profile-info p {
        font-size: 1.1em;
        color: #333;
    }

    .voyages-proposes table {
        width: 100%;
        margin-top: 20px;
    }

    .voyages-proposes table th, .voyages-proposes table td {
        padding: 10px;
        text-align: center;
    }

    .voyages-proposes table th {
        background-color: #28a745;
        color: #fff;
    }

    .voyages-proposes table td {
        background-color: #f9f9f9;
    }

    .btn {
        padding: 8px 16px;
        margin: 5px;
    }

    .btn-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-info:hover, .btn-danger:hover {
        opacity: 0.8;
    }

    .img-fluid {
        max-width: 150px;
        border-radius: 50%;
        border: 2px solid #ddd;
    }


    /* Sur les écrans larges (PC, tablettes) */
@media (min-width: 768px) {
    .header {
        font-size: 24px;
    }
}

/* Sur les petits écrans (smartphones) */
@media (max-width: 767px) {
    .header {
        font-size: 18px;
    }
}


</style>
