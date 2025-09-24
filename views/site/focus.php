<?php
// views/site/products.php
use yii\helpers\Html;
use yii\helpers\Url; // For generating URLs to product details or cart

/* @var $this yii\web\View */
/* @var $allProducts app\models\Product[] */
/* @var $newArrivals app\models\Product[] */
/* @var $featuredProducts app\models\Product[] */
/* @var $topSellingProducts app\models\Product[] */

$this->title = 'Our Products';

// Helper function to render star ratings
function renderStars($rating) {
    $html = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $html .= '<i class="fas fa-star text-primary"></i>';
        } else {
            $html .= '<i class="fas fa-star"></i>';
        }
    }
    return $html;
}
?>

<!-- Our Products Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="row g-4">
                <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 130px;">New Arrivals</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 130px;">Featured</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 130px;">Top Selling</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <!-- All Products Tab -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php if (empty($allProducts)): ?>
                            <p class="text-center">No products found.</p>
                        <?php else: ?>
                            <?php foreach ($allProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?= Html::img(Yii::getAlias('@web') . '/' . $product->image, ['class' => 'img-fluid w-100 rounded-top', 'alt' => $product->name]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php endif; ?>
                                                <?php if ($product->price < $product->old_price): // Example for sale flag ?>
                                                    <div class="product-sale">Sale</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#" class="d-block mb-2"><?= Html::encode($product->category_name ?? 'Uncategorized') ?></a>
                                                <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?></a>
                                                <?php if ($product->old_price && $product->old_price > $product->price): ?>
                                                    <del class="me-2 fs-5">$<?= number_format($product->old_price, 2) ?></del>
                                                <?php endif; ?>
                                                <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?= renderStars($product->rating ?? 0) ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- New Arrivals Tab -->
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($newArrivals)): ?>
                            <p class="text-center">No new arrivals found.</p>
                        <?php else: ?>
                            <?php foreach ($newArrivals as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?= Html::img(Yii::getAlias('@web') . '/' . $product->image, ['class' => 'img-fluid w-100 rounded-top', 'alt' => $product->name]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php endif; ?>
                                                <?php if ($product->price < $product->old_price): ?>
                                                    <div class="product-sale">Sale</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#" class="d-block mb-2"><?= Html::encode($product->category_name ?? 'Uncategorized') ?></a>
                                                <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?></a>
                                                <?php if ($product->old_price && $product->old_price > $product->price): ?>
                                                    <del class="me-2 fs-5">$<?= number_format($product->old_price, 2) ?></del>
                                                <?php endif; ?>
                                                <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?= renderStars($product->rating ?? 0) ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Featured Tab -->
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($featuredProducts)): ?>
                            <p class="text-center">No featured products found.</p>
                        <?php else: ?>
                            <?php foreach ($featuredProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?= Html::img(Yii::getAlias('@web') . '/' . $product->image, ['class' => 'img-fluid w-100 rounded-top', 'alt' => $product->name]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php endif; ?>
                                                <?php if ($product->price < $product->old_price): ?>
                                                    <div class="product-sale">Sale</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#" class="d-block mb-2"><?= Html::encode($product->category_name ?? 'Uncategorized') ?></a>
                                                <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?></a>
                                                <?php if ($product->old_price && $product->old_price > $product->price): ?>
                                                    <del class="me-2 fs-5">$<?= number_format($product->old_price, 2) ?></del>
                                                <?php endif; ?>
                                                <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?= renderStars($product->rating ?? 0) ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Top Selling Tab -->
                <div id="tab-4" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($topSellingProducts)): ?>
                            <p class="text-center">No top selling products found.</p>
                        <?php else: ?>
                            <?php foreach ($topSellingProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?= Html::img(Yii::getAlias('@web') . '/' . $product->image, ['class' => 'img-fluid w-100 rounded-top', 'alt' => $product->name]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php endif; ?>
                                                <?php if ($product->price < $product->old_price): ?>
                                                    <div class="product-sale">Sale</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="#" class="d-block mb-2"><?= Html::encode($product->category_name ?? 'Uncategorized') ?></a>
                                                <a href="<?= Url::to(['product/view', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?></a>
                                                <?php if ($product->old_price && $product->old_price > $product->price): ?>
                                                    <del class="me-2 fs-5">$<?= number_format($product->old_price, 2) ?></del>
                                                <?php endif; ?>
                                                <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="<?= Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4"><i
                                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?= renderStars($product->rating ?? 0) ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Products End -->









<!-- < ?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $allProducts app\models\Products[] */
/* @var $newArrivals app\models\Products[] */
/* @var $featuredProducts app\models\Products[] */
/* @var $topSellingProducts app\models\Products[] */

$this->title = 'Our Shop';
$this->params['breadcrumbs'][] = $this->title;

// Define renderStars function
function renderStars($rating) {
    $fullStars = floor($rating);
    $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
    $stars = str_repeat('<i class="fas fa-star text-primary"></i>', $fullStars);
    $stars .= $halfStar ? '<i class="fas fa-star-half-alt text-primary"></i>' : '';
    $stars .= str_repeat('<i class="far fa-star text-primary"></i>', $emptyStars);
    return $stars;
}
?> -->

<!-- Our Products Start -->
<div class="container-fluid product py-5">
    <div class="container py-5">
        <div class="tab-class">
            <div class="row g-4">
                <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 130px;">New Arrivals</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 130px;">Featured</span>
                            </a>
                        </li>
                        <li class="nav-item mb-4">
                            <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 130px;">Top Selling</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <!-- All Products Tab -->
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php if (empty($allProducts)): ?>
                            <p class="text-center">No products found.</p>
                        <?php else: ?>
                            <?php foreach ($allProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
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
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                                                    </a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- New Arrivals Tab -->
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($newArrivals)): ?>
                            <p class="text-center">No new arrivals found.</p>
                        <?php else: ?>
                            <?php foreach ($newArrivals as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
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
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                                                    </a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Featured Tab -->
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($featuredProducts)): ?>
                            <p class="text-center">No featured products found.</p>
                        <?php else: ?>
                            <?php foreach ($featuredProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
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
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                                                    </a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Top Selling Tab -->
                <div id="tab-4" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <?php if (empty($topSellingProducts)): ?>
                            <p class="text-center">No top selling products found.</p>
                        <?php else: ?>
                            <?php foreach ($topSellingProducts as $product): ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
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
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span>
                                                    </a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0">
                                                        <span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Products End -->