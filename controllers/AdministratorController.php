<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\LoginForm;

class AdministratorController extends Controller
{
    public $layout = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['dashboard', 'logout'], // actions to protect
                'rules' => [
                    [
                        'actions' => ['dashboard', 'logout'],
                        'allow' => true,
                        'roles' => ['@'], // only logged-in users
                        'matchCallback' => function ($rule, $action) {
                            // Only allow admins
                            return Yii::$app->user->identity->role === 'admin';
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    // Redirect guests to login page
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
}
