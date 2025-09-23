<?php

use yii\helpers\Html;
use app\assets\AdminAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);

$this->registerCsrfMetaTags();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Admin Dashboard</title>
    <?php $this->head() ?>
</head>
<body class="sb-nav-fixed">
<?php $this->beginBody() ?>

    <?= $this->render('adpartials/_navbar') ?>

    <div id="layoutSidenav">
        <?= $this->render('adpartials/_sidebar') ?>
        
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <?= $content ?>
                </div>
            </main>
            
            <?= $this->render('adpartials/_footer') ?>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>