<?php
use yii\helpers\Html;
use app\assets\CustomerAsset;
use app\models\Categories;

CustomerAsset::register($this);
$this->beginPage();

// Ensure categories are available for all pages
if (!isset(Yii::$app->view->params['categories'])) {
    Yii::$app->view->params['categories'] = Categories::find()
        ->select(['categories.*', 'COUNT(products.id) AS product_count'])
        ->leftJoin('products', 'products.category_id = categories.id')
        ->groupBy('categories.id')
        ->all();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= Html::encode($this->title) ?> - Service Cops</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<!-- Spinner -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<!-- Topbar -->
<?= $this->render('partials/topbar') ?>

<!-- Navbar -->
<?= $this->render('partials/navbar') ?>

<!-- Main Content -->
<?= $content ?>

<!-- Footer -->
<?= $this->render('partials/footer') ?>

<!-- Copyright -->
<?= $this->render('partials/copyright') ?>

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
