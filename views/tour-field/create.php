<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TourField */

$this->title = 'Create Tour Field';
$this->params['breadcrumbs'][] = ['label' => 'Tour Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-field-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
