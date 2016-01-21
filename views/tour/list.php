<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

$this->title = 'Choose tour';
$this->params['breadcrumbs'][] = ['label' => 'Book Tour', 'url' => ['tour/list']];

?>
<div class="tour-list">

    <h1><?= Html::encode($this->title) ?></h1>    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => ['style' => 'width:40px;'],
            ],

            'title',
            
            [
             'label'=>'',
             'format' => 'raw',
             'value'=>function ($model, $key, $index, $column) {
                        return Html::a('Book Tour', ['tour/book', 'id' => $key]);
                      },
            ],
            
        ],
    ]); ?>
    

</div>
