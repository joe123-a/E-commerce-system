<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website <?= date('Y') ?></div>
            <div>
                <?= Html::a('Privacy Policy', Url::to(['site/privacy']), ['class' => '']) ?> 
                &middot;
                <?= Html::a('Terms &amp; Conditions', Url::to(['site/terms']), ['class' => '']) ?>
            </div>
        </div>
    </div>
</footer>