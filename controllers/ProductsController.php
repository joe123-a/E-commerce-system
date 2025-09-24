<?php
namespace app\controllers;

use app\models\Products;
use app\models\Categories;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->with('category'),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Products::find()->with('category')->where(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->validate()) {
                if ($model->imageFile) {
                    $fileName = uniqid('product_') . '.' . $model->imageFile->extension;
                    $filePath = 'uploads/' . $fileName;
                    $fullPath = Yii::getAlias('@webroot') . '/' . $filePath;

                    $uploadDir = Yii::getAlias('@webroot/uploads/');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    if ($model->imageFile->saveAs($fullPath)) {
                        $model->image_path = $filePath;
                        Yii::info("Image saved to $fullPath", __METHOD__);
                    } else {
                        Yii::error("Failed to save image to $fullPath", __METHOD__);
                        Yii::$app->session->setFlash('error', 'Failed to save image.');
                    }
                }

                $model->created_at = date('Y-m-d H:i:s');
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Product created successfully.');
                    return $this->redirect(['index']);
                } else {
                    Yii::error("Failed to save product: " . print_r($model->errors, true), __METHOD__);
                    Yii::$app->session->setFlash('error', 'Failed to create product.');
                }
            }
        }

        $categories = ArrayHelper::map(Categories::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    public function actionEdit($id)
    {
        $model = Products::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->validate()) {
                if ($model->imageFile) {
                    $fileName = uniqid('product_') . '.' . $model->imageFile->extension;
                    $filePath = 'uploads/' . $fileName;
                    $fullPath = Yii::getAlias('@webroot') . '/' . $filePath;

                    $uploadDir = Yii::getAlias('@webroot/uploads/');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    if ($model->imageFile->saveAs($fullPath)) {
                        if ($model->getOldAttribute('image_path') && file_exists(Yii::getAlias('@webroot') . '/' . $model->getOldAttribute('image_path'))) {
                            unlink(Yii::getAlias('@webroot') . '/' . $model->getOldAttribute('image_path'));
                        }
                        $model->image_path = $filePath;
                        Yii::info("Image saved to $fullPath", __METHOD__);
                    } else {
                        Yii::error("Failed to save image to $fullPath", __METHOD__);
                        Yii::$app->session->setFlash('error', 'Failed to save image.');
                    }
                }

                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Product updated successfully.');
                    return $this->redirect(['index']);
                } else {
                    Yii::error("Failed to save product ID {$model->id}: " . print_r($model->errors, true), __METHOD__);
                    Yii::$app->session->setFlash('error', 'Failed to update product: ' . print_r($model->errors, true));
                }
            } else {
                Yii::error("Validation failed for product ID {$model->id}: " . print_r($model->errors, true), __METHOD__);
                Yii::$app->session->setFlash('error', 'Validation failed: ' . print_r($model->errors, true));
            }
        }

        $categories = ArrayHelper::map(Categories::find()->all(), 'id', 'name');

        return $this->render('edit', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Products::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        if ($model->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $model->image_path)) {
            unlink(Yii::getAlias('@webroot') . '/' . $model->image_path);
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Product deleted successfully.');
        return $this->redirect(['index']);
    }
}