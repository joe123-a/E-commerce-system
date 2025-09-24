<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Categories';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="categories-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('➕ Add Category', ['create'], ['class' => 'btn btn-success mb-3']) ?>
    </p>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-bordered table-striped table-hover align-middle'],
            'layout' => "{summary}\n{items}\n{pager}",
            'columns' => [
                'id',
                'name',
                'slug',
                [
                    'attribute' => 'product_count',
                    'label' => 'Products',
                    'value' => function ($model) {
                        return $model->getProductCount();
                    },
                    'contentOptions' => ['class' => 'text-center'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {edit} {delete}',
                    'contentOptions' => ['class' => 'text-nowrap'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="fas fa-eye"></i>', ['view', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-info me-1',
                                'title' => 'View'
                            ]);
                        },
                        'edit' => function ($url, $model) {
                            return Html::a('<i class="fas fa-edit"></i>', ['edit', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-primary me-1',
                                'title' => 'Edit'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-sm btn-danger me-1',
                                'data-confirm' => 'Are you sure you want to delete this category?',
                                'data-method' => 'post',
                                'title' => 'Delete'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>