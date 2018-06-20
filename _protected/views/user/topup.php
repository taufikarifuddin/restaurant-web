<?php
    
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use \kartik\select2\Select2;

    $this->title = "User Topup" 
?>

<div class="user-form">
   

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'userId')->widget(Select2::classname(), [
            'data' => $data,
            'options' => ['placeholder' => 'Select a user  ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'saldo')->textInput(['maxlength' => true, 'placeholder' => 'Saldo']) ?>
    </div>

    <div>
        <button id="confirm-topup" class="btn btn-flat btn-sm btn-primary">Topup</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$js = "
        $(function(){
            $('#confirm-topup').click(function(e){
                e.preventDefault();
                var formId = $(this).closest('form').attr('id');
                if( window.confirm('Apakah anda yakin ingin melakukan topup ? periksa kembali, topup tidak dapat dibatalkan') ){ 
                    $('#'+formId).submit();
                }
            })
        })
";

$this->registerJs($js);

