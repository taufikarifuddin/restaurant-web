<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Booking */

$this->title = 'Update Booking: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="booking-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
