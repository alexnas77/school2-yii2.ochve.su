<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Categories $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alies')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description1')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description2')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description3')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description4')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description5')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description6')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description7')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description8')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description9')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'toptext')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'brands')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'order_num')->textInput() ?>

    <?= $form->field($model, 'enabled')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
