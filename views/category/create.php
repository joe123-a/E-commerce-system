<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Add New Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                <?= Html::a('Back to Categories', ['index'], ['class' => 'btn btn-light btn-sm mt-2 mt-md-0']) ?>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'category-form',
                    'fieldConfig' => [
                        'errorOptions' => ['class' => 'text-danger small mt-1'],
                    ],
                ]); ?>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter category name']) ?>
                    </div>
                    <div class="col-12 col-md-6">
                        <?= $form->field($model, 'slug')->textInput(['placeholder' => 'Enter slug (e.g., electronics)']) ?>
                    </div>
                </div>

                <div class="mt-4 d-flex flex-wrap gap-2">
                    <?= Html::submitButton('Add Category', ['class' => 'btn btn-primary me-2 mb-2']) ?>
                    <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary mb-2']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>