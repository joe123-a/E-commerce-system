<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Login';
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Login</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item active text-white">Login</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Login Form Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="border rounded p-4 bg-light">
                    <h3 class="text-primary mb-4">Log In to Your Account</h3>
                    <?= $this->render('_login_form', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login Form End -->