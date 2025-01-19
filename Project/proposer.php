<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Proposer un Voyage';


$proposerUrl = Url::to(['/site/proposer'], true);

$this->registerJs("var proposerUrl = '{$proposerUrl}';", \yii\web\View::POS_HEAD);

?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Proposer un Voyage</h2>

    <?php $form = ActiveForm::begin([
        'id' => 'proposer-voyage-form',
        'method' => 'post',
        'options' => ['class' => 'proposer-voyage-form'], // Ajouter une classe CSS spécifique
    ]); ?>
    
    <?= $form->field($model, 'depart')->textInput(['placeholder' => 'Ville de départ', 'class' => 'form-control']) ?>
    <?= $form->field($model, 'arrivee')->textInput(['placeholder' => 'Ville d\'arrivée', 'class' => 'form-control']) ?>

    <!-- Heure de départ, ici c'est un champ numérique entre 0 et 23 -->
    <?= $form->field($model, 'heuredepart')->input('number', [
        'min' => 0,
        'max' => 23,
        'placeholder' => 'Heure de départ (0-23)',
        'class' => 'form-control',
    ]) ?>

    <?= $form->field($model, 'nbplacedispo')->input('number', ['min' => 1, 'placeholder' => 'Nombre de places disponibles', 'class' => 'form-control']) ?>
    <?= $form->field($model, 'tarif')->input('number', ['min' => 0, 'step' => '0.01', 'placeholder' => 'Tarif par voyageur (€)', 'class' => 'form-control']) ?>
    <?= $form->field($model, 'nbbagages')->input('number', ['min' => 0, 'placeholder' => 'Nombre de bagages autorisés', 'class' => 'form-control']) ?>
    <?= $form->field($model, 'contraintes')->textarea(['rows' => 4, 'placeholder' => 'Contraintes particulières (ex : non-fumeur, animaux acceptés, etc.)', 'class' => 'form-control']) ?>

    <!-- Dropdown for typevehicule -->
    <?= $form->field($model, 'typevehicule')->dropDownList(
        [
            'Citadine' => 'Citadine',
            'Berline compacte' => 'Berline compacte',
            'Break' => 'Break',
            'Routière' => 'Routière',
            'Monospace' => 'Monospace',
            'SUV' => 'SUV',
        ],
        ['prompt' => 'Sélectionner le type de véhicule']
    ) ?>

    <!-- Dropdown for marque -->
    <?= $form->field($model, 'marque')->dropDownList(
        [
            'Peugeot' => 'Peugeot',
            'Audi' => 'Audi',
            'Fiat' => 'Fiat',
            'Mercedes' => 'Mercedes',
            'NIO' => 'NIO',
            'Skoda' => 'Skoda',
        ],
        ['prompt' => 'Sélectionner la marque']
    ) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Proposer le Voyage', ['class' => 'btn btn-primary btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>























































































































































































<!-- Notification Bar -->
<div id="notification-bar" style="display:none;"></div>

<!-- Style personnalisé -->
<style>
     /* Ensure the body covers the full height of the screen */
     body {
        background-image: url('<?= Yii::$app->request->baseUrl ?>/images/woman.jpg'); /* Set the background image */
        background-size: cover;  /* Cover the entire area */
        background-position: center; /* Center the image */
        background-attachment: fixed; /* Keep the image fixed while scrolling */
        background-repeat: no-repeat;
        color: #000; /* Set the text color to black */
        font-family: 'Arial', sans-serif; /* Set the font family */
        height: 100vh; /* Make sure the body covers the entire viewport */
        margin: 0; /* Remove any default margin */
    }

    /* Set container styles with a translucent background */
    .container {
        background-color: rgba(255, 255, 255, 0.4); /* Semi-transparent background for better readability */
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        height: auto;
        margin: auto;
    }

    h2 {
        color: #333; /* Make the title text dark */
        font-size: 2em;
        font-weight: bold;
        margin-top: 50px;
    }

    /* Style form fields */
    .form-control {
        background-color: #f9f9f9; /* Light background for input fields */
        border: 1px solid #ccc; /* Border color */
        border-radius: 5px;
        font-size: 16px;
        padding: 10px;
        margin-top: 5px;
    }

    /* Button styling */
    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .form-group {
        margin-bottom: 20px;
    }

    /* Styling for textarea */
    textarea.form-control {
        background-color: #f8f8f8;
        color: #333;
    }

    /* Responsive design for smaller screens */
    @media (max-width: 767px) {
        .container {
            padding: 20px;
        }

        .form-control {
            font-size: 1em;
        }

        .btn-primary {
            padding: 8px 15px;
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


#notification-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    display: none;
}

#notification-bar.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

#notification-bar.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}


</style>


