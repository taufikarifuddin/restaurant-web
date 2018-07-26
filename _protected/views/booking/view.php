<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */

$this->title = "Booking id : ".$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view col-md-12">

    <div class="row">
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-sm btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-flat btn-sm  btn-danger',
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
        'id',
        [
            'attribute' => 'noMeja.id',
            'label' => 'No Meja',
        ],
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        [
            'attribute' => 'starttime',
            'label' => 'Start Booking',
            'value' => function($value){
                return date('d - M - Y  / H:i',$value->starttime);
            }
        ],
        [
            'attribute' => 'endtime',
            'label' => 'End Booking',
            'value' => function($value){
                return date('d - M - Y  / H:i',$value->endtime);
            }
        ]
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>