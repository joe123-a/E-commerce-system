<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $model app\models\User */
?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'action' => Url::to(['site/signup']),
]); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter your username'])->label(false) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Enter your email'])->label(false) ?>
<?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Enter your password (minimum 6 characters)'])->label(false) ?>

<div class="form-group text-center mt-3">
    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary w-100', 'name' => 'signup-button']) ?>
</div>

<div class="text-center mt-3">
    <p>Already have an account? <a href="<?= Url::to(['site/login']) ?>" class="text-primary">Log In</a></p>
</div>

<?php ActiveForm::end(); ?>