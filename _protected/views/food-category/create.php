<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FoodCategory */

$this->title = 'Create Food Category';
$this->params['breadcrumbs'][] = ['label' => 'Food Category', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
