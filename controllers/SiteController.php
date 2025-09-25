<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use app\models\Categories;
use yii\data\ActiveDataProvider;

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
    
    public function actionCheckout(){
        return $this->render('checkout');
    }
    public function actionShop()
{
    $query = Products::find()->with('category');
    $categoryId = Yii::$app->request->get('category_id');
    $sort = Yii::$app->request->get('sort', 'default');
    $price = (float) Yii::$app->request->get('price', 500);

    if ($categoryId) {
        $query->andWhere(['category_id' => $categoryId]);
    }
    if ($price < 500) {
        $query->andWhere(['<=', 'discount_price', $price])->orWhere(['<=', 'price', $price]);
    }

    switch ($sort) {
        case 'popularity':
            $query->orderBy(['is_top_selling' => SORT_DESC]);
            break;
        case 'newness':
            $query->orderBy(['is_new' => SORT_DESC]);
            break;
        case 'low-to-high':
            $query->orderBy(['price' => SORT_ASC]);
            break;
        case 'high-to-low':
            $query->orderBy(['price' => SORT_DESC]);
            break;
        default:
            $query->orderBy(['id' => SORT_ASC]);
    }

    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 9,
        ],
    ]);

    return $this->render('shop', [
        'dataProvider' => $dataProvider,
    ]);
}
    public function actionSingle($id)
    {
        $product = Products::find()->with('category')->where(['id' => $id])->one();
        if (!$product) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $this->render('single', [
            'model' => $product,
        ]);
    }
    public function action404(){
        return $this->render('404');
    }
    public function actionBestseller(){
        return $this->render('bestseller');
    }
    public function actionProduct($id)
    {
        $model = Products::find()->with('category')->where(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $this->render('product', [
            'model' => $model,
        ]);
    }

       public function actionCategory($id = null)
    {
        if ($id === null) {
            // If no category ID is provided, show all categories
            $categories = Categories::find()->all();
            return $this->render('categories', [
                'categories' => $categories,
            ]);
        }

        $category = Categories::findOne($id);
        if (!$category) {
            throw new NotFoundHttpException('Category not found.');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->with('category')->where(['category_id' => $id]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }
    

}




           





  



  
 


   


    