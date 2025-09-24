<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Product: ' . Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                <div class="d-flex flex-wrap gap-2">
                    <?= Html::a('Back to Products', ['index'], ['class' => 'btn btn-light btn-sm mt-2 mt-md-0']) ?>
                    <?= Html::a('Edit Product', ['edit', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm mt-2 mt-md-0']) ?>
                    <?= Html::a('Delete Product', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm mt-2 mt-md-0',
                        'data-confirm' => 'Are you sure you want to delete this product?',
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
                        'model',
                        [
                            'attribute' => 'category_id',
                            'label' => 'Category',
                            'value' => $model->category ? Html::encode($model->category->name) : 'N/A',
                        ],
                        'price:currency',
                        'discount_price:currency',
                        'stock_quantity',
                        [
                            'attribute' => 'rating',
                            'value' => $model->rating ? number_format($model->rating, 1) . ' ★' : 'N/A',
                        ],
                        [
                            'attribute' => 'is_new',
                            'value' => $model->is_new ? 'Yes' : 'No',
                        ],
                        [
                            'attribute' => 'is_sale',
                            'value' => $model->is_sale ? 'Yes' : 'No',
                        ],
                        [
                            'attribute' => 'is_featured',
                            'value' => $model->is_featured ? 'Yes' : 'No',
                        ],
                        [
                            'attribute' => 'is_top_selling',
                            'value' => $model->is_top_selling ? 'Yes' : 'No',
                        ],
                        [
                            'attribute' => 'image_path',
                            'format' => 'raw',
                            'value' => $model->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $model->image_path)
                                ? Html::img(Yii::getAlias('@web') . '/' . $model->image_path, ['class' => 'img-fluid rounded', 'style' => 'max-width:150px;'])
                                : 'No Image',
                        ],
                        'description:ntext',
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                    'options' => ['class' => 'table table-bordered table-striped'],
                ]) ?>
            </div>
        </div>
    </div>
</div>