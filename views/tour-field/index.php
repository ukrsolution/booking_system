<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TourFieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tour Fields';
$this->params['breadcrumbs'][] = ['label' => 'Tours', 'url' => ['tour/index']];
$this->params['breadcrumbs'][] = ['label' => $tourModel->title, 'url' => ['tour/view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-field-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tour Field', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'tour_id',
            'name',
            'type',
            'position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
