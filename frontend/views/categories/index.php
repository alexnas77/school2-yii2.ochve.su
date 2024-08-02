<?php

use frontend\models\Categories;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CategoriesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'category_id',
            'parent',
            'name',
            'alies',
            'title',
            //'title1',
            //'title2',
            //'title3',
            //'title4',
            //'title5',
            //'title6',
            //'title7',
            //'title8',
            //'title9',
            //'description:ntext',
            //'description1:ntext',
            //'description2:ntext',
            //'description3:ntext',
            //'description4:ntext',
            //'description5:ntext',
            //'description6:ntext',
            //'description7:ntext',
            //'description8:ntext',
            //'description9:ntext',
            //'toptext:ntext',
            //'brands:ntext',
            //'order_num',
            //'enabled',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Categories $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'category_id' => $model->category_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
