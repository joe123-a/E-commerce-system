<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Edit Product: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Manage Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-edit container py-4">

    <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data', 'class' => 'row g-3'],
    ]); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'discount_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'stock_quantity')->textInput(['type' => 'number']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'is_new')->checkbox() ?>
        <?= $form->field($model, 'is_featured')->checkbox() ?>
        <?= $form->field($model, 'is_top_selling')->checkbox() ?>
    </div>

    <div class="col-md-6">
        <?php if ($model->image_path): ?>
            <div class="mb-2">
                <?= Html::img('@web/' . $model->image_path, ['class' => 'img-fluid rounded', 'style' => 'max-width:150px;']) ?>
            </div>
        <?php endif; ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>
    </div>

    <div class="col-12 mt-3">
        <?= Html::submitButton('Update Product', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary ms-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
