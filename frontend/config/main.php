<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'language'=>'zh-CN',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'content',
    //'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'smser' => [
            // 阿里大鱼
            'class' => 'common\libs\dayu\Factory',

        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager'=>[
            'bundles'=> [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ]
            ]
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
           // 'showScriptName' => false,
           // 'suffix'=>'.html',
            'rules' => [
                'lists/<catid:\d+>' => 'content/default/lists',
                'page/<catid:\d+>' => 'content/default/page',
                'category/<catid:\d+>' => 'content/default/category',
                'show/<id:\d+>' => 'content/default/show',
                'mod/<name:\w+>/<act:\w+>' => 'content/default/mod',
            ]
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'qq' => [
                    'class' => 'common\libs\oauth\QqAuth',
                    'clientId' => '101025224',
                    'clientSecret' => 'e32dc540e7ec93f492d01b7467595f08',

                ],
                'weibo' => [
                    'class' => 'common\libs\oauth\WeiboAuth',
                    'clientId' => '700127874',
                    'clientSecret' => '78a9682a92e203c328e040c0e1d40b69',
                ],
//                'baidu' => [
//                    'class' => 'common\libs\oauth\BaiduAuth',
//                    'clientId' => '700127874',
//                    'clientSecret' => '78a9682a92e203c328e040c0e1d40b69',
//                ],
                'weixin' => [
                    'class' => 'common\libs\oauth\WeixinAuth',
                    'clientId' => '111',
                    'clientSecret' => '111',
                ],
//                'renren' => [
//                    'class' => 'common\libs\oauth\RenrenAuth',
//                    'clientId' => '111',
//                    'clientSecret' => '111',
//                ],
//                'douban' => [
//                    'class' => 'common\libs\oauth\DoubanAuth',
//                    'clientId' => '111',
//                    'clientSecret' => '111',
//                ],
//                'weixin-mp' => [
//                    'class' => 'common\libs\oauth\WeixinMpAuth',
//                    'clientId' => '111',
//                    'clientSecret' => '111',
//                ],
            ]
        ]

    ],
    /* 模块配置 */
    'modules' => [
        'home' => [
            'class' => 'frontend\modules\home\Module',
            'defaultRoute'=>'default/index'
        ],
        'content' => [
            'class' => 'frontend\modules\content\Module',
            'defaultRoute'=>'default/index',

        ],
        'member' => [
            'class' => 'frontend\modules\member\Module',
            'defaultRoute'=>'default/index'
        ],
        'install' => [
            'class' => 'frontend\modules\install\Module',
            'defaultRoute'=>'default/index'
        ],

    ],
    'params' => $params,
];
