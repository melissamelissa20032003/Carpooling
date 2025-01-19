<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Inscription';
$loginUrl = Url::to(['site/login'], true);
$this->registerJs("var loginUrl = '{$loginUrl}';", \yii\web\View::POS_HEAD);
?>

<div class="site-registration">
    <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
    <p class="description">Veuillez remplir les champs ci-dessous pour créer un compte :</p>

    <div id="registration-form-container" class="registration-form-container">
        <?php $form = ActiveForm::begin([
            'id' => 'registration-form',
            'action' => ['site/register'], 
            'method' => 'post',
        ]); ?>
        
        <?= $form->field($model, 'pseudo')->textInput(['placeholder' => 'Pseudo']) ?>
        <?= $form->field($model, 'mail')->input('email', ['placeholder' => 'Adresse email']) ?>
        <?= $form->field($model, 'pass')->passwordInput(['placeholder' => 'Mot de passe']) ?>
        <?= $form->field($model, 'photo')->textInput(['placeholder' => 'Lien vers la photo (URL)']) ?>
        <?= $form->field($model, 'nom')->textInput(['placeholder' => 'Nom']) ?>
        <?= $form->field($model, 'prenom')->textInput(['placeholder' => 'Prénom']) ?>
        <?= $form->field($model, 'permis')->textInput(['placeholder' => 'Permis']) ?>

        <div class="form-group text-center">
            <?= Html::button('S\'inscrire', ['class' => 'btn btn-primary', 'id' => 'ajax-register-btn']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <div id="registration-notification-bar" style="display:none;"></div>
</div>
