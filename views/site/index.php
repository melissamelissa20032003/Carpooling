<?php

/** @var yii\web\View $this */


?>
<?php

/** @var yii\web\View $this */

$this->title = 'Réservation de voyage - Réservez maintenant!';
?>

<div class="site-index">

    <!-- Section Jumbotron avec image de fond -->
    <div class="jumbotron text-center mt-5 mb-5" style="background-image: url('<?= Yii::$app->request->baseUrl ?>/images/blablaCar2.jpg'); background-size: cover; background-position: center; color: white; padding: 200px 0; margin-top: 100px;">
        <h1 class="display-4">Réservez votre voyage maintenant !</h1>

        <p class="lead">Vous avez des projets ? Nous avons votre voyage !</p>

        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['site/recherche']) ?>">Commencez votre voyage</a></p>

    </div>



    <div class="body-content">
    <div class="row text-center">
        <div class="col-lg-4 col-md-6">
            <h2>Trouvez un voyage</h2>
            <p>Recherchez des trajets disponibles en fonction de vos villes de départ et d'arrivée.</p>
            <p><a class="btn btn-outline-success" href="<?= \yii\helpers\Url::to(['site/recherche']) ?>">Trouvez des voyages &raquo;</a></p>
        </div>
        <div class="col-lg-4 col-md-6">
            <h2>Devenez conducteur</h2>
            <p>Proposez votre trajet et aidez les autres à arriver à destination !</p>
            <p><a class="btn btn-outline-success" href="<?= \yii\helpers\Url::to(['site/proposer']) ?>">Devenez conducteur &raquo;</a></p>
        </div>
        <div class="col-lg-4 col-md-12">
            <h2>Réservation sécurisée</h2>
            <p>Payez en ligne et obtenez une confirmation instantanée de votre réservation !</p>
            <p><a class="btn btn-outline-success" href="<?= \yii\helpers\Url::to(['site/contact']) ?>">Contactez-nous &raquo;</a></p>
        </div>
    </div>
</div>











<!-- Styles personnalisés --
<style>
    .site-index {
        background-color: #f8f9fa;
    }

    /* Styles personnalisés pour le Jumbotron */
    .jumbotron {
        color: black;
        padding: 100px 0;
        text-align: center;
        margin-top; 200;
    }

    .jumbotron .display-4 {
        font-size: 3rem;
        color:white;
        font-weight: 600;
    }

    .jumbotron .lead {
        font-size: 1.25rem;
        color: white;
        font-weight: 400;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-size: 1.1rem;
        padding: 12px 20px;
        border-radius: 5px;
    }

    .btn-outline-success {
        color: #28a745;
        border: 2px solid #28a745;
        font-size: 1.1rem;
        padding: 12px 20px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color:  #28a745;
    }

    .body-content {
        background-color: #ffffff;
        padding: 50px 0;
    }

    .row {
        margin-top: 20px;
    }

    .col-lg-4 {
        padding: 20px;
    }

    .col-lg-4 h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #28a745;
        margin-bottom: 15px;
    }

    .col-lg-4 p {
        font-size: 1.1rem;
        color: #333;
    }

    .col-lg-4 .btn {
        margin-top: 15px;
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
-->