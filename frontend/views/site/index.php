<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

$this->title = 'My Yii Application';
?>
<div class="site-index mt-3 mb-3 d-grid gx-1 gy-2 gap-5">
<?php /*    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>

    <div class="body-content">

       <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>*/?>
    
        
        <?php /*<pre> echo json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); </pre>*/?>
        <div class="text-center">
            <?= Html::beginForm(['/class/index'], 'post') ?>
                <table class="m-auto" style="text-align: left;min-width: 400px;">
                    <tr>
                        <td colspan="2" style="font-size:16px;background-color: #919191;color: white;padding: 10px 20px;font-weight: bolder;">Выберите класс и дату</td>
                    </tr>
                    <tr>
                        <td>Класс</td><td style="text-align:left"><?= Html::dropDownList('category_id', null, ArrayHelper::map($categories, 'category_id', 'title'), ['class' => 'w-100']) ?></td>
                    </tr>
                    <tr>
                        <td>Дата</td><td style="text-align:left"><?= DatePicker::widget([
                            'name'  => 'date',
                            'value'  => date("d.m.Y"),
                            'options' => [
                                'class' => 'w-100',
                                ],
                            'language' => 'ru',
                            'dateFormat' => 'php:d.m.Y',
                        ]); ?></td>
                    </tr>
                    <tr>
                        <td><?= Html::submitButton('Перейти', ['class' => 'submit']) ?></td><td><?= Html::resetButton('Сбросить', ['class' => 'reset']) ?></td>
                    </tr>
                </table>     
            <?= Html::endForm() ?>
        </div>
        <div class="text-center">
            <?= Html::beginForm(['/categories'], 'post') ?>
                <table class="m-auto" style="text-align: left;min-width: 400px;">
                    <tr>
                        <td colspan="2" style="font-size:16px;background-color: #919191;color: white;padding: 10px 20px;font-weight: bolder;">Выберите класс и период для отчета</td>
                    </tr>
                    <tr>
                        <td>Фамилия</td><td style="text-align:left"><?= Html::input('text', 'search', null, ['class' => 'w-100']) ?></td>
                    </tr>
                    <tr>
                        <td>Класс</td><td style="text-align:left"><?= Html::dropDownList('category_id', null, ArrayHelper::merge(['' => 'Все классы'], ArrayHelper::map($categories, 'category_id', 'title')), ['style' => 'width:100%']) ?></td>
                    </tr>
                    <tr>
                        <td>Начало</td><td style="text-align:left"><?= DatePicker::widget([
                            'name'  => 'from_date',
                            'value'  => "01.".date("m.Y"),
                            'options' => [
                                'class' => 'w-100',
                                ],
                            'language' => 'ru',
                            'dateFormat' => 'php:d.m.Y',
                        ]); ?></td>
                    </tr>
                    <tr>
                        <td>Окончание</td><td style="text-align:left"><?= DatePicker::widget([
                            'name'  => 'to_date',
                            'value'  => date("d.m.Y"),
                            'options' => [
                                'class' => 'w-100',
                                ],
                            'language' => 'ru',
                            'dateFormat' => 'php:d.m.Y',
                        ]); ?></td>
                    </tr>
                    <tr>
                        <td><?= Html::submitButton('Перейти', ['class' => 'submit']) ?></td><td><?= Html::resetButton('Сбросить', ['class' => 'reset']) ?></td>
                    </tr>
                </table>     
            <?= Html::endForm() ?>
        </div>
</div>
