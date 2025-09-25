<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Products;
use app\models\Categories;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;

// Fetch categories and product counts
$categories = Categories::find()->select(['id', 'name'])->indexBy('id')->asArray()->all();
$categoryList = array_map(function($category) {
    return ['name' => $category['name'], 'count' => Products::find()->where(['category_id' => $category['id']])->count()];
}, $categories);

// Data provider for products
$query = Products::find()->with('category');
$categoryId = Yii::$app->request->get('category_id');
$sort = Yii::$app->request->get('sort', 'default');
$price = (float) Yii::$app->request->get('price', 500);

if ($categoryId) {
    $query->andWhere(['category_id' => $categoryId]);
}
if ($price < 500) {
    $query->andWhere(['<=', 'discount_price', $price])->orWhere(['<=', 'price', $price]);
}

switch ($sort) {
    case 'popularity':
        $query->orderBy(['is_top_selling' => SORT_DESC]);
        break;
    case 'newness':
        $query->orderBy(['is_new' => SORT_DESC]);
        break;
    case 'low-to-high':
        $query->orderBy(['price' => SORT_ASC]);
        break;
    case 'high-to-low':
        $query->orderBy(['price' => SORT_DESC]);
        break;
    default:
        $query->orderBy(['id' => SORT_ASC]);
}

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 9,
    ],
]);

$products = $dataProvider->getModels();

// Register JavaScript for filters and Add to Cart
$csrfToken = Yii::$app->request->csrfToken; // Define CSRF token in PHP
$this->registerJs(<<<JS
$(document).ready(function() {
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

    // Price range filter
    $('#rangeInput').on('input', function() {
        var price = $(this).val();
        $('#amount').text(price);
        var url = new URL(window.location.href);
        url.searchParams.set('price', price);
        window.location.href = url.toString();
    });

    // Sort filter
    $('#electronics').on('change', function() {
        var sort = $(this).val();
        var url = new URL(window.location.href);
        url.searchParams.set('sort', sort);
        window.location.href = url.toString();
    });

    // Search
    $('#search-input').on('keypress', function(e) {
        if (e.which == 13) {
            var query = $(this).val();
            var url = new URL(window.location.href);
            url.searchParams.set('q', query);
            window.location.href = url.toString();
        }
    });
});
JS
);
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Shop Page</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Services Start -->
<div class="container-fluid px-0">
    <div class="row g-0">
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
        <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
            <div class="p-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-lock fa-2x text-primary"></i>
                    <div class="ms-4">
                        <h6 class="text-uppercase mb-2">Secure Payment</h6>
                        <p class="mb-0">We Value Your Security</p>
                    </div>
                </div>
            </div>
        </div>
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
<!-- Services End -->

<!-- Products Offer Start -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <a href="<?= Url::to(['site/single', 'id' => 2]) ?>" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                    <div>
                        <p class="text-muted mb-3">Find The Best Camera for You!</p>
                        <h3 class="text-primary">Smart Camera</h3>
                        <h1 class="display-3 text-secondary mb-0">40% <span class="text-primary fw-normal">Off</span></h1>
                    </div>
                    <?= Html::img('@web/img/product-1.png', ['class' => 'img-fluid', 'alt' => 'Smart Camera']) ?>
                </a>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <a href="<?= Url::to(['site/single', 'id' => 3]) ?>" class="d-flex align-items-center justify-content-between border bg-white rounded p-4">
                    <div>
                        <p class="text-muted mb-3">Find The Best Watches for You!</p>
                        <h3 class="text-primary">Smart Watch</h3>
                        <h1 class="display-3 text-secondary mb-0">20% <span class="text-primary fw-normal">Off</span></h1>
                    </div>
                    <?= Html::img('@web/img/product-2.png', ['class' => 'img-fluid', 'alt' => 'Smart Watch']) ?>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Products Offer End -->

<!-- Shop Page Start -->
<div class="container-fluid shop py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="product-categories mb-4">
                    <h4>Products Categories</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($categoryList as $id => $category): ?>
                            <li>
                                <div class="categories-item">
                                    <a href="<?= Url::to(['site/shop', 'category_id' => $id]) ?>" class="text-dark">
                                        <i class="fas fa-apple-alt text-secondary me-2"></i>
                                        <?= Html::encode($category['name']) ?>
                                    </a>
                                    <span>(<?= $category['count'] ?>)</span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="price mb-4">
                    <h4 class="mb-2">Price</h4>
                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="<?= $price ?>" oninput="amount.value=rangeInput.value">
                    <output id="amount" name="amount" min-value="0" max-value="500" for="rangeInput"><?= $price ?></output>
                </div>
                <div class="product-color mb-3">
                    <h4>Select By Color</h4>
                    <ul class="list-unstyled">
                        <li><div class="product-color-item"><a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>Gold</a><span>(1)</span></div></li>
                        <li><div class="product-color-item"><a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>Green</a><span>(1)</span></div></li>
                        <li><div class="product-color-item"><a href="#" class="text-dark"><i class="fas fa-apple-alt text-secondary me-2"></i>White</a><span>(1)</span></div></li>
                    </ul>
                </div>
                <div class="additional-product mb-4">
                    <h4>Additional Products</h4>
                    <?php foreach ($categoryList as $id => $category): ?>
                        <div class="additional-product-item">
                            <input type="radio" class="me-2" id="Categories-<?= $id ?>" name="Categories-1" value="<?= Html::encode($category['name']) ?>">
                            <label for="Categories-<?= $id ?>" class="text-dark"><?= Html::encode($category['name']) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="featured-product mb-4">
                    <h4 class="mb-3">Featured Products</h4>
                    <?php
                    $featuredProducts = Products::find()->where(['is_featured' => 1])->limit(3)->all();
                    foreach ($featuredProducts as $product): ?>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <?= Html::img('@web/img/product-' . $product->id . '.png', ['class' => 'img-fluid', 'alt' => Html::encode($product->name)]) ?>
                            </div>
                            <div>
                                <h6 class="mb-2"><?= Html::encode($product->name) ?></h6>
                                <div class="d-flex mb-2">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="fa fa-star <?= $i < 4 ? 'text-secondary' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">$<?= number_format($product->discount_price ?: $product->price, 2) ?></h5>
                                    <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                                        <h5 class="text-danger text-decoration-line-through">$<?= number_format($product->price, 2) ?></h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="d-flex justify-content-center my-4">
                        <a href="<?= Url::to(['site/shop']) ?>" class="btn btn-primary px-4 py-3 rounded-pill w-100">View More</a>
                    </div>
                </div>
                <a href="#">
                    <div class="position-relative">
                        <?= Html::img('@web/img/product-banner-2.jpg', ['class' => 'img-fluid w-100 rounded', 'alt' => 'Image']) ?>
                        <div class="text-center position-absolute d-flex flex-column align-items-center justify-content-center rounded p-4"
                             style="width: 100%; height: 100%; top: 0; right: 0; background: rgba(242, 139, 0, 0.3);">
                            <h5 class="display-6 text-primary">SALE</h5>
                            <h4 class="text-secondary">Get UP To 50% Off</h4>
                            <a href="#" class="btn btn-primary rounded-pill px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
                <div class="product-tags py-4">
                    <h4 class="mb-3">PRODUCT TAGS</h4>
                    <div class="product-tags-items bg-light rounded p-3">
                        <?php foreach (['New', 'Brand', 'Black', 'White', 'Tablets', 'Phone', 'Camera', 'Drone', 'Television', 'Sales'] as $tag): ?>
                            <a href="#" class="border rounded py-1 px-2 mb-2"><?= Html::encode($tag) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">
                <div class="rounded mb-4 position-relative">
                    <?= Html::img('@web/img/product-banner-3.jpg', ['class' => 'img-fluid w-100 rounded', 'alt' => 'Image']) ?>
                    <div class="position-absolute rounded d-flex flex-column align-items-center justify-content-center text-center"
                         style="width: 100%; height: 250px; top: 0; left: 0; background: rgba(242, 139, 0, 0.3);">
                        <h4 class="display-5 text-primary">SALE</h4>
                        <h3 class="display-4 text-white mb-4">Get UP To 50% Off</h3>
                        <a href="#" class="btn btn-primary rounded-pill">Shop Now</a>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-xl-7">
                        <div class="input-group w-100 mx-auto d-flex">
                            <input type="search" class="form-control p-3" id="search-input" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                    <div class="col-xl-3 text-end">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                            <label for="electronics">Sort By:</label>
                            <select id="electronics" name="electronicslist" class="border-0 form-select-sm bg-light me-3">
                                <option value="default" <?= $sort == 'default' ? 'selected' : '' ?>>Default Sorting</option>
                                <option value="popularity" <?= $sort == 'popularity' ? 'selected' : '' ?>>Popularity</option>
                                <option value="newness" <?= $sort == 'newness' ? 'selected' : '' ?>>Newness</option>
                                <option value="low-to-high" <?= $sort == 'low-to-high' ? 'selected' : '' ?>>Low to High</option>
                                <option value="high-to-low" <?= $sort == 'high-to-low' ? 'selected' : '' ?>>High to Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-2">
                        <ul class="nav nav-pills d-inline-flex text-center py-2 px-2 rounded bg-light mb-4">
                            <li class="nav-item me-4">
                                <a class="bg-light" data-bs-toggle="pill" href="#tab-5">
                                    <i class="fas fa-th fa-3x text-primary"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="bg-light" data-bs-toggle="pill" href="#tab-6">
                                    <i class="fas fa-bars fa-3x text-primary"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-5" class="tab-pane fade show p-0 active">
                        <div class="row g-4 product">
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-4">
                                    <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item-inner border rounded">
                                            <div class="product-item-inner-item">
                                                <?= Html::img('@web/img/product-' . $product->id . '.png', ['class' => 'img-fluid w-100 rounded-top', 'alt' => Html::encode($product->name)]) ?>
                                                <?php if ($product->is_new): ?>
                                                    <div class="product-new">New</div>
                                                <?php endif; ?>
                                                <div class="product-details">
                                                    <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center rounded-bottom p-4">
                                                <a href="<?= Url::to(['site/category', 'id' => $product->category_id]) ?>" class="d-block mb-2"><?= Html::encode($product->category ? $product->category->name : 'N/A') ?></a>
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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $product->id ?>"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i class="fas fa-star <?= $i < 4 ? 'text-primary' : '' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                    <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <?= LinkPager::widget([
                                        'pagination' => $dataProvider->pagination,
                                        'prevPageLabel' => '&laquo;',
                                        'nextPageLabel' => '&raquo;',
                                        'activePageCssClass' => 'active',
                                        'linkOptions' => ['class' => 'rounded'],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-6" class="products tab-pane fade show p-0">
                        <div class="row g-4 products-mini">
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-6">
                                    <div class="products-mini-item border">
                                        <div class="row g-0">
                                            <div class="col-5">
                                                <div class="products-mini-img border-end h-100">
                                                    <?= Html::img('@web/img/product-' . $product->id . '.png', ['class' => 'img-fluid w-100 rounded-top', 'alt' => Html::encode($product->name)]) ?>
                                                    <div class="products-mini-icon rounded-circle bg-primary">
                                                        <a href="<?= Url::to(['site/single', 'id' => $product->id]) ?>"><i class="fa fa-eye fa-1x text-white"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="products-mini-content p-3">
                                                    <a href="<?= Url::to(['site/category', 'id' => $product->category_id]) ?>" class="d-block mb-2"><?= Html::encode($product->category ? $product->category->name : 'N/A') ?></a>
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
                                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 add-to-cart" data-id="<?= $product->id ?>"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
                                            <div class="d-flex">
                                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-sm-square border"><i class="fas fa-random"></i></span></a>
                                                <a href="#" class="text-primary d-flex align-items-center justify-content-center me-0"><span class="rounded-circle btn-sm-square border"><i class="fas fa-heart"></i></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="pagination d-flex justify-content-center mt-5">
                                    <?= LinkPager::widget([
                                        'pagination' => $dataProvider->pagination,
                                        'prevPageLabel' => '&laquo;',
                                        'nextPageLabel' => '&raquo;',
                                        'activePageCssClass' => 'active',
                                        'linkOptions' => ['class' => 'rounded'],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Shop Page End -->

<!-- Product Banner Start -->
<div class="container-fluid py-5">
    <div class="container pb-5">
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <a href="<?= Url::to(['site/single', 'id' => 4]) ?>">
                    <div class="bg-primary rounded position-relative">
                        <?= Html::img('@web/img/product-banner.jpg', ['class' => 'img-fluid w-100 rounded', 'alt' => 'EOS Rebel T7i Kit']) ?>
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                             style="background: rgba(255, 255, 255, 0.5);">
                            <h3 class="display-5 text-primary">EOS Rebel <br> <span>T7i Kit</span></h3>
                            <p class="fs-4 text-muted">$899.99</p>
                            <a href="<?= Url::to(['site/single', 'id' => 4]) ?>" class="btn btn-primary rounded-pill align-self-start py-2 px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <a href="#">
                    <div class="text-center bg-primary rounded position-relative">
                        <?= Html::img('@web/img/product-banner-2.jpg', ['class' => 'img-fluid w-100 rounded', 'alt' => 'Sale Banner']) ?>
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                             style="background: rgba(242, 139, 0, 0.5);">
                            <h2 class="display-2 text-secondary">SALE</h2>
                            <h4 class="display-5 text-white mb-4">Get UP To 50% Off</h4>
                            <a href="#" class="btn btn-secondary rounded-pill align-self-center py-2 px-4">Shop Now</a>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Product Banner End -->