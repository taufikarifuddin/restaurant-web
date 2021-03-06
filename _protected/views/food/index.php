<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\widgets\SwitchInput;

$this->title = 'Food';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="food-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if( \app\models\Role::adminRole(Yii::$app->user->identity->role) ): ?>
    <p>
        <?= Html::a('Create Food', ['create'], ['class' => 'btn btn-flat btn-sm btn-success']) ?>
    </p>
    <?php endif; ?>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'id', 'visible' => false],
        'name',
        'detail:ntext',
        'price',
        [
                'attribute' => 'category',
                'label' => 'Category',
                'value' => function($model){
                    if ($model->category0)
                    {return $model->category0->name;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\FoodCategory::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Food category', 'id' => 'grid-food-search-category']
            ],
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => function($model){
                    return \app\models\FoodStatus::getName($model->status);
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\FoodStatus::getList(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Status', 'id' => 'grid-food-search-status']
            ],
            [
                'label' => 'Update Food ',
                'format' => 'raw',
                'value' => function($model){
                    // Adjust handle width for longer labels
                    return SwitchInput::widget([
                        'value' => $model->status == 1 ? true : false,
                        'name' => \yii\helpers\Html::getInputName($model,'status'),
                        'options' => [ 
                            'class' => 'toggle-status',
                            'data-id' => $model->id,
                            'id' => 'data-'.$model->id
                        ],                       
                        'pluginOptions'=>[
                            'onText'=>'Ready',
                            'offText'=>'Empty',
                        ],
                        'pluginEvents' => [
                            "switchChange.bootstrapSwitch" => "function() { 
                                var id = $(this).data('id');
                                $.ajax({
                                    url : '".\yii\helpers\Url::to(['food/update-food'])."',
                                    data : { id : id },
                                    type : 'post',
                                    success : function(response){
                                        if( response){
                                            var elem = $('tr[data-key=\"'+id+'\"] td[data-col-seq=\"7\"]');

                                            if( elem.text() == 'AVAILABLE' ) {
                                                elem.text('NOT AVAILABLE');
                                            }else{
                                                elem.text('AVAILABLE');
                                            }
                                        }  
                                        console.log(response);
                                    }
                                });
                             }"
                        ]
                    ]);
//                    return $model->status;
                },
            ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => \app\models\Role::adminRole(Yii::$app->user->identity->role) ? "{update} {view} {delete}" : ""
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-food']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
           
        ],
    ]); ?>

</div>
