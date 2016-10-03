<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules'=>[
        'tree'=>[
            'class'=>'\common\modules\tree\Module'
        ]
    ],
    'components' => [
        'image' => [
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@data/cache',
        ],

        'formatter' => [
            'dateFormat' => 'yy年MM月dd日',
            'datetimeFormat' => 'yy年MM月dd日H时i分',

            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RMB',
        ],

    ],
];
