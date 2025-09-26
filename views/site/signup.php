<?php
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $model app\models\User */
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Sign Up</h3>
                </div>
                <div class="card-body">
                    
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

                    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Enter your username']) ?>
                    
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Enter your email']) ?>
                    
                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter your password (minimum 6 characters)']) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary w-100 mt-3']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="<?= \yii\helpers\Url::to(['site/login']) ?>">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>