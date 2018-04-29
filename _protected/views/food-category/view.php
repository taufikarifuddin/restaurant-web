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
<div class="food-category-view col-md-12">

    <div class="row">
        <div class="col-sm-9">
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-flat btn-sm btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-sm btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-flat btn-sm btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        [
            'attribute' => 'is_food',
            'label' => 'Kategori',
            'value' => function($model){
                return \app\models\FoodType::foodType($model->is_food);
            }
        ]
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-food']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Food'),
        ],
        'columns' => $gridColumnFood
    ]);
}
?>

    </div>
</div>
