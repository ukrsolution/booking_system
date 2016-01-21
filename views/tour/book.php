<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $tourTitle;
$this->params['breadcrumbs'][] = ['label' => 'Book Tour', 'url' => ['tour/list']];
//$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-book">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Enter your data</p>

    <?php  echo $this->render('_form-book', [
       'modelBookValues' => $modelBookValues,
       'modelTourFields' => $modelTourFields,
       'modelBook'       => $modelBook,
       'success'         => $success,
    ]) ?>

</div>
