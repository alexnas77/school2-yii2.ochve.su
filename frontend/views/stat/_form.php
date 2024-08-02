<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Stat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'breakfast_free')->textInput() ?>

    <?= $form->field($model, 'breakfast')->textInput() ?>

    <?= $form->field($model, 'lunch')->textInput() ?>

    <?= $form->field($model, 'lunch2')->textInput() ?>

    <?= $form->field($model, 'lunch3')->textInput() ?>

    <?= $form->field($model, 'dinner')->textInput() ?>

    <?= $form->field($model, 'lunch_m')->textInput() ?>

    <?= $form->field($model, 'dinner_m')->textInput() ?>

    <?= $form->field($model, 'cash')->textInput() ?>

    <?= $form->field($model, 'card')->textInput() ?>

    <?= $form->field($model, 'new_breakfast_free')->textInput() ?>

    <?= $form->field($model, 'new_breakfast')->textInput() ?>

    <?= $form->field($model, 'new_lunch')->textInput() ?>

    <?= $form->field($model, 'new_lunch2')->textInput() ?>

    <?= $form->field($model, 'new_lunch3')->textInput() ?>

    <?= $form->field($model, 'new_dinner')->textInput() ?>

    <?= $form->field($model, 'new_lunch_m')->textInput() ?>

    <?= $form->field($model, 'new_dinner_m')->textInput() ?>

    <?= $form->field($model, 'delta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
