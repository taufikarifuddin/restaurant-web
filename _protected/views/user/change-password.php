<?php

use yii\bootstrap\ActiveForm;
$this->title = "Change Password";
?>

<div class="user-form">
   
    <?php if(Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-error alert-dismissable">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>    
    <?php } ?>
   <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'oldPassword')->passwordInput(['placeholder' => 'Old Password']) ?>
    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'New Password']) ?>
    <?= $form->field($model, 'rePassword')->passwordInput(['placeholder' => 'Re-Type Password']) ?>
  
    <button id="confirm-topup" class="btn btn-flat btn-sm btn-primary">Update</button>
   <?php ActiveForm::end(); ?>

</div>
 