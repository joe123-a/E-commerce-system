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
            'layout' => "{summary}\n{items}\n{pager}",
            'columns' => [
                'id',
                [
                    'attribute' => 'image_path',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->image_path && file_exists(Yii::getAlias('@webroot') . '/' . $model->image_path)) {
                            return Html::img(Yii::getAlias('@web') . '/' . $model->image_path, [
                                'class' => 'img-fluid rounded',
                                'style' => 'width:60px; height:60px; object-fit:cover;'
                            ]);
                        }
                        return '(No Image)';
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                'name',
                'model',
                [
                    'attribute' => 'category_id',
                    'label' => 'Category',
                    'value' => function ($model) {
                        return $model->category ? $model->category->name : 'N/A';
                    },
                ],
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
                    'attribute' => 'rating',
                    'value' => function ($model) {
                        return $model->rating ? number_format($model->rating, 1) . ' ★' : 'N/A';
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_new',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::tag('span', $model->is_new ? '✅ New' : '❌ No', [
                            'class' => 'badge ' . ($model->is_new ? 'bg-success' : 'bg-secondary')
                        ]);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_sale',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::tag('span', $model->is_sale ? '💲 Sale' : '❌ No', [
                            'class' => 'badge ' . ($model->is_sale ? 'bg-warning text-dark' : 'bg-secondary')
                        ]);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_featured',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::tag('span', $model->is_featured ? '⭐ Featured' : '❌ No', [
                            'class' => 'badge ' . ($model->is_featured ? 'bg-warning text-dark' : 'bg-secondary')
                        ]);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'attribute' => 'is_top_selling',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::tag('span', $model->is_top_selling ? '🔥 Top' : '❌ No', [
                            'class' => 'badge ' . ($model->is_top_selling ? 'bg-danger' : 'bg-secondary')
                        ]);
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {edit} {delete}',
                    'buttons' => [
                        'view' => fn($url, $model) =>
                            Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], ['class'=>'btn btn-sm btn-info me-1']),
                        'edit' => fn($url, $model) =>
                            Html::a('<i class="fas fa-edit"></i>', ['edit', 'id' => $model->id], ['class'=>'btn btn-sm btn-primary me-1']),
                        'delete' => fn($url, $model) =>
                            Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                                'class'=>'btn btn-sm btn-danger me-1',
                                'data-confirm'=>'Are you sure?',
                                'data-method'=>'post'
                            ]),
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
