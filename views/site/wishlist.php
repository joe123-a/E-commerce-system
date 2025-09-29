<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $wishlistProvider yii\data\ActiveDataProvider */

$this->title = 'My Wishlist';

// Render star rating function (assuming it's available or defined as in your first snippet)
function renderStars($rating) {
    $fullStars = floor($rating);
    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
    $stars = str_repeat('<i class="fas fa-star text-primary"></i>', $fullStars);
    $stars .= $halfStar ? '<i class="fas fa-star-half-alt text-primary"></i>' : '';
    $stars .= str_repeat('<i class="far fa-star text-primary"></i>', $emptyStars);
    return $stars;
}
?>

<!-- Wishlist Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                data-wow-delay="0.1s">My Wishlist</h4>
            <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">Your Saved Products</h1>
        </div>

        <?php if ($wishlistProvider->getTotalCount() == 0): ?>
            <div class="text-center wow fadeInUp" data-wow-delay="0.5s">
                <p class="fs-5 text-dark mb-4">Your wishlist is empty. Explore our products and add your favorites!</p>
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-primary rounded-pill py-3 px-5">Shop Now</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($wishlistProvider->getModels() as $wishlistItem): ?>
                    <?php $product = $wishlistItem->product; ?>
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="product-item rounded">
                            <div class="product-item-inner border rounded">
                                <div class="product-item-inner-item">
                                    <?php
                                    $imagePath = $product->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $product->image_path)
                                        ? Yii::getAlias('@web') . '/' . $product->image_path
                                        : Yii::getAlias('@web') . '/images/no-image.jpg';
                                    ?>
                                    <?= Html::img($imagePath, ['class' => 'img-fluid w-100 rounded-top', 'alt' => Html::encode($product->name)]) ?>

                                    <?php if ($product->is_new): ?>
                                        <div class="product-new">New</div>
                                    <?php endif; ?>
                                    <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                        <div class="product-sale">Sale</div>
                                    <?php endif; ?>
                                    <div class="product-details">
                                        <a href="<?= Url::to(['site/product', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                    </div>
                                </div>
                                <div class="text-center rounded-bottom p-4">
                                    <a href="<?= Url::to(['site/category', 'id' => $product->category_id]) ?>" class="d-block mb-2">
                                        <?= Html::encode($product->category ? $product->category->name : 'Uncategorized') ?>
                                    </a>
                                    <a href="<?= Url::to(['site/product', 'id' => $product->id]) ?>" class="d-block h4">
                                        <?= Html::encode($product->name) ?>
                                    </a>
                                    <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                        <del class="me-2 fs-5">$<?= number_format($product->price, 2) ?></del>
                                        <span class="text-primary fs-5">$<?= number_format($product->discount_price, 2) ?></span>
                                    <?php else: ?>
                                        <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                </a>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <?= renderStars($product->rating ?? 0) ?>
                                    </div>
                                    <div class="d-flex">
                                        <a href="<?= Url::to(['compare/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-3">
                                            <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                                        </a>
                                        <a href="<?= Url::to(['wishlist/remove', 'id' => $wishlistItem->id]) ?>" class="text-danger d-flex align-items-center justify-content-center me-0">
                                            <span class="rounded-circle btn-sm-square border border-danger"><i class="fas fa-trash text-danger"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Wishlist End -->