<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $category app\models\Categories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Html::encode($category->name);
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid product py-5">
    <div class="container py-5">
        <h1><?= Html::encode($category->name) ?></h1>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product_item',
            'layout' => "{items}\n{pager}",
            'options' => ['class' => 'row g-4'],
            'itemOptions' => ['class' => 'col-md-6 col-lg-4 col-xl-3'],
        ]) ?>
    </div>
</div>