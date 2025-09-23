<?php
namespace app\controllers;

use app\models\Products;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class ProductsController extends Controller
{
    /**
     * Displays the product index page with all products.
     * @return string
     */
    public function actionIndex()
{
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => Products::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}

    /**
     * Displays the form for adding a new product and handles form submission.
     * @return string|\yii\web\Response
     */
 public function actionCreate()
{
    $model = new Products();

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->validate()) {
            // Handle file upload only after successful validation
            if ($model->imageFile) {
                $filePath = 'uploads/' . uniqid('product_') . '.' . $model->imageFile->extension;
                $fullPath = Yii::getAlias('@webroot/') . $filePath;

                if ($model->imageFile->saveAs($fullPath)) {
                    $model->image_path = $filePath;
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to upload image.');
                }
            }

            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save(false)) { // false = skip re-validation
                Yii::$app->session->setFlash('success', 'Product added successfully.');
                return $this->redirect(['index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Validation failed.');
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    /**
     * Displays a single product view (placeholder for future implementation).
     * @return string
     */
    public function actionView($id = null)
    {
        $model = Products::findOne($id);
        if ($model === null) {
            throw new \yii\web\NotFoundHttpException('Product not found.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
    public function actionToggleFlag($id, $field)
{
    $allowed = ['is_new', 'is_featured', 'is_top_selling'];
    if (!in_array($field, $allowed)) {
        throw new \yii\web\BadRequestHttpException("Invalid field.");
    }

    $model = Products::findOne($id);
    if ($model === null) {
        throw new \yii\web\NotFoundHttpException("Product not found.");
    }

    $model->$field = !$model->$field;
    $model->save(false);

    Yii::$app->session->setFlash('success', ucfirst($field) . ' updated.');
    return $this->redirect(['index']);
}
public function actionEdit($id)
{
    $model = Products::findOne($id); // Find the product by ID

    if (!$model) {
        throw new \yii\web\NotFoundHttpException('Product not found.');
    }

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->validate()) {
            // Handle file upload if a new file was selected
            if ($model->imageFile) {
                $filePath = 'uploads/' . uniqid('product_') . '.' . $model->imageFile->extension;
                $fullPath = Yii::getAlias('@webroot/') . $filePath;

                if ($model->imageFile->saveAs($fullPath)) {
                    $model->image_path = $filePath;
                }
            }

            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Product updated successfully.');
                return $this->redirect(['index']);
            }
        }
    }

    return $this->render('edit', [
        'model' => $model, // Pass the model to the view
    ]);
}


}