<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">

    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success text-center">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p class="text-center">
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p class="text-center mb-4">
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row justify-content-center">
            <div class="col-lg-6">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'form-control']) ?>

                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'subject')->textInput(['class' => 'form-control']) ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6, 'class' => 'form-control']) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary btn-lg', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>

</div>

<!-- Custom CSS -->
<style>
    /* Set the background color and improve contrast */
    .site-contact {
        background-color: #f7f7f7; /* Light background color */
        padding: 50px 0;
        color: #333; /* Black text color */
    }

    /* Center the title */
    .site-contact h1 {
        color: #000; /* Black color for the title */
        font-size: 2.5em;
        margin-bottom: 40px;
    }

    /* Styling for the success message */
    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    /* Styling the contact form inputs */
    .form-control {
        border-radius: 5px;
        font-size: 1.1em;
        padding: 10px;
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
    }

    /* Styling the submit button */
    .btn-primary {
        background-color: #28a745;
        border-color: #28a745;
        font-size: 1.1em;
        padding: 12px 25px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Additional styling for form section */
    .row {
        margin-bottom: 40px;
    }

    .text-center {
        color: #333;
    }

    /* Ensures the layout is responsive */
    @media (max-width: 767px) {
        .site-contact h1 {
            font-size: 2em;
        }

        .form-group {
            margin-bottom: 15px;
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
