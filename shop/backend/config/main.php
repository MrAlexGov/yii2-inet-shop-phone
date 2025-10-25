<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'dashboard/index',
                'dashboard' => 'dashboard/index',
                'products' => 'product/index',
                'products/create' => 'product/create',
                'products/update/<id:\d+>' => 'product/update',
                'products/view/<id:\d+>' => 'product/view',
                'products/delete/<id:\d+>' => 'product/delete',
                'products/export' => 'product/export',
                'products/import' => 'product/import',
                'orders' => 'order/index',
                'orders/view/<id:\d+>' => 'order/view',
                'orders/update/<id:\d+>' => 'order/update',
                'users' => 'user/index',
                'users/create' => 'user/create',
                'users/update/<id:\d+>' => 'user/update',
                'users/delete/<id:\d+>' => 'user/delete',
            ],
        ],
    ],
    'params' => $params,
];
