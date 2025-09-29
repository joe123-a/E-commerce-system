<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use app\models\OrderForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrderForm */
/* @var $cartItems app\models\Cart[] */

$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item->quantity * $item->product->price;
}

$shippingOptions = [
    'free' => ['name' => 'Free Shipping', 'cost' => 0.00],
    'flat' => ['name' => 'Flat Rate', 'cost' => 15.00],
    'pickup' => ['name' => 'Local Pickup', 'cost' => 8.00],
];

$selectedShipping = Yii::$app->request->post('OrderForm')['shipping'] ?? 'free';
$total = $subtotal + $shippingOptions[$selectedShipping]['cost'];
?>

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout Page</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= Url::to(['site/index']) ?>">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>

<div class="container py-5">
    <?php $form = ActiveForm::begin([
        'id' => 'checkout-form',
        'options' => ['class' => 'row g-5'],
    ]); ?>

    <!-- Billing Details -->
    <div class="col-md-6">
        <h3>Billing Details</h3>
        <?= $form->field($model, 'first_name')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'last_name')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'company_name')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'address')->textInput(['class' => 'form-control', 'placeholder' => 'House Number Street Name']) ?>
        <?= $form->field($model, 'city')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'country')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'postcode')->textInput(['class' => 'form-control']) ?>
        <?= $form->field($model, 'mobile')->textInput(['class' => 'form-control', 'type' => 'tel']) ?>
        <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'type' => 'email']) ?>
        <?= $form->field($model, 'create_account')->checkbox(['value' => 1, 'uncheck' => null]) ?>
        <?= $form->field($model, 'ship_different_address')->checkbox(['value' => 1, 'uncheck' => null]) ?>
        <?= $form->field($model, 'notes')->textarea(['rows' => 5, 'placeholder' => 'Order Notes (Optional)']) ?>
    </div>

    <!-- Order Summary -->
    <div class="col-md-6">
        <h3>Your Order</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= Html::encode($item->product->name) ?></td>
                        <td><?= Html::encode($item->product->model) ?></td>
                        <td>$<?= number_format($item->product->price, 2) ?></td>
                        <td><?= $item->quantity ?></td>
                        <td>$<?= number_format($item->quantity * $item->product->price, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end">Subtotal</td>
                    <td>$<?= number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">Shipping</td>
                    <td>
                        <?php foreach ($shippingOptions as $key => $option): ?>
                            <div>
                                <?= $form->field($model, 'shipping')->radio([
                                    'value' => $key,
                                    'id' => 'shipping-' . $key,
                                    'uncheck' => null
                                ])->label($option['name'] . ($option['cost'] > 0 ? ': $' . number_format($option['cost'], 2) : '')) ?>
                            </div>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Method -->
        <h4>Payment Method</h4>
        <?= $form->field($model, 'payment_method')->radioList([
            'bank_transfer' => 'Direct Bank Transfer',
            'check' => 'Check Payments',
            'cod' => 'Cash On Delivery',
            'paypal' => 'Paypal',
        ]) ?>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary w-100">Place Order</button>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
