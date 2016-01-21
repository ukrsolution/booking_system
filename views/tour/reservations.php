<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TourSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-index">

    <h1><?= Html::encode($this->title) ?></h1>    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            'title',
            'date',
            [
             'label'=>'',
             'format' => 'raw',
             'value'=>function ($model, $key, $index, $column) {                        
                        return Html::a('View details', ['tour/view-reservation', 'id' => $model['id']]);
                      },
            ],
            [
             'label'=>'',
             'format' => 'raw',
             'value'=>function ($model, $key, $index, $column) {                        
                        return Html::a('Delete', ['tour/delete-reservation', 'id' => $model['id']]);
                      },
            ],            
        ],
    ]); ?>

</div>
