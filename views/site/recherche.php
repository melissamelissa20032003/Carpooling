<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

?>

<!-- Section des images des villes -->
<div class="image-container text-center mb-4">
    <div class="row">
        <div class="col-md-6">
            <?= Html::img('@web/images/paris2.png', ['alt' => 'Paris responsive', 'class' => 'img-fluid']) ?>
        </div>
        <div class="col-md-6">
            <?= Html::img('@web/images/bordeaux.jpg', ['alt' => 'Bordeaux responsive', 'class' => 'img-fluid']) ?>
        </div>
    </div>
</div>

<!-- Formulaire de Recherche -->
<div class="search-container">
    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <div class="search-form">
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => Url::to(['site/recherche']),
            'id' => 'search-form',
        ]); ?>

        <div class="form-row">
            <div class="form-group col">
                <?= $form->field($model, 'villeD')->textInput(['placeholder' => 'Ville de départ'])->label(false) ?>
            </div>
            <div class="form-group col">
                <?= $form->field($model, 'villeA')->textInput(['placeholder' => 'Ville d\'arrivée'])->label(false) ?>
            </div>
            <div class="form-group col">
                <?= $form->field($model, 'nombrePersonnes')->input('number', ['min' => 1])->label(false) ?>
            </div>
            <div class="form-group col">
                <?= Html::submitButton('Rechercher', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>



<!-- Section des résultats -->
<div class="results-container" id="results-container">
    <?php if (!empty($voyages)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Conducteur</th>
                    <th>Type de véhicule</th>
                    <th>Marque</th>
                    <th>Tarif Total</th>
                    <th>Places Disponibles</th>
                    <th>Status</th>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <th>Réserver</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($voyages as $voyage): ?>
                    <tr>
                        <td><?= Html::encode($voyage->id) ?></td>
                        <td><?= Html::encode($voyage->conducteur) ?></td>
                        <td><?= Html::encode($voyage->typevehicule) ?></td>
                        <td><?= Html::encode($voyage->marque) ?></td>
                        <td><?= Html::encode($voyage->tarif * $model->nombrePersonnes) ?> €</td>
                        <td><?= Html::encode($voyage->nbplacedispo) ?></td>
                        <td><?= $voyage->nbplacedispo < $model->nombrePersonnes ? 'Complet' : 'Places disponibles' ?></td>
                        <?php if (!Yii::$app->user->isGuest && $voyage->nbplacedispo >= $model->nombrePersonnes): ?>
                            <td>
                                <?= Html::a('Réserver', ['site/reserve', 'voyageId' => $voyage->id, 'nombrePersonnes' => $model->nombrePersonnes], [
                                    'class' => 'btn btn-success btn-sm',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Voulez-vous vraiment réserver ce voyage ?'
                                ]) ?>
                            </td>
                        <?php elseif (!Yii::$app->user->isGuest): ?>
                            <td>
                                <span class="text-danger">Indisponible</span>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
   
    <?php endif; ?>
</div>

<style>
body {
    background-color: #f4f7fa;
    font-family: 'Arial', sans-serif;
    color: #333;
}

/* Formulaire de recherche */
.search-container {
    margin-top: 20px;
    text-align: center;
}

.search-form {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
}

/* Résultats de recherche */
.results-container {
    margin-top: 40px;
}

.results-container table {
    width: 100%;
    border-collapse: collapse;
}

.results-container th {
    background-color: #28a745;
    color: white;
    text-align: center;
}

.results-container th, .results-container td {
    padding: 10px;
    text-align: center;
}

.results-container .btn-success {
    padding: 5px 10px;
    font-size: 0.9em;
    border-radius: 5px;
}

.results-container .text-danger {
    font-weight: bold;
}





</style>
