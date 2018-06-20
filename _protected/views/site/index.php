<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php if( Yii::$app->session->hasFlash('success') ){ ?>
            <div class="alert alert-success alert-dismissable">
            <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php }?>
        <h1>Welcome!</h1>
        <p class="lead">The nice day to work :) </p>
    </div>
</div>

