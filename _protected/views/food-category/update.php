<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FoodCategory */

$this->title = 'Update Food Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Food Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="food-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
