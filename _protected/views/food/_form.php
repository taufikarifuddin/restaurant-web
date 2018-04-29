<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Food */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'FoodImage', 
        'relID' => 'food-image', 
        'value' => \yii\helpers\Json::encode($model->foodImages),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['placeholder' => 'Price']) ?>

    <?= $form->field($model, 'category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\FoodCategory::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Food category'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('FoodImage'),
            'content' => $this->render('_formFoodImage', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->foodImages),
            ]),
        ]
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-flat btn-sm btn-success' : 'btn btn-flat btn-sm btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-flat btn-sm  btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
