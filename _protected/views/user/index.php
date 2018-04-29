<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-sm btn-flat btn-success']) ?>
    </p>
    <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'username',
        'email:email',
        [  
            'attribute' => 'status',
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\UserStatus::getList(), 'id', 'name'),
            'value' => function($model){
                return \app\models\UserStatus::getName($model->status);
            }
        ],
        [  
            'attribute' => 'role',
            'filter' => \yii\helpers\ArrayHelper::map(\app\models\Role::getList(), 'id', 'name'),
            'value' => function($model){
                return \app\models\Role::getName($model->role);
            }
        ],
        [
            'attribute' => 'current_saldo',
            'format' => 'currency' 
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-user']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
           
        ],
    ]); ?>

</div>
