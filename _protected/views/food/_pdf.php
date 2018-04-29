<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Food */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Food'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'detail:ntext',
        'price',
        [
                'attribute' => 'category0.name',
                'label' => 'Category'
            ],
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerFoodImage->totalCount){
    $gridColumnFoodImage = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'img',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerFoodImage,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Food Image'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnFoodImage
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerOrderItem->totalCount){
    $gridColumnOrderItem = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                'qty',
        'note:ntext',
        'approved',
        [
                'attribute' => 'order.id',
                'label' => 'Order'
            ],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerOrderItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Order Item'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnOrderItem
    ]);
}
?>
    </div>
</div>
