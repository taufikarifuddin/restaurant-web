<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FoodCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Food Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-category-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Food Category'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'is_food',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerFood->totalCount){
    $gridColumnFood = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'detail:ntext',
        'price',
                'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerFood,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Food'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnFood
    ]);
}
?>
    </div>
</div>
