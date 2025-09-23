<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Add New Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                <?= Html::a('Back to Products', ['index'], ['class' => 'btn btn-light btn-sm mt-2 mt-md-0']) ?>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'product-form',
                    'options' => ['enctype' => 'multipart/form-data'],
                    'fieldConfig' => [
                        'errorOptions' => ['class' => 'text-danger small mt-1'],
                    ],
                ]); ?>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter product name']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'model')->textInput(['placeholder' => 'Enter model number']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'category')->textInput(['placeholder' => 'Enter category']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'stock_quantity')->textInput(['type' => 'number', 'min' => 0, 'placeholder' => 'Stock Quantity']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'price')->textInput(['type'=>'number','step'=>'0.01','placeholder'=>'Price']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'discount_price')->textInput(['type'=>'number','step'=>'0.01','placeholder'=>'Discount Price (optional)']) ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'description')->textarea(['rows'=>4,'placeholder'=>'Product description']) ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'imageFile')->fileInput() ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6 col-sm-3">
                        <?= $form->field($model, 'is_new')->checkbox(['template' => "{input} {label}\n{error}", 'labelOptions' => ['class'=>'ms-2']])->label('New Arrival') ?>
                    </div>
                    <div class="col-6 col-sm-3">
                        <?= $form->field($model, 'is_sale')->checkbox(['template' => "{input} {label}\n{error}", 'labelOptions' => ['class'=>'ms-2']])->label('On Sale') ?>
                    </div>
                    <div class="col-6 col-sm-3">
                        <?= $form->field($model, 'is_featured')->checkbox(['template' => "{input} {label}\n{error}", 'labelOptions' => ['class'=>'ms-2']])->label('Featured') ?>
                    </div>
                    <div class="col-6 col-sm-3">
                        <?= $form->field($model, 'is_top_selling')->checkbox(['template' => "{input} {label}\n{error}", 'labelOptions' => ['class'=>'ms-2']])->label('Top Selling') ?>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <?= Html::submitButton('Add Product', ['class'=>'btn btn-primary me-2 mb-2']) ?>
                    <?= Html::a('Cancel', ['index'], ['class'=>'btn btn-secondary mb-2']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
