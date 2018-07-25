<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Booking'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
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
        'id',
        [
            'attribute' => 'noMeja.id',
            'label' => 'No Meja',
        ],
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
        'starttime',
        'endtime',
        'is_available',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>SeatTable<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnSeatTable = [
        'id',
        'seat_table_number',
        [
            'attribute' => 'user.username',
            'label' => 'User',
        ],
    ];
    echo DetailView::widget([
        'model' => $model->noMeja,
        'attributes' => $gridColumnSeatTable    ]);
    ?>
    <div class="row">
        <h4>User<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUser = [
        'id',
        'username',
        'email',
        'password_hash',
        'status',
        'auth_key',
        'password_reset_token',
        'account_activation_token',
        'role',
        'current_saldo',
    ];
    echo DetailView::widget([
        'model' => $model->user,
        'attributes' => $gridColumnUser    ]);
    ?>
</div>
