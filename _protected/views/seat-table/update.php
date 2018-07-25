<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SeatTable */

$this->title = 'Update Seat Table: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Seat Table', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seat-table-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
