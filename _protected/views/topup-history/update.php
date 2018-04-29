<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TopupHistory */

$this->title = 'Update Topup History: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Topup History', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topup-history-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
