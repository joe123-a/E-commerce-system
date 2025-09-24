<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;

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
        // Fetch all products
        $allProducts = Products::find()->with('category')->all();

        // Fetch new arrivals (is_new = 1)
        $newArrivals = Products::find()->with('category')->where(['is_new' => 1])->all();

        // Fetch featured products (is_featured = 1)
        $featuredProducts = Products::find()->with('category')->where(['is_featured' => 1])->all();

        // Fetch top selling products (is_top_selling = 1)
        $topSellingProducts = Products::find()->with('category')->where(['is_top_selling' => 1])->all();

        return $this->render('index', [
            'allProducts' => $allProducts,
            'newArrivals' => $newArrivals,
            'featuredProducts' => $featuredProducts,
            'topSellingProducts' => $topSellingProducts,
        ]);
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
    public function actionProduct(){
        $model =new Products();
        return $this->render('product');
    }
    public function actionCategory(){
        return $this->render('category');

    }
    public function actionProductitem(){
        return $this->render('product_item');
    }
}