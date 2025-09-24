<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Categories */

$this->title = 'Category: ' . Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                <div class="d-flex flex-wrap gap-2">
                    <?= Html::a('Back to Categories', ['index'], ['class' => 'btn btn-light btn-sm mt-2 mt-md-0']) ?>
                    <?= Html::a('Edit Category', ['edit', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm mt-2 mt-md-0']) ?>
                    <?= Html::a('Delete Category', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm mt-2 mt-md-0',
                        'data-confirm' => 'Are you sure you want to delete this category?',
                        'data-method' => 'post',
                    ]) ?>
                </div>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'slug',
                        [
                            'label' => 'Product Count',
                            'value' => $model->getProductCount(),
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                    'options' => ['class' => 'table table-bordered table-striped'],
                ]) ?>
            </div>
        </div>
    </div>
</div>