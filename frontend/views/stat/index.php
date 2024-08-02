<?php

use frontend\models\Stat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\StatSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product_id',
            'date',
            //'category_id',
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
            //'delta',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Stat $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'product_id' => $model->product_id, 'date' => $model->date]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
