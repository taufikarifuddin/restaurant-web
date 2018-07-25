<?php

use app\models\Role;
?>
<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?= Yii::getAlias("@resource/user-image.jpg") ?>" alt="username">
    </div>
    <div class="pull-left info">
        <p><?= Yii::$app->user->identity->username ?></p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>



<?php

// prepare menu items, get all modules
$menuItems = [];

$favouriteMenuItems[] = ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']];


$developerMenuItems = [];
$developerMenuItems[] = [
    'url' => ['/user/index'],
    'icon' => 'user',
    'label' => 'User',
];
$developerMenuItems[] = [
    'url' => ['/food-category/index'],
    'icon' => 'list',
    'label' => 'Category',
];
$developerMenuItems[] = [
    'url' => ['/food/index'],
    'icon' => 'apple',
    'label' => 'Food',
];
$developerMenuItems[] = [
    'url' => ['/seat-table/index'],
    'icon' => 'table',
    'label' => 'Seat Table',
];
$menuItems[] = [
    #'url' => '#',
    'icon' => 'cog',
    'label' => 'Master',
    'items' => $developerMenuItems,
    'visible' => Role::adminRole(Yii::$app->user->identity->role)
];

$menuItems[] = [
    'url' => ['/food/index'],
    'icon' => 'apple',
    'label' => 'Food',
    'visible' => Role::cashierRole(Yii::$app->user->identity->role) 
];


$menuItems[] = [
    'url' => ['/user/topup'],
    'icon' => 'money',
    'label' => 'Topup Saldo',
    'visible' => Role::cashierRole(Yii::$app->user->identity->role) 
];

$menuItems[] = [
    'url' => ['/operation/table'],
    'icon' => 'cutlery',
    'label' => 'Seat Table',
    'visible' => Role::cashierRole(Yii::$app->user->identity->role) 
];

$menuItems[] = [
    'url' => ['/operation/cashier'],
    'icon' => 'cart-plus',
    'label' => 'Kasir',
    'visible' => Role::cashierRole(Yii::$app->user->identity->role) 
];
$menuItems[] = [
    'url' => ['/operation/chef'],
    'icon' => 'cart-plus',
    'label' => 'Koki',
    'visible' => Role::chefRole(Yii::$app->user->identity->role)
];

echo dmstr\widgets\Menu::widget([
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
