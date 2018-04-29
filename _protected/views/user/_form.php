<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'Order', 
        'relID' => 'order', 
        'value' => \yii\helpers\Json::encode($model->orders),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="row">
    <div class="user-form col-md-12">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Username']) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
        <?php if( $model->isNewRecord ){ ?>
        <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true, 'placeholder' => 'Password Hash']) ?>

        <?= $form->field($model, 'rePassword')->passwordInput(['maxlength' => true, 'placeholder' => 'Password Hash']) ?>        
        <?php }else{ ?>
        <?= $form->field($model, 'status')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\UserStatus::getList(), 'id', 'name'),
            'options' => ['placeholder' => 'Choose Status'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>        
        <?php } ?>
        <?= $form->field($model, 'role')->widget(\kartik\widgets\Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\app\models\Role::getList(), 'id', 'name'),
            'options' => ['placeholder' => 'Choose Role'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-flat btn-sm btn-success' : 'btn btn-flat btn-sm btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-flat btn-sm btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>    