<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TourField */

$this->title = 'Update Tour Field: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['tour/index']];
$this->params['breadcrumbs'][] = ['label' => $tourModel->title, 'url' => ['tour/view', 'id' => $tourModel->id]];
$this->params['breadcrumbs'][] = ['label' => 'Tour Fields', 'url' => ['index', 'id' => $tourModel->id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tour-field-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id
    ]) ?>

</div>
