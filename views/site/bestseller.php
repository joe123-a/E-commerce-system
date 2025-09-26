<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use app\models\Products;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bestseller Products';
$csrfToken = Yii::$app->request->csrfToken;

// Register Owl Carousel assets
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

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

// Initialize Owl Carousel and Add to Cart
$this->registerJs(<<<JS
$(document).ready(function() {
    $('.productList-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });

    // Add to Cart
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        $.post('<?= Url::to(['cart/add']) ?>', {
            id: productId,
            quantity: 1,
            _csrf: '$csrfToken'
        }, function(response) {
            if (response.success) {
                window.location.href = '<?= Url::to(['cart/index']) ?>';
            } else {
                alert('Failed to add product to cart: ' + response.message);
            }
        }).fail(function(xhr) {
            alert('Error: ' + xhr.responseText);
        });
    });
});
JS);
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Bestseller Products</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/shop']) ?>">Shop</a></li>
        <li class="breadcrumb-item active text-white">Bestseller</li>
    </ol>
</div>
<!-- Single Page Header End -->

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
                        <p class="mb-0">Free shipping on all orders</p>
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
                        <p class="mb-0">Receive gift on orders over $50</p>
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
                <a href="<?= Url::to(['site/single', 'id' => 1]) ?>" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
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
                <a href="<?= Url::to(['site/single', 'id' => 2]) ?>" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
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

<!-- Bestseller Products Start -->
<div class="container-fluid products pb-5">
    <div class="container products-mini py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 700px;">
            <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                data-wow-delay="0.1s">Bestseller Products</h4>
            <p class="mb-0 wow fadeInUp" data-wow-delay="0.2s">Discover our top-selling products, curated for quality and popularity.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($dataProvider->getModels() as $index => $product): ?>
                <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="<?= 0.1 + ($index * 0.2) ?>s">
                    <div class="products-mini-item border">
                        <div class="row g-0">
                            <div class="col-5">
                                <div class="products-mini-img border-end h-100">
                                    <?php
                                    $imagePath = $product->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $product->image_path)
                                        ? Yii::getAlias('@web') . '/' . $product->image_path
                                        : Yii::getAlias('@web') . '/images/no-image.jpg';
                                    ?>
                                    <?= Html::img($imagePath, [
                                        'class' => 'img-fluid w-100 h-100',
                                        'alt' => Html::encode($product->name)
                                    ]) ?>
                                    <div class="products-mini-icon rounded-circle bg-primary">
                                        <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x text-white"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="products-mini-content p-3">
                                    <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block mb-2"><?= Html::encode($product->category->name ?? 'Electronics') ?></a>
                                    <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?> <br> <?= Html::encode($product->model) ?></a>
                                    <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                        <del class="me-2 fs-5">$<?= number_format($product->price, 2) ?></del>
                                        <span class="text-primary fs-5">$<?= number_format($product->discount_price, 2) ?></span>
                                    <?php else: ?>
                                        <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="products-mini-add border p-3">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 add-to-cart" data-id="<?= $product->id ?>"><i
                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                            <div class="d-flex">
                                <a href="<?= Url::to(['compare/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                        class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Bestseller Products End -->

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
                <?php
                $tabs = [
                    'tab-1' => ['label' => 'All Products', 'query' => Products::find()->with('category')],
                    'tab-2' => ['label' => 'New Arrivals', 'query' => Products::find()->with('category')->where(['is_new' => 1])],
                    'tab-3' => ['label' => 'Featured', 'query' => Products::find()->with('category')->where(['is_featured' => 1])],
                    'tab-4' => ['label' => 'Top Selling', 'query' => Products::find()->with('category')->orderBy(['sales_count' => SORT_DESC])],
                ];
                ?>
                <?php foreach ($tabs as $tabId => $tabData): ?>
                    <div id="<?= $tabId ?>" class="tab-pane fade <?= $tabId === 'tab-1' ? 'show active' : '' ?> p-0">
                        <div class="row g-4">
                            <?php
                            $dataProvider = new ActiveDataProvider([
                                'query' => $tabData['query'],
                                'pagination' => ['pageSize' => 8],
                            ]);
                            foreach ($dataProvider->getModels() as $index => $product):
                            ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="<?= 0.1 + ($index * 0.2) ?>s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?php
                                                $imagePath = $product->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $product->image_path)
                                                    ? Yii::getAlias('@web') . '/' . $product->image_path
                                                    : Yii::getAlias('@web') . '/images/no-image.jpg';
                                                ?>
                                                <?= Html::img($imagePath, [
                                                    'class' => 'img-fluid w-100 rounded-top',
                                                    'alt' => Html::encode($product->name)
                                                ]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php elseif ($product->discount_price && $product->discount_price < $product->price): ?>
                                                    <div class="product-sale">Sale</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block mb-2"><?= Html::encode($product->category->name ?? 'Electronics') ?></a>
                                                <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?> <br> <?= Html::encode($product->model) ?></a>
                                                <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                                    <del class="me-2 fs-5">$<?= number_format($product->price, 2) ?></del>
                                                    <span class="text-primary fs-5">$<?= number_format($product->discount_price, 2) ?></span>
                                                <?php else: ?>
                                                    <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>"><i
                                                    class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?= renderStars($product->rating ?? 0) ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="<?= Url::to(['compare/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                                            class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                                            class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Our Products End -->

<!-- Product List Start -->
<div class="container-fluid products productList overflow-hidden">
    <div class="container products-mini py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h4 class="text-primary border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp"
                data-wow-delay="0.1s">Products</h4>
            <h1 class="mb-0 display-3 wow fadeInUp" data-wow-delay="0.3s">All Product Items</h1>
        </div>
        <div class="productList-carousel owl-carousel pt-4 wow fadeInUp" data-wow-delay="0.3s">
            <?php
            $carouselProvider = new ActiveDataProvider([
                'query' => Products::find()->with('category')->orderBy(['sales_count' => SORT_DESC]),
                'pagination' => ['pageSize' => 12],
            ]);
            foreach ($carouselProvider->getModels() as $index => $product):
            ?>
                <div class="productImg-item products-mini-item border">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="products-mini-img border-end h-100">
                                <?php
                                $imagePath = $product->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $product->image_path)
                                    ? Yii::getAlias('@web') . '/' . $product->image_path
                                    : Yii::getAlias('@web') . '/images/no-image.jpg';
                                ?>
                                <?= Html::img($imagePath, [
                                    'class' => 'img-fluid w-100 h-100',
                                    'alt' => Html::encode($product->name)
                                ]) ?>
                                <div class="products-mini-icon rounded-circle bg-primary">
                                    <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x text-white"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="products-mini-content p-3">
                                <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block mb-2"><?= Html::encode($product->category->name ?? 'Electronics') ?></a>
                                <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>" class="d-block h4"><?= Html::encode($product->name) ?> <br> <?= Html::encode($product->model) ?></a>
                                <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                    <del class="me-2 fs-5">$<?= number_format($product->price, 2) ?></del>
                                    <span class="text-primary fs-5">$<?= number_format($product->discount_price, 2) ?></span>
                                <?php else: ?>
                                    <span class="text-primary fs-5">$<?= number_format($product->price, 2) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="products-mini-add border p-3">
                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 add-to-cart" data-id="<?= $product->id ?>"><i
                                class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                        <div class="d-flex">
                            <a href="<?= Url::to(['compare/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-3"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                            <a href="<?= Url::to(['wishlist/add', 'id' => $product->id]) ?>" class="text-primary d-flex align-items-center justify-content-center me-0"><span
                                    class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Product List End -->

<!-- Product Banner Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Banner 1 -->
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <a href="<?= Url::to(['site/single', 'id' => 3]) ?>">
                    <div class="bg-primary rounded position-relative">
                        <?= Html::img('@web/img/product-banner.jpg', [
                            'class' => 'img-fluid w-100 rounded',
                            'alt' => 'EOS Rebel T7i Kit'
                        ]) ?>
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                             style="background: rgba(255, 255, 255, 0.5);">
                            <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                            <p class="fs-4 text-muted">$899.99</p>
                            <a href="<?= Url::to(['site/single', 'id' => 3]) ?>" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Banner 2 -->
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <a href="<?= Url::to(['site/shop']) ?>">
                    <div class="text-center bg-primary rounded position-relative">
                        <?= Html::img('@web/img/product-banner-2.jpg', [
                            'class' => 'img-fluid w-100',
                            'alt' => 'Sale Banner'
                        ]) ?>
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                             style="background: rgba(242, 139, 0, 0.5);">
                            <h2 class="display-2 text-secondary">SALE</h2>
                            <h4 class="display-5 text-white mb-4">Get Up To 50% Off</h4>
                            <a href="<?= Url::to(['site/shop']) ?>" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Product Banner End -->