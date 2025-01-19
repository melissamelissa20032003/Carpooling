<?php

/** @var yii\web\View $this */
/** @var string $content */
use yii\helpers\Url; 
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

//cette ligne ajoute les fichier rensigner dans AppAsset.php
AppAsset::register($this);
//inclure le fichier JS 
$this->registerCsrfMetaTags();

$this->registerJsFile('@web/js/recherche.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/inscription.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/reservation.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/notification.js', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/proposer.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerCssFile('@web/css/site.css', ['depends' => [\yii\web\YiiAsset::class]]);
$this->registerCssFile('@web/css/recherche.css', ['depends' => [\yii\web\YiiAsset::class]]);
$this->registerJs("var proposerUrl = '" . Url::to(['site/proposer']) . "';", \yii\web\View::POS_HEAD);

$this->registerCssFile('@web/css/bootstrap.css'); 


//inclure le fichier CSS
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/cericar.png', ['alt' => 'Logo', 'class' => 'navbar-logo']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            
            Yii::$app->user->isGuest ? '' : ['label' => 'Mon Profil', 'url' => ['/site/profile'], 'class' => 'nav-link'],

            ['label' => 'Rechercher', 'url' => ['/site/recherche']],
            ['label' => 'Devenir Conducteur', 'url' => ['/site/proposer']], 
            
        // Affichage du lien Inscription uniquement si l'utilisateur n'est pas connecté
        Yii::$app->user->isGuest ? ['label' => 'Inscription', 'url' => ['/site/inscription']] : '',
           
            Yii::$app->user->isGuest ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>



<!-- Conteneur pour les notifications -->
<div id="registration-notification-bar" style="display:none; color: white; background-color: #333; padding: 10px; margin-top : 400px; font-size: 16px; 
            text-align: center; top: 20%; left: 50%; transform: translate(-50%, -50%); 
            z-index: 1000; border-radius: 8px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">


</div>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>




<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>





































<!-- Bandeau de notification en bas de la page -->
<div id="notification-bar" style="display:none; color: white; background-color: #333; padding: 10px; font-size: 16px; text-align: center; position: fixed; top: 200; width: 100%; z-index: 1000; margin-bottom= 100px;">
    <!-- Notification messages will be dynamically inserted here -->
</div>
