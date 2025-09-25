<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Products;
use app\models\Categories;

// Fetch product and related products
$product = $model; // Passed from SiteController::actionSingle
$relatedProducts = Products::find()->where(['category_id' => $product->category_id])->andWhere(['!=', 'id', $product->id])->limit(5)->all();
$categories = Categories::find()->select(['id', 'name'])->indexBy('id')->asArray()->all();
$categoryList = array_map(function($category) {
    return ['name' => $category['name'], 'count' => Products::find()->where(['category_id' => $category['id']])->count()];
}, $categories);

// Register JavaScript for quantity input and Owl Carousel
$this->registerJs(<<<JS
$(document).ready(function() {
    $('.btn-plus, .btn-minus').on('click', function() {
        var input = $(this).closest('.input-group').find('input');
        var quantity = parseInt(input.val()) || 1;
        if ($(this).hasClass('btn-plus')) {
            quantity += 1;
        } else if (quantity > 1) {
            quantity -= 1;
        }
        input.val(quantity);
    });

    $('.single-carousel').owlCarousel({
        items: 1,
        loop: true,
        dots: true,
        nav: false,
        margin: 10
    });

    $('.related-carousel').owlCarousel({
        items: 4,
        loop: true,
        dots: true,
        nav: false,
        margin: 10,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });

    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        var quantity = parseInt($(this).closest('.single-product').find('.quantity input').val()) || 1;
        
        $.post('<?= Url::to(['cart/add']) ?>', {
            id: productId,
            quantity: quantity,
            _csrf: '<?= Yii::$app->request->csrfToken ?>'
        }, function(response) {
            if (response.success) {
                window.location.href = '<?= Url::to(['cart/index']) ?>';
            } else {
                alert('Failed to add product to cart: ' + response.message);
            }
        });
    });
});
JS
);
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Single Product</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Single Product</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Single Products Start -->
<div class="container-fluid shop py-5">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-5 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="input-group w-100 mx-auto d-flex mb-4">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
                <div class="product-categories mb-4">
                    <h4>Products Categories</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($categoryList as $id => $category): ?>
                            <li>
                                <div class="categories-item">
                                    <a href="<?= Url::to(['site/category', 'id' => $id]) ?>" class="text-dark">
                                        <i class="fas fa-apple-alt text-secondary me-2"></i>
                                        <?= Html::encode($category['name']) ?>
                                    </a>
                                    <span>(<?= $category['count'] ?>)</span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="additional-product mb-4">
                    <h4>Select By Color</h4>
                    <div class="additional-product-item">
                        <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Gold">
                        <label for="Categories-1" class="text-dark">Gold</label>
                    </div>
                    <div class="additional-product-item">
                        <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Green">
                        <label for="Categories-2" class="text-dark">Green</label>
                    </div>
                    <div class="additional-product-item">
                        <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="White">
                        <label for="Categories-3" class="text-dark">White</label>
                    </div>
                </div>
                <div class="featured-product mb-4">
                    <h4 class="mb-3">Featured products</h4>
                    <?php foreach ($relatedProducts as $related): ?>
                        <div class="featured-product-item">
                            <div class="rounded me-4" style="width: 100px; height: 100px;">
                                <?= Html::img('@web/img/product-' . $related->id . '.png', ['class' => 'img-fluid rounded', 'alt' => Html::encode($related->name)]) ?>
                            </div>
                            <div>
                                <h6 class="mb-2"><?= Html::encode($related->name) ?></h6>
                                <div class="d-flex mb-2">
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="fa fa-star <?= $i < 4 ? 'text-secondary' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                                <div class="d-flex mb-2">
                                    <h5 class="fw-bold me-2">$<?= number_format($related->discount_price ?: $related->price, 2) ?></h5>
                                    <?php if ($related->discount_price && $related->discount_price < $related->price): ?>
                                        <h5 class="text-danger text-decoration-line-through">$<?= number_format($related->price, 2) ?></h5>
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
                <div class="product-tags my-4">
                    <h4 class="mb-3">PRODUCT TAGS</h4>
                    <div class="product-tags-items bg-light rounded p-3">
                        <?php foreach (['New', 'brand', 'black', 'white', 'tablets', 'phone', 'camera', 'drone', 'television', 'sales'] as $tag): ?>
                            <a href="#" class="border rounded py-1 px-2 mb-2"><?= Html::encode($tag) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xl-9 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-4 single-product">
                    <div class="col-xl-6">
                        <div class="single-carousel owl-carousel">
                            <?php $images = [$product->id, $product->id + 1, $product->id + 2, $product->id + 3, $product->id + 4]; ?>
                            <?php foreach ($images as $img): ?>
                                <div class="single-item" data-dot="<?= Html::img('@web/img/product-' . $img . '.png', ['class' => 'img-fluid', 'alt' => Html::encode($product->name)]) ?>">
                                    <div class="single-inner bg-light rounded">
                                        <?= Html::img('@web/img/product-' . $img . '.png', ['class' => 'img-fluid rounded', 'alt' => Html::encode($product->name)]) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <h4 class="fw-bold mb-3"><?= Html::encode($product->name) ?></h4>
                        <p class="mb-3">Category: <?= Html::encode($product->category ? $product->category->name : 'N/A') ?></p>
                        <h5 class="fw-bold mb-3">$<?= number_format($product->discount_price ?: $product->price, 2) ?></h5>
                        <?php if ($product->discount_price && $product->discount_price < $product->price): ?>
                            <h5 class="text-danger text-decoration-line-through mb-3">$<?= number_format($product->price, 2) ?></h5>
                        <?php endif; ?>
                        <div class="d-flex mb-4">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="fa fa-star <?= $i < 4 ? 'text-secondary' : '' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="mb-3">
                            <a href="#" class="btn btn-primary d-inline-block rounded text-white py-1 px-4 me-2"><i class="fab fa-facebook-f me-1"></i> Share</a>
                            <a href="#" class="btn btn-secondary d-inline-block rounded text-white py-1 px-4 ms-2"><i class="fab fa-twitter ms-1"></i> Share</a>
                        </div>
                        <div class="d-flex flex-column mb-3">
                            <small>Product SKU: <?= Html::encode($product->model) ?></small>
                            <small>Available: <strong class="text-primary"><?= $product->stock ?> items in stock</strong></small>
                        </div>
                        <p class="mb-4"><?= Html::encode($product->description ?: 'The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.') ?></p>
                        <p class="mb-4"><?= Html::encode($product->description ? '' : 'Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish') ?></p>
                        <div class="input-group quantity mb-5" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control form-control-sm text-center border-0" value="1" readonly>
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4 text-primary add-to-cart" data-id="<?= $product->id ?>"><i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart</a>
                    </div>
                    <div class="col-lg-12">
                        <nav>
                            <div class="nav nav-tabs mb-3">
                                <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Description</button>
                                <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Reviews</button>
                            </div>
                        </nav>
                        <div class="tab-content mb-5">
                            <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <p><?= Html::encode($product->description ?: 'Our new HPB12 / A12 battery is rated at 2000mAh and designed to power up Black and Decker / FireStorm line of 12V tools allowing users to run multiple devices off the same battery pack.') ?></p>
                                <b class="fw-bold">Black & Decker Drills and Drivers:</b>
                                <p class="small">BD12PSK, BDG1200K, BDGL12K, BDID1202, CD1200SK, CD12SFK, CDC1200K, CDC120AK, CDC120ASB, CP122K, CP122KB, CP12K, CP12KB, EPC12, EPC126, EPC126BK, EPC12CA, EPC12CABK, HP122K, HP122KD, HP126F2B, HP126F2K, HP126F3B, HP126F3K, HP126FBH, HP126FSC, HP126FSH, HP126K, HP128F3B, HP12K, HP12KD, HPD1200, HPD1202, HPD1202KF, HPD12K-2, PS122K, PS122KB, PS12HAK, SS12, SX3000, SX3500, XD1200, XD1200K, XTC121</p>
                                <b class="fw-bold">Black & Decker Impact Wrenches:</b>
                                <p class="small">SX5000, XTC12IK, XTC12IKH</p>
                                <b class="fw-bold">Black & Decker Multi-Tools:</b>
                                <p class="small">KC2000FK</p>
                                <b class="fw-bold">Black & Decker Nailers:</b>
                                <p class="small">BDBN1202</p>
                                <b class="fw-bold">Black & Decker Screwdrivers:</b>
                                <p class="small">HP9019K</p>
                                <b class="fw-bold mb-0">Best replacement for the following Black and Decker OEM battery part numbers:</b>
                                <p class="small">HPB12, A12, A12EX, A12-XJ, A1712, B-8315, BD1204L, BD-1204L, BPT1047, FS120B, FS120BX, FSB12.</p>
                            </div>
                            <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                <div class="d-flex">
                                    <?= Html::img('@web/img/avatar.jpg', ['class' => 'img-fluid rounded-circle p-3', 'style' => 'width: 100px; height: 100px;', 'alt' => '']) ?>
                                    <div>
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Jason Smith</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <?= Html::img('@web/img/avatar.jpg', ['class' => 'img-fluid rounded-circle p-3', 'style' => 'width: 100px; height: 100px;', 'alt' => '']) ?>
                                    <div>
                                        <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                        <div class="d-flex justify-content-between">
                                            <h5>Sam Peters</h5>
                                            <div class="d-flex mb-3">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="text" class="form-control border-0 me-4" placeholder="Your Name *">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="border-bottom rounded">
                                    <input type="email" class="form-control border-0" placeholder="Your Email *">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="border-bottom rounded my-4">
                                    <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-between py-3 mb-5">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Please rate:</p>
                                        <div class="d-flex align-items-center" style="font-size: 12px;">
                                            <i class="fa fa-star text-muted"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary border border-secondary text-primary rounded-pill px-4 py-3">Post Comment</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Products End -->
    <!-- Related Product Start -->
    <div class="container-fluid related-product">
        <div class="container">
            <div class="mx-auto text-center pb-5" style="max-width: 700px;">
                <h4 class="text-primary mb-4 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius wow fadeInUp" data-wow-delay="0.1s">Related Products</h4>
                <p class="wow fadeInUp" data-wow-delay="0.2s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, asperiores ducimus sint quos tempore officia similique quia? Libero, pariatur consectetur?</p>
            </div>
            <div class="related-carousel owl-carousel pt-4">
                <?php foreach ($relatedProducts as $related): ?>
                    <div class="related-item rounded">
                        <div class="related-item-inner border rounded">
                            <div class="related-item-inner-item">
                                <?= Html::img('@web/img/product-' . $related->id . '.png', ['class' => 'img-fluid w-100 rounded-top', 'alt' => Html::encode($related->name)]) ?>
                                <div class="related-new">New</div>
                                <div class="related-details">
                                    <a href="<?= Url::to(['site/single', 'id' => $related->id]) ?>"><i class="fa fa-eye fa-1x"></i></a>
                                </div>
                            </div>
                            <div class="text-center rounded-bottom p-4">
                                <a href="#" class="d-block mb-2"><?= Html::encode($related->category ? $related->category->name : 'N/A') ?></a>
                                <a href="<?= Url::to(['site/single', 'id' => $related->id]) ?>" class="d-block h4"><?= Html::encode($related->name) ?> <br> <?= Html::encode($related->model) ?></a>
                                <?php if ($related->discount_price && $related->discount_price < $related->price): ?>
                                    <del class="me-2 fs-5">$<?= number_format($related->price, 2) ?></del>
                                    <span class="text-primary fs-5">$<?= number_format($related->discount_price, 2) ?></span>
                                <?php else: ?>
                                    <span class="text-primary fs-5">$<?= number_format($related->price, 2) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="related-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                            <a href="#" class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4 add-to-cart" data-id="<?= $related->id ?>"><i class="fas fa-shopping-cart me-2"></i> Add To Cart</a>
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
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Related Product End -->