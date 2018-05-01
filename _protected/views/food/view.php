<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Food */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Food', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-view col-md-12">

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
        'detail:ntext',
        'price',
        [
            'attribute' => 'category0.name',
            'label' => 'Category',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-food-image']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Food Image'),
        ],
        'columns' => $gridColumnFoodImage
    ]);
}
?>

    </div>
    
    <div class="food-image-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($modelForm,'foodId')->hiddenInput(['value' => $model->id])->label(false) ?>
        <?= $form->field($modelForm,'imageFile')->fileInput(['accept' => 'image/*','placeholder' => 'Img']) ?>


        <div class="form-group">
            <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-flat btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order-item']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order Item'),
        ],
        'columns' => $gridColumnOrderItem
    ]);
}
?>

    </div>
</div>
