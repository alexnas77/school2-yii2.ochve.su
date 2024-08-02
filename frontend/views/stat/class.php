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
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php 
    
    $yes_no = function ($model, $key, $index, $column) {
                    return (bool)(int)$model[$column->attribute] ? "<span class=\"text-success\">Да</span>" : "<span class=\"text-danger\">Нет</span>";
                }; 
                
    $dinner = function ($model, $key, $index, $column) {
                    return (string)(int)$model[$column->attribute] . " ед.";
                }; 
    $before = function ($model, $key, $index, $column) {
                    return intval($model[$column->attribute]) > 0 ? "<span class=\"price-warning\">".$model[$column->attribute]." руб</span>" : "<span class=\"price\">".$model[$column->attribute]." руб</span>";
                }; 
                
    $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Фамилия',
                'attribute' => 'model',
                'contentOptions' => ['class' => 'text-start text-nowrap'],
            ],
            //'product_id',
            //'date',
            //'category_id',
            [
                'attribute' => 'before',
                'header' => '<span class="text-nowrap">Задолж (+)</span><br /><span class=""text-nowrap>Переплата (-) на</span><br />'.$date,
                'headerOptions' => ['class' => 'text-center'],
                'value' => $before,
                'format' => 'raw',
            ],
            [
                'header' => 'Завтрак бесплатный<br />'.(isset($model->new_breakfast_free) ? $model->new_breakfast_free.' руб' : ''),
                'attribute' =>'breakfast_free',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            [
                'header' => 'Завтрак<br />'.(isset($model->new_breakfast) ? $model->new_breakfast.' руб' : ''),
                'attribute' =>'breakfast',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            [
                'header' => 'Обед<br />'.(isset($model->new_lunch) ? $model->new_lunch.' руб' : ''),
                'attribute' =>'lunch',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            [
                'header' => 'Завтрак льготный<br />'.(isset($model->new_lunch2) ? $model->new_lunch2.' руб' : ''),
                'attribute' =>'lunch2',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            //'lunch3',
            [
                'header' => 'Завтрак М<br />'.(isset($model->new_lunch_m) ? $model->new_lunch_m.' руб' : ''),
                'attribute' =>'lunch_m',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            [
                'header' => 'Обед М<br />'.(isset($model->new_dinner_m) ? $model->new_dinner_m.' руб' : ''),
                'attribute' =>'dinner_m',
                'value' => $yes_no,
                'format' => 'raw',
            ],
            [
                'header' => 'Полдник<br />'.(isset($model->new_dinner) ? $model->new_dinner.' руб' : ''),
                'attribute' =>'dinner',
                'value' => $dinner,
            ],
            [
                'header' => 'Нал',
                'attribute' =>'cash',
            ],
            [
                'header' => 'Безнал',
                'attribute' =>'card',
            ],
            [
                'attribute' =>'after',
                'header' => '<span class="text-nowrap">Задолж (+)</span><br /><span class=""text-nowrap>Переплата (-) на</span><br />'.$date,
                'headerOptions' => ['class' => 'text-center'],
                'value' => $before,
                'format' => 'raw',
            ],
            //'new_breakfast_free',
            //'new_breakfast',
            //'new_lunch',
            //'new_lunch2',
            //'new_lunch3',
            //'new_dinner',
            //'new_lunch_m',
            //'new_dinner_m',
            //'delta',
//            [
//                'class' => ActionColumn::className(),
//                'urlCreator' => function ($action, Stat $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'product_id' => $model->product_id, 'date' => $model->date]);
//                 }
//            ],
        ];
    
    //$subheader = $this->render("/partials/subheader", ['columns' => $columns]);
                
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'layout' => "{summary}\n{sorter}\n{items}\n{pager}",
        'layout' => "{items}\n{pager}",
        'showFooter' => true,
        'columns' => $columns,
        'options' => ['class' => 'text-center'],
    ]); ?>

    <?php Pjax::end(); ?>    

</div>

<?php

$this->registerCss(<<<CSS
th {
    vertical-align: middle
}
tbody tr:hover {
    background-color: cyan
}
tbody tr td:hover {
    background-color: gold
}
span.price-warning {
    color: #fc0000;
    font-size: 14px;
    font-weight: bolder;
}
span.price {
    color: green;
    font-size: 14px;
    font-weight: normal;
}
CSS);