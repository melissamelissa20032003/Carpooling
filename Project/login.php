<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Page de Connexion:</p>

    <div class="row justify-content-center">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-12 col-form-label'],
                    'inputOptions' => ['class' => 'form-control'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'pseudo')->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

            <?= $form->field($model, 'pass')->passwordInput(['class' => 'form-control']) ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>


        </div>
    </div>
</div>
































<!-- CSS pour la page -->
<style>
    /* Ajouter une image de fond à la page */
    body {
        background-image: url('<?= Yii::$app->request->baseUrl ?>/images/car.jpg');
        background-size: cover;  /* Couvre toute la zone */
        background-position: center; /* Centre l'image */
        background-attachment: fixed; /* L'image de fond reste fixe lors du défilement */
        background-repeat: no-repeat;
        color: #333; /* Changez la couleur du texte si nécessaire */
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fa; /* Fond clair */
        margin: 0;
        height: 100vh;
    }

    .site-login {
        margin-top: 150px;
        background-color: rgba(255, 255, 255, 0.8); /* Form background with transparency */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .site-login h1 {
        color: #333;
        font-size: 2em;
        font-weight: bold;
    }

    .text-center {
        color: #007bff;
    }

    .form-control {
        border-radius: 5px;
        font-size: 1.1em;
        padding: 10px;
        margin-top: 5px;
    }

    .btn {
        padding: 12px 30px;
        font-size: 1.1em;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .custom-control-label {
        font-size: 1.1em;
        color: #555;
    }

    .invalid-feedback {
        font-size: 0.9em;
        color: #e74a3b;
    }

    /* Responsive adjustments */
    @media (max-width: 767px) {
        .site-login {
            padding: 20px;
        }

        .form-control {
            font-size: 1em;
        }
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
