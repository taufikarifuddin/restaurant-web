<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view col-md-12">
<div class="row">
    <div class="col-sm-9">                   
                </div>
                <div class="col-sm-3" style="margin-top: 15px">
                    <?=             
                    Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                        ['pdf', 'id' => $model->id],
                        [
                            'class' => 'btn btn-sm btn-flat btn-danger',
                            'target' => '_blank',
                            'data-toggle' => 'tooltip',
                            'title' => 'Will open the generated PDF file in a new window'
                        ]
                    )?>
                    
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-flat btn-sm btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-sm btn-flat btn-danger',
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
                'username',
                'email:email',
                [
                    'attribute' => 'status',
                    'value' => function($model){
                        return \app\models\UserStatus::getName($model->status);
                    }
                ],                
                [
                    'attribute' => 'role',
                    'value' => function($model){
                        return \app\models\Role::getName($model->role);
                    }
                ],
                [
                    'attribute' => 'current_saldo',
                    'format' => 'currency'
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
        if($providerOrder->totalCount){
            $gridColumnOrder = [
                ['class' => 'yii\grid\SerialColumn'],
                    ['attribute' => 'id', 'visible' => false],
                                'order_time',
                    'total_price',
                    'is_payed',
                    'step',
            ];
            echo Gridview::widget([
                'dataProvider' => $providerOrder,
                'pjax' => true,
                'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-order']],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Order'),
                ],
                'columns' => $gridColumnOrder
            ]);
        }
        ?>

    </div>
</div>
