<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Stat $model */

$this->title = $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Stats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="stat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'product_id' => $model->product_id, 'date' => $model->date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id, 'date' => $model->date], [
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
            'product_id',
            'date',
            'category_id',
            'breakfast_free',
            'breakfast',
            'lunch',
            'lunch2',
            'lunch3',
            'dinner',
            'lunch_m',
            'dinner_m',
            'cash',
            'card',
            'new_breakfast_free',
            'new_breakfast',
            'new_lunch',
            'new_lunch2',
            'new_lunch3',
            'new_dinner',
            'new_lunch_m',
            'new_dinner_m',
            'delta',
        ],
    ]) ?>

</div>
