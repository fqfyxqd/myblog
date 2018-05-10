<?php

$params = require(__DIR__ . '/params.php');
Yii::$classMap['PHPExcel']='@app/libs/PHPExcel.php';
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '343dfdgrtjyumk',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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

        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ' '=>'cn/index/index',
                '/index.html'=>'cn/index/index',
                'edit.html'=>'cn/editor/add',
                'details/<id:\d+>.html' => 'cn/editor/details',// 模考通知页面
            ],
        ],

    ],
    'params' => $params,
    'modules' => [
        'cn' => [
            'class'=>'app\modules\cn\CnModule'
        ],
        'basic' => [
            'class'=>'app\modules\basic\BasicModule'
        ],
        'content' => [
            'class'=>'app\modules\content\ContentModule'
        ],
        'user' => [
            'class'=>'app\modules\User\UserModule'
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
