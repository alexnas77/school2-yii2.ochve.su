<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\StatSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'breakfast_free') ?>

    <?= $form->field($model, 'breakfast') ?>

    <?php // echo $form->field($model, 'lunch') ?>

    <?php // echo $form->field($model, 'lunch2') ?>

    <?php // echo $form->field($model, 'lunch3') ?>

    <?php // echo $form->field($model, 'dinner') ?>

    <?php // echo $form->field($model, 'lunch_m') ?>

    <?php // echo $form->field($model, 'dinner_m') ?>

    <?php // echo $form->field($model, 'cash') ?>

    <?php // echo $form->field($model, 'card') ?>

    <?php // echo $form->field($model, 'new_breakfast_free') ?>

    <?php // echo $form->field($model, 'new_breakfast') ?>

    <?php // echo $form->field($model, 'new_lunch') ?>

    <?php // echo $form->field($model, 'new_lunch2') ?>

    <?php // echo $form->field($model, 'new_lunch3') ?>

    <?php // echo $form->field($model, 'new_dinner') ?>

    <?php // echo $form->field($model, 'new_lunch_m') ?>

    <?php // echo $form->field($model, 'new_dinner_m') ?>

    <?php // echo $form->field($model, 'delta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
