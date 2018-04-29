<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TopupHistory */

$this->title = 'Create Topup History';
$this->params['breadcrumbs'][] = ['label' => 'Topup History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topup-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
