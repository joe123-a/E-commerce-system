<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-6">
                <?php
                $imagePath = $model->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $model->image_path)
                    ? Yii::getAlias('@web') . '/' . $model->image_path
                    : Yii::getAlias('@web') . '/images/no-image.jpg';
                ?>
                <?= Html::img($imagePath, ['class' => 'img-fluid rounded', 'alt' => Html::encode($model->name)]) ?>
            </div>
            <div class="col-lg-6">
                <h1><?= Html::encode($model->name) ?></h1>
                <p><strong>Category:</strong> <?= Html::encode($model->category ? $model->category->name : 'Uncategorized') ?></p>
                <p><strong>Model:</strong> <?= Html::encode($model->model) ?></p>
                <p><strong>Price:</strong>
                    <?php if ($model->discount_price && $model->discount_price < $model->price): ?>
                        <del>$<?= number_format($model->price, 2) ?></del>
                        <span class="text-primary">$<?= number_format($model->discount_price, 2) ?></span>
                    <?php else: ?>
                        <span class="text-primary">$<?= number_format($model->price, 2) ?></span>
                    <?php endif; ?>
                </p>
                <p><strong>Stock:</strong> <?= $model->stock_quantity > 0 ? $model->stock_quantity . ' in stock' : 'Out of stock' ?></p>
                <p><strong>Description:</strong> <?= Html::encode($model->description ?? 'No description available.') ?></p>
                <div class="d-flex gap-2">
                    <a href="<?= Url::to(['cart/add', 'id' => $model->id]) ?>" class="btn btn-primary rounded-pill py-2 px-4">
                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                    </a>
                    <a href="<?= Url::to(['wishlist/add', 'id' => $model->id]) ?>" class="btn btn-outline-primary rounded-pill py-2 px-4">
                        <i class="fas fa-heart me-2"></i> Add To Wishlist
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>