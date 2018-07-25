<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SeatTable */

$this->title = 'Create Seat Table';
$this->params['breadcrumbs'][] = ['label' => 'Seat Table', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seat-table-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
