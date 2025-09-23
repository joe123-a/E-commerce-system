<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public $layout = 'customer';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        // $products = [
            // (object)[
            //     'id' => 1,
            //     'name' => 'Smartphone XYZ',
            //     'price' => 299.99,
            //     'image' => Yii::getAlias('@web/img/product-1.jpg'),
            //     'rating' => 4.5,
            // ],
            // (object)[
            //     'id' => 2,
            //     'name' => 'Laptop ABC',
            //     'price' => 799.99,
            //     'image' => Yii::getAlias('@web/img/product-2.jpg'),
            //     'rating' => 4.8,
            // ],
            // (object)[
            //     'id' => 3,
            //     'name' => 'Wireless Headphones',
            //     'price' => 99.99,
            //     'image' => Yii::getAlias('@web/img/product-3.jpg'),
            //     'rating' => 4.2,
            // ],
            // (object)[
            //     'id' => 4,
            //     'name' => 'Smart TV 4K',
            //     'price' => 499.99,
            //     'image' => Yii::getAlias('@web/img/product-4.jpg'),
            //     'rating' => 4.7,
            // ],
            // Add more products as needed
        // ];

        return $this->render('index'
            
        );
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHelp()
    {
        return $this->render('help');
    }

    public function actionSupport()
    {
        return $this->render('support');
    }
    public function actionCart(){
        return $this->render('cart');
    }
    public function actionCheckout(){
        return $this->render('checkout');
    }
    public function actionShop(){
        return $this->render('shop');
    }
    public function actionSingle(){
        return $this->render('single');
    }
    public function action404(){
        return $this->render('404');
    }
    public function actionBestseller(){
        return $this->render('bestseller');
    }
}