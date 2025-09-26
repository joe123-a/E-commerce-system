<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger">
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => Url::to(['site/login']),
]);
?>
<div class="form-group row mb-3">
    <label class="col-lg-4 col-form-label">Username</label>
    <div class="col-lg-8">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter your username', 'class' => 'form-control'])->label(false) ?>
    </div>
</div>
<div class="form-group row mb-3">
    <label class="col-lg-4 col-form-label">Password</label>
    <div class="col-lg-8">
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Enter your password', 'class' => 'form-control'])->label(false) ?>
    </div>
</div>
<div class="form-group text-center">
    <?= Html::submitButton('Log In', ['class' => 'btn btn-primary rounded-pill py-2 px-4', 'name' => 'login-button']) ?>
</div>
<div class="text-center mt-3">
    <p>Don't have an account? <a href="<?= Url::to(['site/signup']) ?>" class="text-primary">Sign Up</a></p>
</div>
<?php ActiveForm::end(); ?>