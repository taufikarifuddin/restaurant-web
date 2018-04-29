<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FoodImage */

$this->title = 'Create Food Image';
$this->params['breadcrumbs'][] = ['label' => 'Food Image', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
