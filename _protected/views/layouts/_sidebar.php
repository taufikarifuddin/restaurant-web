<?php

?>

<!-- Sidebar user panel -->
<div class="user-panel">
    <div class="pull-left image">
        <?php echo \cebe\gravatar\Gravatar::widget(
            [
                'email' => 'username@example.com',
                'options' => [
                    'alt' => 'username',
                ],
                'size' => 64,
            ]
        ); ?>
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
    'url' => ['/test/koki'],
    'icon' => 'user',
    'label' => 'Koki',
];
$menuItems[] = [
    'url' => ['/test/kasir'],
    'icon' => 'money',
    'label' => 'Kasir',
];

echo dmstr\widgets\Menu::widget([
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
