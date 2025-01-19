<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\Html;
use yii\helpers\Url;

?>

<?php if (!empty($voyages)): ?>
    <div class="table-responsive"> <!-- Rend le tableau responsive -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Conducteur</th>
                    <th>Type de véhicule</th>
                    <th>Marque</th>
                    <th>Tarif Total</th>
                    <th>Places Disponibles</th>
                    <th>Status pppp</th>
                    <th>Réserver</th> <!-- Colonne pour le bouton Réserver -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($voyages as $voyage): ?>
                    <tr>
                        <td><?= Html::encode($voyage->id) ?></td>
                        <td><?= Html::encode($voyage->conducteur) ?></td>
                        <td><?= Html::encode($voyage->typevehicule) ?></td>
                        <td><?= Html::encode($voyage->marque) ?></td>
                        <td><?= Html::encode($voyage->tarif * $nombrePersonnes) ?> €</td>
                        <td><?= Html::encode($voyage->nbplacedispo) ?></td>
                        <td><?= $voyage->nbplacedispo < $nombrePersonnes ? 'Complet' : 'Places disponibles' ?></td>
                        <td class="text-center">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <?= Html::a('Se Connecter', ['site/login'], ['class' => 'btn btn-secondary btn-sm']) ?>
                            <?php else: ?>
                                <?= Html::a('Réserver', ['site/reserve', 'voyageId' => $voyage->id], ['class' => 'btn btn-primary btn-sm']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>
