<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Cart Page';

// JavaScript for quantity updates
$this->registerJs(<<<JS
$(document).ready(function() {
    $('.btn-plus, .btn-minus').on('click', function() {
        var productId = $(this).data('id');
        var input = $(this).closest('.input-group').find('input');
        var quantity = parseInt(input.val());

        if ($(this).hasClass('btn-plus')) {
            quantity += 1;
        } else if (quantity > 1) {
            quantity -= 1;
        }

        input.val(quantity);

        // Update total for the row
        var price = parseFloat($(this).closest('tr').find('td.price p').text().replace('$', ''));
        $(this).closest('tr').find('td.total p').text((price * quantity).toFixed(2) + ' $');

        // Update cart totals
        var subtotal = 0;
        $('table tbody tr').each(function() {
            var total = parseFloat($(this).find('td.total p').text().replace('$', ''));
            subtotal += total;
        });
        $('.subtotal p').text('$' + subtotal.toFixed(2));
        var shipping = parseFloat($('.shipping p').data('shipping'));
        $('.total p').text('$' + (subtotal + shipping).toFixed(2));

        // Send AJAX request to update quantity on server
        $.post('<?= Url::to(['cart/update-quantity']) ?>', {
            productId: productId,
            quantity: quantity
        });
    });
});
JS
);
?>
<!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Cart Page</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart Page</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

<div class="container py-5">
    <h1 class="text-center mb-5"><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($cartItems)): ?>
                <tr>
                    <td colspan="6" class="text-center py-4">Your cart is empty.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
    <tr>
        <td><?= Html::encode($item->product->name) ?></td>
        <td><?= Html::encode($item->product->model) ?></td>
        <td class="price"><p class="mb-0"><?= number_format($item->product->price, 2) ?> $</p></td>
        <td>
            <div class="input-group quantity" style="width: 100px;">
                <button class="btn btn-sm btn-minus" data-id="<?= $item->id ?>">-</button>
                <input type="text" class="form-control text-center" value="<?= $item->quantity ?>">
                <button class="btn btn-sm btn-plus" data-id="<?= $item->id ?>">+</button>
            </div>
        </td>
        <td class="total"><p class="mb-0"><?= number_format($item->quantity * $item->product->price, 2) ?> $</p></td>
        <td>
            <a href="<?= Url::to(['cart/remove', 'id' => $item->id]) ?>" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
        </td>
    </tr>
<?php endforeach; ?>

            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($cartItems)): ?>
        <div class="row justify-content-end mt-4">
            <div class="col-md-4">
                <div class="p-4 border rounded">
                    <div class="d-flex justify-content-between subtotal">
                        <strong>Subtotal:</strong>
                        <p>$<?= number_format($subtotal, 2) ?></p>
                    </div>
                    <div class="d-flex justify-content-between shipping">
                        <strong>Shipping:</strong>
                        <p data-shipping="<?= $shipping ?>"><?= number_format($shipping, 2) ?> $</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between total">
                        <strong>Total:</strong>
                        <p>$<?= number_format($total, 2) ?></p>
                    </div>
                    <a href="<?= Url::to(['cart/checkout']) ?>" class="btn btn-primary btn-block mt-3">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
