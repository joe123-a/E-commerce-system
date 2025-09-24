<?php
namespace app\controllers;

use Yii;
use app\models\Categories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Categories::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category created successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id)
    {
        $model = Categories::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Category not found.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category updated successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Categories::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Category not found.');
        }

        if ($model->getProducts()->count() > 0) {
            Yii::$app->session->setFlash('error', 'Cannot delete category with associated products.');
            return $this->redirect(['index']);
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Category deleted successfully.');
        return $this->redirect(['index']);
    }

    public function actionView($id)
    {
        $model = Categories::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Category not found.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}