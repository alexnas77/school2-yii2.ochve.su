<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Stat $model */

$this->title = 'Update Stat: ' . $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Stats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_id, 'url' => ['view', 'product_id' => $model->product_id, 'date' => $model->date]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
