<?php
use yii\helpers\Url;
?>
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">
        <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h4 class="text-white">Address</h4>
                        <p class="mb-2">123 Street New York.USA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                        <i class="fas fa-envelope fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h4 class="text-white">Mail Us</h4>
                        <p class="mb-2">info@example.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h4 class="text-white">Telephone</h4>
                        <p class="mb-2">(+012) 3456 7890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="rounded p-4">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px;">
                        <i class="fab fa-firefox-browser fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h4 class="text-white">Yoursite@ex.com</h4>
                        <p class="mb-2">(+012) 3456 7890</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <div class="footer-item">
                        <h4 class="text-primary mb-4">Newsletter</h4>
                        <p class="mb-3">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit.</p>
                        <div class="position-relative mx-auto rounded-pill">
                            <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                            <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Customer Service</h4>
                    <a href="<?= Url::to(['site/contact']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Contact Us</a>
                    <a href="<?= Url::to(['customer/returns']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Returns</a>
                    <a href="<?= Url::to(['customer/order-history']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Order History</a>
                    <a href="<?= Url::to(['site/sitemap']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Site Map</a>
                    <a href="<?= Url::to(['site/testimonials']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Testimonials</a>
                    <a href="<?= Url::to(['customer/account']) ?>" class=""><i class="fas fa-angle-right me-2"></i>My Account</a>
                    <a href="<?= Url::to(['customer/unsubscribe']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Unsubscribe Notification</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Information</h4>
                    <a href="<?= Url::to(['site/about']) ?>" class=""><i class="fas fa-angle-right me-2"></i>About Us</a>
                    <a href="<?= Url::to(['site/delivery']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Delivery infomation</a>
                    <a href="<?= Url::to(['site/privacy']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Privacy Policy</a>
                    <a href="<?= Url::to(['site/terms']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Terms & Conditions</a>
                    <a href="<?= Url::to(['site/warranty']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Warranty</a>
                    <a href="<?= Url::to(['site/faq']) ?>" class=""><i class="fas fa-angle-right me-2"></i>FAQ</a>
                    <a href="<?= Url::to(['seller/login']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Seller Login</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item d-flex flex-column">
                    <h4 class="text-primary mb-4">Extras</h4>
                    <a href="<?= Url::to(['site/brands']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Brands</a>
                    <a href="<?= Url::to(['site/gift-vouchers']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Gift Vouchers</a>
                    <a href="<?= Url::to(['site/affiliates']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Affiliates</a>
                    <a href="<?= Url::to(['customer/wishlist']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Wishlist</a>
                    <a href="<?= Url::to(['customer/order-history']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Order History</a>
                    <a href="<?= Url::to(['customer/track-order']) ?>" class=""><i class="fas fa-angle-right me-2"></i>Track Your Order</a>
                </div>
            </div>
        </div>
    </div>
</div>