<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use app\models\OrderForm;

// Fetch cart from session
$session = Yii::$app->session;
$cartItems = $session->get('cart', []);
$subtotal = 0.00;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shippingOptions = [
    'free' => ['name' => 'Free Shipping', 'cost' => 0.00],
    'flat' => ['name' => 'Flat Rate', 'cost' => 15.00],
    'pickup' => ['name' => 'Local Pickup', 'cost' => 8.00],
];
$selectedShipping = Yii::$app->request->post('Shipping', 'free');
$total = $subtotal + $shippingOptions[$selectedShipping]['cost'];

// Initialize form model for display
$model = new OrderForm();
?>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Checkout Page</h1>
    <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
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
                        <p class="mb-0">Recieve gift all over oder $50</p>
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

<!-- Checkout Page Start -->
<div class="container-fluid bg-light overflow-hidden py-5">
    <div class="container py-5">
        <h1 class="mb-4 wow fadeInUp" data-wow-delay="0.1s">Billing Details</h1>
        <?php $form = ActiveForm::begin([
            'id' => 'checkout-form',
            'options' => ['class' => 'row g-5'],
        ]); ?>
            <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="form-item w-100">
                            <?= $form->field($model, 'first_name')->textInput(['class' => 'form-control'])->label('First Name <sup>*</sup>') ?>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="form-item w-100">
                            <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control'])->label('Last Name <sup>*</sup>') ?>
                        </div>
                    </div>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'company_name')->textInput(['class' => 'form-control'])->label('Company Name <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'address')->textInput(['class' => 'form-control', 'placeholder' => 'House Number Street Name'])->label('Address <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'city')->textInput(['class' => 'form-control'])->label('Town/City <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'country')->textInput(['class' => 'form-control'])->label('Country <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'postcode')->textInput(['class' => 'form-control'])->label('Postcode/Zip <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control', 'type' => 'tel'])->label('Mobile <sup>*</sup>') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'type' => 'email'])->label('Email Address <sup>*</sup>') ?>
                </div>
                <div class="form-check my-3">
                    <?= $form->field($model, 'create_account')->checkbox(['class' => 'form-check-input', 'value' => 1, 'uncheck' => null])->label('Create an account?') ?>
                </div>
                <hr>
                <div class="form-check my-3">
                    <?= $form->field($model, 'ship_different_address')->checkbox(['class' => 'form-check-input', 'value' => 1, 'uncheck' => null])->label('Ship to a different address?') ?>
                </div>
                <div class="form-item">
                    <?= $form->field($model, 'notes')->textarea(['class' => 'form-control', 'spellcheck' => 'false', 'rows' => 11, 'placeholder' => 'Order Notes (Optional)'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col" class="text-start">Name</th>
                                <th scope="col">Model</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($cartItems)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">Your cart is empty.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($cartItems as $item): ?>
                                    <tr class="text-center">
                                        <th scope="row" class="text-start py-4">
                                            <?= Html::encode($item['name']) ?>
                                        </th>
                                        <td class="py-4"><?= Html::encode($item['model']) ?></td>
                                        <td class="py-4">$<?= number_format($item['price'], 2) ?></td>
                                        <td class="py-4 text-center"><?= $item['quantity'] ?></td>
                                        <td class="py-4">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <tr>
                                <th scope="row"></th>
                                <td class="py-4"></td>
                                <td class="py-4"></td>
                                <td class="py-4">
                                    <p class="mb-0 text-dark py-2">Subtotal</p>
                                </td>
                                <td class="py-4">
                                    <div class="py-2 text-center border-bottom border-top">
                                        <p class="mb-0 text-dark">$<?= number_format($subtotal, 2) ?></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="py-4">
                                    <p class="mb-0 text-dark py-4">Shipping</p>
                                </td>
                                <td colspan="3" class="py-4">
                                    <?php foreach ($shippingOptions as $key => $option): ?>
                                        <div class="form-check text-start">
                                            <?= $form->field($model, 'shipping')->radio([
                                                'class' => 'form-check-input bg-primary border-0',
                                                'value' => $key,
                                                'id' => 'Shipping-' . $key,
                                                'uncheck' => null,
                                            ])->label($option['name'] . ($option['cost'] > 0 ? ': $' . number_format($option['cost'], 2) : '')) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td class="py-4">
                                    <p class="mb-0 text-dark text-uppercase py-2">TOTAL</p>
                                </td>
                                <td class="py-4"></td>
                                <td class="py-4"></td>
                                <td class="py-4">
                                    <div class="py-2 text-center border-bottom border-top">
                                        <p class="mb-0 text-dark">$<?= number_format($total, 2) ?></p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row g-0 text-center align-items-center justify-content-center border-bottom py-2">
                    <div class="col-12">
                        <div class="form-check text-start my-2">
                            <?= $form->field($model, 'payment_method')->radio([
                                'class' => 'form-check-input bg-primary border-0',
                                'value' => 'bank_transfer',
                                'id' => 'Transfer-1',
                                'uncheck' => null,
                            ])->label('Direct Bank Transfer') ?>
                        </div>
                        <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                    </div>
                </div>
                <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                    <div class="col-12">
                        <div class="form-check text-start my-2">
                            <?= $form->field($model, 'payment_method')->radio([
                                'class' => 'form-check-input bg-primary border-0',
                                'value' => 'check',
                                'id' => 'Payments-1',
                                'uncheck' => null,
                            ])->label('Check Payments') ?>
                        </div>
                    </div>
                </div>
                <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                    <div class="col-12">
                        <div class="form-check text-start my-2">
                            <?= $form->field($model, 'payment_method')->radio([
                                'class' => 'form-check-input bg-primary border-0',
                                'value' => 'cod',
                                'id' => 'Delivery-1',
                                'uncheck' => null,
                            ])->label('Cash On Delivery') ?>
                        </div>
                    </div>
                </div>
                <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-2">
                    <div class="col-12">
                        <div class="form-check text-start my-2">
                            <?= $form->field($model, 'payment_method')->radio([
                                'class' => 'form-check-input bg-primary border-0',
                                'value' => 'paypal',
                                'id' => 'Paypal-1',
                                'uncheck' => null,
                            ])->label('Paypal') ?>
                        </div>
                    </div>
                </div>
                <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                    <button type="button" class="btn btn-primary border-secondary py-3 px-4 text-uppercase w-100 text-primary" disabled>Place Order</button>
                </div>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<!-- Checkout Page End -->