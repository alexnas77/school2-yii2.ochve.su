<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CategoriesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alies') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'title1') ?>

    <?php // echo $form->field($model, 'title2') ?>

    <?php // echo $form->field($model, 'title3') ?>

    <?php // echo $form->field($model, 'title4') ?>

    <?php // echo $form->field($model, 'title5') ?>

    <?php // echo $form->field($model, 'title6') ?>

    <?php // echo $form->field($model, 'title7') ?>

    <?php // echo $form->field($model, 'title8') ?>

    <?php // echo $form->field($model, 'title9') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'description1') ?>

    <?php // echo $form->field($model, 'description2') ?>

    <?php // echo $form->field($model, 'description3') ?>

    <?php // echo $form->field($model, 'description4') ?>

    <?php // echo $form->field($model, 'description5') ?>

    <?php // echo $form->field($model, 'description6') ?>

    <?php // echo $form->field($model, 'description7') ?>

    <?php // echo $form->field($model, 'description8') ?>

    <?php // echo $form->field($model, 'description9') ?>

    <?php // echo $form->field($model, 'toptext') ?>

    <?php // echo $form->field($model, 'brands') ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'enabled') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
