<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @author Nenad Zivkovic <nenad@freetuts.org>
 * 
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@themes';

    public $css = [
        'css/bootstrap.min.css',
        'css/noty.css',
        'css/themes/mint.css',
        'css/style.css',
        'css/bootstrap-datetimepicker.min.css'
    ];

    public $js = [
        'js/noty.min.js',
        'js/socket.io.js',
        'js/bootstrap-datetimepicker.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'dmstr\web\AdminLteAsset'
    ];
}
