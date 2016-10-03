<?php

namespace common\widgets\CategoryContent;

use yii\web\AssetBundle;

class CategoryAsset extends AssetBundle
{
    public $sourcePath = '@webroot/statics';
    public $sourceUrl = '@web/statics';
    public $js = [
        'admin/js/jquery.cookie.js',
        'admin/js/jquery.treeview.js',

    ];
    public $css =[
        'admin/css/jquery.treeview.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
