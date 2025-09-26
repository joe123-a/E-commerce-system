<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\User;

class AdministratorController extends Controller
{
    public $layout = false;

public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['dashboard', 'logout'], // protect only these actions
            'rules' => [
                [
                    'actions' => ['dashboard', 'logout'],
                    'allow' => true,
                    'roles' => ['@'], // only logged-in users
                    'matchCallback' => function ($rule, $action) {
                        // Only allow admins
                        return Yii::$app->user->identity->role === 'admin';
                    },
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                // Redirect to login page if not admin or guest
                return $this->redirect(['administrator/index']);
            },
        ],
    ];
}

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['administrator/dashboard']);
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (Yii::$app->user->identity->role !== 'admin') {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('error', 'Access denied.');
                return $this->redirect(['administrator/index']);
            }
            return $this->redirect(['administrator/dashboard']);
        }

        return $this->render('index', ['model' => $model]);
    }

    public function actionDashboard()
    {
        $this->layout = 'main';
        return $this->render('dashboard');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['administrator/index']);
    }

    public function actionSignup()
    {
        $model = new User(['scenario' => 'register']);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Registration successful! Please log in.');
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to register. Please try again.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}




    /**
     * Customer login action.
     * @return string
     */
    // public function actionLogin()
    // {
    //     if (!Yii::$app->user->isGuest) {
    //         return $this->redirect(['dashboard']);
    //     }

    //     $model = new User(['scenario' => 'login']);
    //     if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    //         $user = User::findByUsername($model->username);
    //         if ($user && $user->validatePassword($model->password)) {
    //             Yii::$app->user->login($user);
    //             return $this->redirect(['dashboard']);
    //         } else {
    //             Yii::$app->session->setFlash('error', 'Invalid username or password.');
    //         }
    //     }

    //     return $this->render('login', [
    //         'model' => $model,
    //     ]);
    // }

