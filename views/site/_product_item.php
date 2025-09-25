<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Helper; // Make sure you have Helper.php with renderStars() function

/* @var $model app\models\Products */
?>

<div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
    <div class="product-item-inner border rounded">
        <div class="product-item-inner-item">
            <?php
            $imagePath = $model->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $model->image_path)
                ? Yii::getAlias('@web') . '/' . $model->image_path
                : Yii::getAlias('@web') . '/images/no-image.jpg';
            ?>
            <?= Html::img($imagePath, ['class' => 'img-fluid w-100 rounded-top', 'alt' => Html::encode($model->name)]) ?>

            <?php if ($model->is_new): ?>
                <div class="product-new">New</div>
            <?php endif; ?>

            <?php if ($model->discount_price && $model->discount_price < $model->price): ?>
                <div class="product-sale">Sale</div>
            <?php endif; ?>

            <div class="product-details">
                <a href="<?= Url::to(['site/product', 'id' => $model->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
            </div>
        </div>

        <div class="text-center rounded-bottom p-4">
            <a href="<?= Url::to(['site/category', 'id' => $model->category_id]) ?>" class="d-block mb-2">
                <?= Html::encode($model->category ? $model->category->name : 'Uncategorized') ?>
            </a>
            <a href="<?= Url::to(['site/product', 'id' => $model->id]) ?>" class="d-block h4">
                <?= Html::encode($model->name) ?>
            </a>

            <?php if ($model->discount_price && $model->discount_price < $model->price): ?>
                <del class="me-2 fs-5">$<?= number_format($model->price, 2) ?></del>
                <span class="text-primary fs-5">$<?= number_format($model->discount_price, 2) ?></span>
            <?php else: ?>
                <span class="text-primary fs-5">$<?= number_format($model->price, 2) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $model->id ?>">
            <i class="fas fa-shopping-cart me-2"></i> Add To Cart
        </a>

        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex">
                <?= Helper::renderStars($model->rating ?? 0) ?>
            </div>

            <div class="d-flex">
                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                    <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                </a>
                <a href="<?= Url::to(['wishlist/add', 'id' => $model->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0">
                    <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                </a>
            </div>
        </div>
    </div>
</div>
