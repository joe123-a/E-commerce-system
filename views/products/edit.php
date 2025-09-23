<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */

$this->title = $model->isNewRecord ? 'Add Product' : 'Edit Product';
$this->params['breadcrumbs'][] = ['label' => 'Manage Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card p-4 shadow-sm">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'price')->input('number', ['step' => '0.01']) ?>
        <?= $form->field($model, 'discount_price')->input('number', ['step' => '0.01']) ?>
        <?= $form->field($model, 'stock_quantity')->input('number') ?>
        <?= $form->field($model, 'is_new')->checkbox() ?>
        <?= $form->field($model, 'is_featured')->checkbox() ?>
        <?= $form->field($model, 'is_top_selling')->checkbox() ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <?php if ($model->image_path): ?>
            <div class="mb-3">
                <?= Html::img('@web/' . $model->image_path, ['style' => 'width:120px; height:120px; object-fit:cover;']) ?>
            </div>
        <?php endif; ?>

        <div class="form-group mt-3">
            <?= Html::submitButton($model->isNewRecord ? 'Add Product' : 'Update Product', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
