<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TopupHistory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Topup History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-history-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Topup History'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'user_id',
        'nominal',
        'topup_date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
