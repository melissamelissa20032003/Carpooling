<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Inscription';
$loginUrl = Url::to(['site/login'], true);
$this->registerJs("var loginUrl = '{$loginUrl}';", \yii\web\View::POS_HEAD);
?>

<div class="inscription-container">
    <div class="inscription-form">
        <h1 class="text-center mb-4">Inscription</h1>

        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'action' => Url::to(['site/inscription']),
            'method' => 'post',
        ]); ?>

        <?= $form->field($model, 'pseudo')->textInput(['placeholder' => 'Votre pseudo']) ?>
        <?= $form->field($model, 'pass')->passwordInput(['placeholder' => 'Votre mot de passe']) ?>
        <?= $form->field($model, 'nom')->textInput(['placeholder' => 'Votre nom']) ?>
        <?= $form->field($model, 'prenom')->textInput(['placeholder' => 'Votre prénom']) ?>
        <?= $form->field($model, 'mail')->input('email', ['placeholder' => 'Votre adresse email']) ?>
        <?= $form->field($model, 'permis')->textInput(['placeholder' => 'Numéro de permis de conduire']) ?>
        <?= $form->field($model, 'photo')->textInput(['placeholder' => 'URL de votre photo']) ?>

        <div class="form-group text-center">
            <?= Html::button('S\'inscrire', [
                'class' => 'btn btn-primary btn-lg btn-block',
                'id' => 'ajax-register-btn'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>













































<style>
    /* Ajouter une image de fond à la page */
    body {
        background-image: url('<?= Yii::$app->request->baseUrl ?>/images/immageBackground.png');
        background-size: cover;  /* Couvre toute la zone */
        background-position: center; /* Centre l'image */
        background-attachment: fixed; /* L'image de fond reste fixe lors du défilement */
        background-repeat: no-repeat;
        color: #fff; /* Changez la couleur du texte si nécessaire */
    }

    /* Le conteneur principal de l'inscription */
    .inscription-form {
        background-color: rgba(0, 0, 0, 0.5); /* Arrière-plan semi-transparent pour améliorer la lisibilité */
        color: #fff; /* Texte en blanc pour contraster avec le fond */
        padding: 30px;
        border-radius: 8px;
        max-width: 500px;
        margin: auto;
        margin-top: 100px;
    }

    /* Style pour le titre */
    .inscription-form h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    /* Style pour les champs de formulaire */
    .inscription-form .form-group {
        margin-bottom: 15px;
    }

    /* Style du bouton */
    .inscription-form .btn {
        width: 100%; /* Le bouton prend toute la largeur */
        padding: 12px;
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