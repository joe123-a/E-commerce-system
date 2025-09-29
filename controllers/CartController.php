<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Products;
use app\models\OrderForm;
use app\models\Cart;
use yii\web\Response;


class CartController extends Controller
{
    public $layout = 'customer';

    /**
     * Add a product to the cart.
     */
    public function actionAdd($id)
{
    if (Yii::$app->user->isGuest) {
        Yii::$app->session->setFlash('error', 'You need to login first.');
        return $this->redirect(['site/login']);
    }

    $userId = Yii::$app->user->id;
    $product = Products::findOne($id);

    if (!$product) {
        Yii::$app->session->setFlash('error', 'Product not found.');
        return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
    }

    // Check if item already in cart
    $cartItem = Cart::find()->where([
        'user_id' => $userId,
        'product_id' => $product->id
    ])->one();

    if ($cartItem) {
        $cartItem->quantity += 1; // increment quantity
        $cartItem->save();
    } else {
        $cartItem = new Cart();
        $cartItem->user_id = $userId;
        $cartItem->product_id = $product->id;
        $cartItem->quantity = 1;
        $cartItem->price = $product->discount_price && $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;
        $cartItem->save();
    }

    Yii::$app->session->setFlash('success', 'Product "' . Html::encode($product->name) . '" added to cart.');
    return $this->redirect(Yii::$app->request->referrer ?: ['site/index']);
}


    /**
     * Display the cart page.
     */
 

public function actionIndex()
{
    if (Yii::$app->user->isGuest) {
        Yii::$app->session->setFlash('error', 'Please log in to view your cart.');
        return $this->redirect(['site/login']);
    }

    $cartItems = Cart::find()
        ->where(['user_id' => Yii::$app->user->id])
        ->with('product') // load related product
        ->all();

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->quantity * $item->product->price;
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
 

    
   public function actionRemove($id)
{
    // Find the cart item for the current user
    $cartItem = Cart::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);

    if ($cartItem) {
        $cartItem->delete();  // remove from database
        Yii::$app->session->setFlash('success', 'Product removed from cart.');
    } else {
        Yii::$app->session->setFlash('error', 'Product not found in your cart.');
    }

    return $this->redirect(['index']); // back to cart page
}
    /**
     * Display the checkout page.
     */


public function actionCheckout()
{
    if (Yii::$app->user->isGuest) {
        Yii::$app->session->setFlash('error', 'Please log in to checkout.');
        return $this->redirect(['site/login']);
    }

    // Fetch cart items from DB
    $cartItems = Cart::find()
        ->where(['user_id' => Yii::$app->user->id])
        ->with('product') // Make sure your Cart model has getProduct()
        ->all();

    if (empty($cartItems)) {
        Yii::$app->session->setFlash('error', 'Your cart is empty.');
        return $this->redirect(['index']);
    }

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item->quantity * $item->product->price;
    }

    $shipping = 3.00;
    $total = $subtotal + $shipping;

    $model = new OrderForm();

    return $this->render('checkout', [
        'model' => $model,
        'cartItems' => $cartItems,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,
    ]);
}

public function actionUpdateQuantity()
{
    Yii::$app->response->format = Response::FORMAT_JSON;

    $productId = Yii::$app->request->post('productId');
    $quantity = Yii::$app->request->post('quantity');

    if (!$productId || !$quantity) {
        return ['success' => false, 'message' => 'Invalid request.'];
    }

    $cartItem = Cart::findOne(['id' => $productId, 'user_id' => Yii::$app->user->id]);
    if ($cartItem) {
        $cartItem->quantity = (int)$quantity;
        $cartItem->save();
        return ['success' => true, 'message' => 'Quantity updated.'];
    }

    return ['success' => false, 'message' => 'Item not found in cart.'];
}
}






    
    

    
