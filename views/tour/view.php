<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Tour */

$this->title = $model->title;
$fields=$model->getTourFields()->orderBy('position');

$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>
    <p>
         <?= Html::a('Edit tour fields', ['tour-field/index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
                            'query' => $fields,
                            'pagination' => [
                                'pageSize' => 20,
                            ],
                        ]),
        'columns' => [
          'name',
          'type',
          'position',
        ],
    ]) ?>
    
    <!-- <? $this->render('../tour-field/index', ['model' => $model,'searchModel' => $searchModel,'dataProvider' => $dataProvider, ]) ?> -->

</div>
