
<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?= Yii::getAlias("@resource/user-image.jpg") ?>" alt="username">
    </div>
    <div class="pull-left info">
        <p>username</p>

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
$menuItems[] = [
    #'url' => '#',
    'icon' => 'cog',
    'label' => 'Master',
    'items' => $developerMenuItems,
];
$menuItems[] = [
    'url' => ['/operation/chef'],
    'icon' => 'user',
    'label' => 'Koki',
];
$menuItems[] = [
    'url' => ['/operation/cashier'],
    'icon' => 'money',
    'label' => 'Kasir',
];

echo dmstr\widgets\Menu::widget([
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
