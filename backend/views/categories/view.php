<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'category_id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'category_id' => $model->category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category_id',
            'parent',
            'name',
            'alies',
            'title',
            'title1',
            'title2',
            'title3',
            'title4',
            'title5',
            'title6',
            'title7',
            'title8',
            'title9',
            'description:ntext',
            'description1:ntext',
            'description2:ntext',
            'description3:ntext',
            'description4:ntext',
            'description5:ntext',
            'description6:ntext',
            'description7:ntext',
            'description8:ntext',
            'description9:ntext',
            'toptext:ntext',
            'brands:ntext',
            'order_num',
            'enabled',
        ],
    ]) ?>

</div>
