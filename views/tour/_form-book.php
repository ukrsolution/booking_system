<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-form">    
    <?php $form = ActiveForm::begin(); ?>
    
    <?php foreach ($modelTourFields as $key => $modelTourField) {        
        echo HTML::label($modelTourField->name) .  '<br>';        
    echo HTML::textInput("BookValues[$key]", null, ['required' => true]) . '<br>'; 
        echo HTML::hiddenInput("ValuesType[$key]", $modelTourField->type);
    }?>
    <?php echo $form->field($modelBook, 'date')->input('date', ['name' => 'Date', 'style' => 'width: 160px;']); ?>   
    

    <div class="form-group">
        <?= Html::submitButton('Book', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?php if(!$success) echo "<h4>Data is not valid</h4>"; ?>

</div>
