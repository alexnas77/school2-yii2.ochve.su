<?php
//use yii\grid\GridView;


use frontend\components\GridView;
use frontend\models\StatSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\models\Settings;
/** @var View $this */
/** @var StatSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = mb_ucfirst(mb_strtolower(Settings::getParam('company_name'))).' класс '.$model->category;
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
                    Yii::debug($model);
                    $text = isset($model[$column->attribute]) && (bool)(int)$model[$column->attribute] ? "<span class=\"text-success\">Да</span>" : "<span class=\"text-danger\">Нет</span>"; 
                    return !Yii::$app->user->isGuest ?
                            Html::a($text, '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'product_id' => $model['product_id'], 
                                            'date' => $model['date'], 
                                            'attribute' => $column->attribute,
                                            'value' => (int)$model[$column->attribute],
                                    ]])
                            : $text;
                }; 
                
    $dinner = function ($model, $key, $index, $column) {
                    $text = (string)(int)$model[$column->attribute] . " ед.";
                    return !Yii::$app->user->isGuest ?
                            Html::a($text, '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'product_id' => $model['product_id'], 
                                            'date' => $model['date'], 
                                            'attribute' => $column->attribute,
                                            'value' => (int)$model[$column->attribute],
                                    ]])
                            : $text;
                }; 
    $pay = function ($model, $key, $index, $column) {
                    $text = (string)(int)$model[$column->attribute];
                    return !Yii::$app->user->isGuest ?
                            Html::a($text, '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'product_id' => $model['product_id'], 
                                            'date' => $model['date'], 
                                            'attribute' => $column->attribute,
                                            'value' => (int)$model[$column->attribute],
                                    ]])
                            : $text;
                }; 
    $before = function ($model, $key, $index, $column) {
                    //error_log(print_r($model, true));
                    $text = intval($model[$column->attribute]) > 0 ? "<span class=\"price-warning\">".$model[$column->attribute]." руб</span>" : "<span class=\"price\">".$model[$column->attribute]." руб</span>";
                    return $text;
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
                //'header' => 'Завтрак бесплатный<br />'.(isset($model->new_breakfast_free) ? $model->new_breakfast_free.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Завтрак бесплатный<br />'.(isset($model->new_breakfast_free) ? $model->new_breakfast_free.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id,
                                            'date' => $model->date,
                                            'attribute' => 'new_breakfast_free',
                                            'value' => $model->new_breakfast_free,
                                        ]]
                                    )
                            : 'Завтрак бесплатный<br />'.(isset($model->new_breakfast_free) ? $model->new_breakfast_free.' руб' : ''),
                'attribute' =>'breakfast_free',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
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
                //'header' => 'Завтрак<br />'.(isset($model->new_breakfast) ? $model->new_breakfast.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Завтрак<br />'.(isset($model->new_breakfast) ? $model->new_breakfast.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_breakfast',
                                            'value' => $model->new_breakfast,
                                        ]]
                                    )
                            : 'Завтрак<br />'.(isset($model->new_breakfast) ? $model->new_breakfast.' руб' : ''),                
                'attribute' =>'breakfast',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_breakfast']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_breakfast']),
                    false,
                ]],
            ],
            [
                //'header' => 'Обед<br />'.(isset($model->new_lunch) ? $model->new_lunch.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Обед<br />'.(isset($model->new_lunch) ? $model->new_lunch.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_lunch',
                                            'value' => $model->new_lunch,
                                        ]]
                                    )
                            : 'Обед<br />'.(isset($model->new_lunch) ? $model->new_lunch.' руб' : ''),  
                'attribute' =>'lunch',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch']),
                    false,
                ]],
            ],
            [
                //'header' => 'Завтрак льготный<br />'.(isset($model->new_lunch2) ? $model->new_lunch2.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Завтрак льготный<br />'.(isset($model->new_lunch2) ? $model->new_lunch2.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_lunch2',
                                            'value' => $model->new_lunch2,
                                        ]]
                                    )
                            : 'Завтрак льготный<br />'.(isset($model->new_lunch2) ? $model->new_lunch2.' руб' : ''),
                'attribute' =>'lunch2',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch2']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch2']),
                    false,
                ]],
            ],
            //'lunch3',
            [
                //'header' => 'Завтрак М<br />'.(isset($model->new_lunch_m) ? $model->new_lunch_m.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Завтрак М<br />'.(isset($model->new_lunch_m) ? $model->new_lunch_m.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_lunch_m',
                                            'value' => $model->new_lunch_m,
                                        ]]
                                    )
                            : 'Завтрак М<br />'.(isset($model->new_lunch_m) ? $model->new_lunch_m.' руб' : ''),
                'attribute' =>'lunch_m',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_lunch_m']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_lunch_m']),
                    false,
                ]],
            ],
            [
                //'header' => 'Обед М<br />'.(isset($model->new_dinner_m) ? $model->new_dinner_m.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Обед М<br />'.(isset($model->new_dinner_m) ? $model->new_dinner_m.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_dinner_m',
                                            'value' => $model->new_dinner_m,
                                        ]]
                                    )
                            : 'Обед М<br />'.(isset($model->new_dinner_m) ? $model->new_dinner_m.' руб' : ''),
                'attribute' =>'dinner_m',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $yes_no,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_dinner_m']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_dinner_m']),
                    false,
                ]],
            ],
            [
                //'header' => 'Полдник<br />'.(isset($model->new_dinner) ? $model->new_dinner.' руб' : ''),
                'header' => !Yii::$app->user->isGuest 
                            ? Html::a(
                                    'Полдник<br />'.(isset($model->new_dinner) ? $model->new_dinner.' руб' : ''), 
                                    '#updateModal', 
                                    [
                                        'class' => 'd-block', 
                                        'data' => [
                                            'bs-toggle' => "modal", 
                                            'category_id' => $model->category_id, 
                                            'date' => $model->date,
                                            'attribute' => 'new_dinner',
                                            'value' => $model->new_dinner,
                                        ]]
                                    )
                            : 'Полдник<br />'.(isset($model->new_dinner) ? $model->new_dinner.' руб' : ''),
                'attribute' =>'dinner',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $dinner,
                'format' => 'raw',
                'headerOptions' => ['class' => !Yii::$app->user->isGuest ? 'hover' : ''],
                'footer' => floatval($footer_sum['count_dinner']),
                'footerOptions' => ['data-footer' => [
                    floatval($footer_sum['sum_dinner']),
                    false,
                ]],
            ],
            [
                'header' => 'Нал',
                'attribute' =>'cash',
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $pay,
                'format' => 'raw',
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
                'contentOptions' => ['class' => (!Yii::$app->user->isGuest ? 'hover' : null)],
                'value' => $pay,
                'format' => 'raw',
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
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary">Сохранить изменения</button>
      </div>
    </div>
  </div>
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
thead tr th.hover a, tbody tr td.hover a {
    text-decoration: none;
    color: black;
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
$this->registerJs(<<<JS
const myModalEl = document.getElementById('updateModal')
myModalEl.addEventListener('shown.bs.modal', event => {
    
        let relatedTarget = event.relatedTarget;
        console.log(relatedTarget);
        let self = event.target;
        console.log(self);
        
})
JS);