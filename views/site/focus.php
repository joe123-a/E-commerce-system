<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $allProducts array */
/* @var $newArrivals array */
/* @var $featuredProducts array */
/* @var $topSellingProducts array */
$this->title = 'Home';

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

// Register JavaScript for AJAX "Add to Cart"

$this->registerJs(<<<JS
$(document).on('click', '.add-to-cart', function(e) {
    e.preventDefault();
    var productId = $(this).data('id');
    $.ajax({
        url: '<?= Url::to(['cart/add']) ?>',
        type: 'GET',
        data: { id: productId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message);
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function() {
            alert('Error adding product to cart.');
        }
    });
});
JS
);
?>


<!-- Carousel Start -->
<div class="container-fluid carousel bg-light px-0">
    <div class="row g-0 justify-content-end">
        <div class="col-12 col-lg-7 col-xl-9">
            <div class="header-carousel owl-carousel bg-light py-5">
                <!-- Carousel Item 1 -->
                <div class="row g-0 header-carousel-item align-items-center">
                    <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                        <?= Html::img('@web/img/carousel-1.png', ['class' => 'img-fluid w-100', 'alt' => 'Image']) ?>
                    </div>
                    <div class="col-xl-6 carousel-content p-4">
                        <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s" style="letter-spacing: 3px;">Save Up To A $400</h4>
                        <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">
                            On Selected Laptops & Desktop Or Smartphone
                        </h1>
                        <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s" href="#">Shop Now</a>
                    </div>
                </div>
                <!-- Carousel Item 2 -->
                <div class="row g-0 header-carousel-item align-items-center">
                    <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                        <?= Html::img('@web/img/carousel-2.png', ['class' => 'img-fluid w-100', 'alt' => 'Image']) ?>
                    </div>
                    <div class="col-xl-6 carousel-content p-4">
                        <h4 class="text-uppercase fw-bold mb-4 wow fadeInRight" data-wow-delay="0.1s" style="letter-spacing: 3px;">Save Up To A $200</h4>
                        <h1 class="display-3 text-capitalize mb-4 wow fadeInRight" data-wow-delay="0.3s">
                            On Selected Laptops & Desktop Or Smartphone
                        </h1>
                        <p class="text-dark wow fadeInRight" data-wow-delay="0.5s">Terms and Condition Apply</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInRight" data-wow-delay="0.7s" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel Banner -->
        <div class="col-12 col-lg-5 col-xl-3 wow fadeInRight" data-wow-delay="0.1s">
            <div class="carousel-header-banner h-100">
                <?= Html::img('@web/img/header-img.jpg', [
                    'class' => 'img-fluid w-100 h-100',
                    'style' => 'object-fit: cover;',
                    'alt' => 'Image'
                ]) ?>
                <div class="carousel-banner-offer">
                    <p class="bg-primary text-white rounded fs-5 py-2 px-4 mb-0 me-3">Save $48.00</p>
                    <p class="text-primary fs-5 fw-bold mb-0">Special Offer</p>
                </div>
                <div class="carousel-banner">
                    <div class="carousel-banner-content text-center p-4">
                        <a href="#" class="d-block mb-2">SmartPhone</a>
                        <a href="#" class="d-block text-white fs-3">Apple iPad Mini <br> G2356</a>
                        <del class="me-2 text-white fs-5">$1,250.00</del>
                        <span class="text-primary fs-5">$1,050.00</span>
                    </div>
                    <a href="#" class="btn btn-primary rounded-pill py-2 px-4 add-to-cart" data-id="1">
                        <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Service Start -->
<div class="container-fluid px-0">
    <div class="row g-0">
        <!-- Feature 1 -->
        <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
            <div class="p-4">
                <div class="d-inline-flex align-items-center">
                    <i class="fa fa-sync-alt fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Free Return</h6>
                        <p class="mb-0">30 days money back guarantee!</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature 2 -->
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Free Shipping</h6>
                        <p class="mb-0">Free shipping on all order</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature 3 -->
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-life-ring fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Support 24/7</h6>
                        <p class="mb-0">We support online 24 hrs a day</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature 4 -->
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-credit-card fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Receive Gift Card</h6>
                        <p class="mb-0">Receive gift all over order $50</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature 5 -->
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-lock fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Secure Payment</h6>
                        <p class="mb-0">We value your security</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature 6 -->
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-blog fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Online Service</h6>
                        <p class="mb-0">Free return products in 30 days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Products Offer Start -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Promo 1 -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                    <div>
                        <p class="text-muted mb-3">Find The Best Camera for You!</p>
                        <h3 class="text-primary">Smart Camera</h3>
                        <h1 class="display-3 text-secondary mb-0">
                            40% <span class="text-primary fw-normal">Off</span>
                        </h1>
                    </div>
                    <?= Html::img('@web/img/product-1.png', ['class' => 'img-fluid', 'alt' => 'Smart Camera']) ?>
                </a>
            </div>
            <!-- Promo 2 -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <a href="#" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                    <div>
                        <p class="text-muted mb-3">Find The Best Watches for You!</p>
                        <h3 class="text-primary">Smart Watch</h3>
                        <h1 class="display-3 text-secondary mb-0">
                            20% <span class="text-primary fw-normal">Off</span>
                        </h1>
                    </div>
                    <?= Html::img('@web/img/product-2.png', ['class' => 'img-fluid', 'alt' => 'Smart Watch']) ?>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Products Offer End -->

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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>">
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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>">
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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>">
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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>">
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