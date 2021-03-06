<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\OrderItem */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Item', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-item-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Order Item'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
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
        [
            'attribute' => 'food.name',
            'label' => 'Food',
        ],
        'qty',
        'note:ntext',
        'approved',
        [
            'attribute' => 'order.id',
            'label' => 'Order',
        ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Food<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFood = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'detail',
        'price',
        'category',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model->food,
        'attributes' => $gridColumnFood    ]);
    ?>
    <div class="row">
        <h4>Order<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnOrder = [
        ['attribute' => 'id', 'visible' => false],
        'user_id',
        'order_time',
        'total_price',
        'is_payed',
        'step',
    ];
    echo DetailView::widget([
        'model' => $model->order,
        'attributes' => $gridColumnOrder    ]);
    ?>
</div>
