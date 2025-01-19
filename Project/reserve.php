<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ReservationForm $model */
/** @var app\models\Voyage $voyage */
/** @var int $placesDisponibles */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Réservation de Voyage';
$reservationUrl = Url::to(['site/reserve', 'voyageId' => $voyage->id]);
$this->registerJs("var reservationUrl = '{$reservationUrl}';", \yii\web\View::POS_HEAD);


?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Réservation pour le voyage</h2>

    <!-- Détails du voyage -->
    <div class="voyage-detail mb-4">
        <h3>Voyage avec le conducteur <?= Html::encode($voyage->conducteur) ?> à <?= Html::encode($voyage->typevehicule) ?></h3>
        <p><strong>Marque:</strong> <?= Html::encode($voyage->marque) ?></p>
        <p><strong>Tarif:</strong> <?= Html::encode($voyage->tarif) ?> €</p>
        <p><strong>Nombre de places disponibles:</strong> <?= Html::encode($placesDisponibles) ?></p>
    </div>

    <!-- Formulaire de réservation -->
    <?php $form = ActiveForm::begin([
        'id' => 'reservation-form',
        'method' => 'post',
        'options' => ['class' => 'reservation-form'],
    ]); ?>

    <div class="form-group">
        <label for="reservationform-nbplaces">Nombre de places à réserver</label>
        <?= $form->field($model, 'nbplaces')->input('number', [
            'min' => 1,
            'max' => $placesDisponibles,
            'class' => 'form-control',
            'placeholder' => 'Entrez le nombre de places à réserver',
        ])->label(false) ?>
    </div>

    <div class="form-group text-center">
        <?= Html::button('Réserver', ['class' => 'btn btn-success btn-lg', 'id' => 'ajax-reserve-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Bandeau de notification (déjà dans le layout) -->
<div id="notification-bar" style="display:none;"></div>

<!-- Style personnalisé -->
<style>
    .voyage-detail {
        margin-top: 80px;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .voyage-detail h3 {
        font-size: 1.8em;
        color: #28a745;
    }

    .reservation-form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .reservation-form label {
        font-size: 1.2em;
    }

    .reservation-form .btn {
        font-size: 1.2em;
        padding: 10px 20px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .form-group {
        margin-bottom: 20px;
    }
</style>
