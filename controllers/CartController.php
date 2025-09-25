<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Products;
use app\models\OrderForm;

class CartController extends Controller
{
    public $layout = 'customer';

    /**
     * Add a product to the cart.
     */
    public function actionAdd($id)
    {
        $session = Yii::$app->session;
        if (!$session->has('cart')) {
            $session->set('cart', []);
        }

        $product = Products::findOne($id);
        if (!$product) {
            Yii::$app->session->setFlash('error', 'Product not found.');
            return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
        }

        $cart = $session->get('cart');
        $productId = $product->id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'model' => $product->model,
                'price' => $product->discount_price && $product->discount_price < $product->price
                    ? $product->discount_price
                    : $product->price,
                'quantity' => 1,
            ];
        }

        $session->set('cart', $cart);
        Yii::$app->session->setFlash('success', 'Product "' . Html::encode($product->name) . '" added to cart.');

        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }

    /**
     * Display the cart page.
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        if (!$session->has('cart')) {
            $session->set('cart', []);
        }

        $cartItems = $session->get('cart', []);
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = 3.00;
        $total = $subtotal + $shipping;

        return $this->render('index', [
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ]);
    }

    /**
     * Update quantity of a product in the cart.
     */
    public function actionUpdateQuantity()
    {
        if (Yii::$app->request->isPost) {
            $productId = Yii::$app->request->post('productId');
            $quantity = (int) Yii::$app->request->post('quantity');

            $session = Yii::$app->session;
            $cart = $session->get('cart', []);

            if (isset($cart[$productId]) && $quantity > 0) {
                $cart[$productId]['quantity'] = $quantity;
                $session->set('cart', $cart);
                return $this->asJson(['success' => true]);
            }
            return $this->asJson(['success' => false, 'message' => 'Invalid product or quantity']);
        }
        return $this->asJson(['success' => false, 'message' => 'Invalid request']);
    }

    /**
     * Remove a product from the cart.
     */
    public function actionRemove($id)
    {
        $session = Yii::$app->session;
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
            Yii::$app->session->setFlash('success', 'Product removed from cart.');
        } else {
            Yii::$app->session->setFlash('error', 'Product not found in cart.');
        }

        return $this->redirect(['index']);
    }
    /**
     * Display the checkout page.
     */
    public function actionCheckout()
    {
        $session = Yii::$app->session;
        $cartItems = $session->get('cart', []);

        if (empty($cartItems)) {
            Yii::$app->session->setFlash('error', 'Your cart is empty.');
            return $this->redirect(['index']);
        }

        $model = new OrderForm();

        return $this->render('checkout', [
            'model' => $model,
            'cartItems' => $cartItems,
        ]);
    }
}






    
    

    
