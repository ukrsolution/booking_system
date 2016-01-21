<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TourField */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-field-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<? $form->field($model, 'tour_id')->textInput() ?>-->
    <?= $form->field($model, 'tour_id')->hiddenInput(['value' => $id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'type')->dropDownList($model->fieldsType) ?>

    <?= $form->field($model, 'position')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
