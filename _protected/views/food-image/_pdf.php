<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\FoodImage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Food Image', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-image-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Food Image'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
                'attribute' => 'food.name',
                'label' => 'Food'
            ],
        'img',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>
