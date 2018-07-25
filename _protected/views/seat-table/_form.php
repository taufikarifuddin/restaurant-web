<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SeatTable */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="seat-table-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'seat_table_number')->textInput(['placeholder' => 'Seat Table Number']) ?>

    <?php
   
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-flat btn-sm btn-success' : 'btn btn-flat btn-sm btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
