<?php

use frontend\models\Stat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use frontend\components\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var frontend\models\StatSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php 
    
    $yes_no = function ($model, $key, $index, $column) {
                    //error_log(print_r($model, 1));
                    return isset($model[$column->attribute]) && (bool)(int)$model[$column->attribute] ? "<span class=\"text-success\">Да</span>" : "<span class=\"text-danger\">Нет</span>";
                }; 
                
    $dinner = function ($model, $key, $index, $column) {
                    return (string)(int)$model[$column->attribute] . " ед.";
                }; 
    $pay = function ($model, $key, $index, $column) {
                    return (string)(int)$model[$column->attribute];
                }; 
    $before = function ($model, $key, $index, $column) {
                    //error_log(print_r($model, true));
                    return intval($model[$column->attribute]) > 0 ? "<span class=\"price-warning\">".$model[$column->attribute]." руб</span>" : "<span class=\"price\">".$model[$column->attribute]." руб</span>";
                }; 
                
    $columns = [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['rowspan' => 3],
            ],
            [
                'label' => 'Фамилия',
                'attribute' => 'model',
                'contentOptions' => ['class' => 'text-start text-nowrap'],
                'headerOptions' => ['rowspan' => 3],
                'footer' => 'Итого количество',
                'filter' => false,
                'footerOptions' => ['data-footer' => [
                    'Итого сумма, руб',
                    'Итого за день, руб'
                ]],
            ],
            //'product_id',
            //'date',
            //'category_id',
            [
                'attribute' => 'before',
                'header' => '<span class="text-nowrap">Задолж (+)</span><br /><span class="text-nowrap">Переплата (-)</span><br />на<br />'.$date,
                'headerOptions' => ['class' => 'text-center'],
                'value' => $before,
                'format' => 'raw',
                'headerOptions' => ['rowspan' => 3],
                'footerOptions' => ['data-footer' => [
                    $footer_sum['sum_before'],
                    $footer_sum['sum_before'],
                ]],
            ],
            [
                'header' => 'Завтрак бесплатный<br />'.(isset($model->new_breakfast_free) ? $model->new_breakfast_free.' руб' : ''),
                'attribute' =>'breakfast_free',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_breakfast_free']),
                'footerOptions' => ['data-footer' => [
                                        floatval($footer_sum['sum_breakfast_free']),
                                        floatval($footer_sum['sum_spent']),
                                    ],
                                    'data-options' => [
                                        [],
                                        ['colspan' => 7],
                                    ],
                                    ],
            ],
            [
                'header' => 'Завтрак<br />'.(isset($model->new_breakfast) ? $model->new_breakfast.' руб' : ''),
                'attribute' =>'breakfast',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_breakfast']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_breakfast']),
                    false,
                ]],
            ],
            [
                'header' => 'Обед<br />'.(isset($model->new_lunch) ? $model->new_lunch.' руб' : ''),
                'attribute' =>'lunch',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch']),
                    false,
                ]],
            ],
            [
                'header' => 'Завтрак льготный<br />'.(isset($model->new_lunch2) ? $model->new_lunch2.' руб' : ''),
                'attribute' =>'lunch2',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch2']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch2']),
                    false,
                ]],
            ],
            //'lunch3',
            [
                'header' => 'Завтрак М<br />'.(isset($model->new_lunch_m) ? $model->new_lunch_m.' руб' : ''),
                'attribute' =>'lunch_m',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch_m']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch_m']),
                    false,
                ]],
            ],
            [
                'header' => 'Обед М<br />'.(isset($model->new_dinner_m) ? $model->new_dinner_m.' руб' : ''),
                'attribute' =>'dinner_m',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_dinner_m']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_dinner_m']),
                    false,
                ]],
            ],
            [
                'header' => 'Полдник<br />'.(isset($model->new_dinner) ? $model->new_dinner.' руб' : ''),
                'attribute' =>'dinner',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $dinner,
                'headerOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_dinner']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_dinner']),
                    false,
                ]],
            ],
            [
                'header' => 'Нал',
                'attribute' =>'cash',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $pay,
                'footerOptions' => ['data-footer' => [
                                    floatval($footer_sum['sum_cash']),
                                    floatval($footer_sum['sum_in']),
                                ],
                                'data-options' => [
                                    [],
                                    ['colspan' => 2],
                                ],
                ],
            ],
            [
                'header' => 'Безнал',
                'attribute' =>'card',
                'contentOptions' => ['class' => (!\Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $pay,
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_card']),
                    false, 
                ]],
            ],
            [
                'attribute' =>'after',
                'header' => '<span class="text-nowrap">Задолж (+)</span><br /><span class="text-nowrap">Переплата (-)</span><br />на<br />'.$dateTomorrow,
                'headerOptions' => ['class' => 'text-center'],
                'value' => $before,
                'format' => 'raw',
                'headerOptions' => ['rowspan' => 3],
                'footerOptions' => ['data-footer' => [
                    $footer_sum['sum_after'],
                    $footer_sum['sum_after'],
                ]],
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
                
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'layout' => "{summary}\n{sorter}\n{items}\n{pager}",
        'layout' => "{items}\n{pager}",
        'showFooter' => true,
        'columns' => $columns,
        'options' => [
            'class' => 'text-center position-relative',
            'data-date' => $date,
            ],
        //'rowOptions' => ['class' => !\Yii::$app->user->isGuest ? 'hover' : ''],
    ]); ?>
    <?php ActiveForm::end(); ?> 
    <?php Pjax::end(); ?>    

</div>

<?php

$this->registerCss(<<<CSS
thead {
    position: -webkit-sticky; /* Safari */  
    position: sticky;
    top: 55px;
    background-color: white;
}
thead tr {
    border: 1px solid var(--bs-border-color)!important;
    border-width: 1px!important;
}
thead tr th {
    vertical-align: middle;
    border: 1px solid var(--bs-border-color)!important;
    border-width: 1px!important;
}
thead th.hover:hover {
    background-color: gold;
    cursor: pointer;
}
tbody tr {
    border: 1px solid var(--bs-border-color)!important;
    border-width: 1px!important;
}
tbody tr td {
    border: 1px solid var(--bs-border-color)!important;
    border-width: 1px!important;
}
tbody tr:hover {
    background-color: cyan;
}
tbody tr td.hover:hover {
    background-color: gold;
    cursor: pointer;
}
caption {
    /*padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    color: #6c757d;
    text-align: left;*/
    position: absolute;
    top: -35px;
    left: calc(50% - 75px/2);
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