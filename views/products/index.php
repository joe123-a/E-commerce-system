<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="products-admin">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('➕ Add Product', ['create'], ['class' => 'btn btn-success mb-3']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-striped table-hover align-middle'],
            'layout' => "{summary}\n{items}\n{pager}", // keeps summary + pager responsive
            'columns' => [
                'id',
                [
                    'attribute' => 'image_path',
                    'format' => 'html',
                    'value' => fn($model) =>
                        $model->image_path
                            ? Html::img('@web/' . $model->image_path, ['class' => 'img-fluid rounded', 'style' => 'width:60px; height:60px; object-fit:cover;'])
                            : '(No Image)',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-truncate', 'style' => 'max-width:120px;'],
                ],
                [
                    'attribute' => 'model',
                    'contentOptions' => ['class' => 'text-truncate', 'style' => 'max-width:100px;'],
                ],
                'category',
                [
                    'attribute' => 'price',
                    'format' => ['currency'],
                ],
                [
                    'attribute' => 'discount_price',
                    'format' => ['currency'],
                ],
                [
                    'attribute' => 'stock_quantity',
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_new',
                    'format' => 'raw',
                    'value' => fn($model) =>
                        Html::tag('span', $model->is_new ? '✅ New' : '❌ No', [
                            'class' => 'badge ' . ($model->is_new ? 'bg-success' : 'bg-secondary')
                        ]),
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_featured',
                    'format' => 'raw',
                    'value' => fn($model) =>
                        Html::tag('span', $model->is_featured ? '⭐ Featured' : '❌ No', [
                            'class' => 'badge ' . ($model->is_featured ? 'bg-warning text-dark' : 'bg-secondary')
                        ]),
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_top_selling',
                    'format' => 'raw',
                    'value' => fn($model) =>
                        Html::tag('span', $model->is_top_selling ? '🔥 Top' : '❌ No', [
                            'class' => 'badge ' . ($model->is_top_selling ? 'bg-danger' : 'bg-secondary')
                        ]),
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {edit} {delete}',
                    'contentOptions' => ['class' => 'text-nowrap'],
                    'buttons' => [
                        'view' => fn($url, $model) =>
                            Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-sm btn-info me-1', 'title'=>'View']),
                        'edit' => fn($url, $model) =>
                            Html::a('<i class="fas fa-edit"></i>', ['edit', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary me-1', 'title'=>'Edit']),
                        'delete' => fn($url, $model) =>
                            Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-danger me-1',
                                'data-confirm' => 'Are you sure you want to delete this product?',
                                'data-method' => 'post',
                                'title' => 'Delete'
                            ]),
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
