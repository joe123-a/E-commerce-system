<?php
use yii\helpers\Url;
use yii\helpers\Html;

// Fetch cart from session
$session = Yii::$app->session;
$cart = $session->get('cart', []);
$totalItems = 0;
$subtotal = 0.00;
foreach ($cart as $item) {
    $totalItems += $item['quantity'];
    $subtotal += $item['price'] * $item['quantity'];
}
?>

<div class="container-fluid px-5 d-none border-bottom d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-4 text-center text-lg-start mb-lg-0">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <a href="<?= Url::to(['site/help']) ?>" class="text-muted me-2">Help</a><small> / </small>
                <a href="<?= Url::to(['site/support']) ?>" class="text-muted mx-2">Support</a><small> / </small>
                <a href="<?= Url::to(['site/contact']) ?>" class="text-muted ms-2">Contact</a>
            </div>
        </div>
        <div class="col-lg-4 text-center d-flex align-items-center justify-content-center">
            <small class="text-dark">Call Us:</small>
            <a href="#" class="text-muted">(+256) 77918 0592</a>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted me-2" data-bs-toggle="dropdown"><small>USD</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item">Euro</a>
                        <a href="#" class="dropdown-item">Dolar</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted mx-2" data-bs-toggle="dropdown"><small>English</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item">English</a>
                        <a href="#" class="dropdown-item">Turkish</a>
                        <a href="#" class="dropdown-item">Spanol</a>
                        <a href="#" class="dropdown-item">Italiano</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-muted ms-2" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i>My Dashboard</small></a>
                    <div class="dropdown-menu rounded">
                        <a href="<?= Url::to(['site/login']) ?>" class="dropdown-item">Login</a>
                        <a href="<?= Url::to(['customer/wishlist']) ?>" class="dropdown-item">Wishlist</a>
                        <a href="<?= Url::to(['customer/cart']) ?>" class="dropdown-item">My Card</a>
                        <a href="<?= Url::to(['customer/notifications']) ?>" class="dropdown-item">Notifications</a>
                        <a href="<?= Url::to(['customer/settings']) ?>" class="dropdown-item">Account Settings</a>
                        <a href="<?= Url::to(['customer/account']) ?>" class="dropdown-item">My Account</a>
                        <a href="<?= Url::to(['site/logout']) ?>" class="dropdown-item">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="<?= Url::to(['site/index']) ?>" class="navbar-brand p-0">
                    <h1 class="display-5 text-primary m-0"><i class="fas fa-shopping-bag text-secondary me-2"></i>Service Cops</h1>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <div class="d-flex border rounded-pill">
                    <input class="form-control border-0 rounded-pill w-100 py-3" type="text" placeholder="Search Looking For?">
                    <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                        <option value="All Category">All Category</option>
                        <option value="Category 1">Category 1</option>
                        <option value="Category 2">Category 2</option>
                        <option value="Category 3">Category 3</option>
                        <option value="Category 4">Category 4</option>
                    </select>
                    <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                <a href="<?= Url::to(['customer/compare']) ?>" class="text-muted d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-md-square border"><i class="fas fa-random"></i></span></a>
                <a href="<?= Url::to(['customer/wishlist']) ?>" class="text-muted d-flex align-items-center justify-content-center me-3"><span class="rounded-circle btn-md-square border"><i class="fas fa-heart"></i></span></a>
                <a href="<?= Url::to(['cart/index']) ?>" class="text-muted d-flex align-items-center justify-content-center">
                    <span class="rounded-circle btn-md-square border position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <?php if ($totalItems > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                <?= $totalItems ?>
                                <span class="visually-hidden">items in cart</span>
                            </span>
                        <?php endif; ?>
                    </span>
                    <span class="text-dark ms-2">$<?= number_format($subtotal, 2) ?></span>
                </a>
            </div>
        </div>
    </div>
</div>