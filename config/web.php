<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'shop',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Gleb',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                // При добавлении функции, добавляем сюда ее. [метод] [/api/...] => [названия contoller]/[название функции] k-viganovsky.xn--80ahdri7a.site
                'POST register' => 'user/create',                           // Регистрация
                'POST login' => 'user/login',                               // Авторизация
                'GET games' => 'games/games',                               // Получить список всех игр
                'GET game/<id_game:\d+>' => 'games/game',                  // Получить одну игру
                'POST orders/add/<id_game:\d+>' => 'orders/add',            // Купить видеоигру
                'DELETE orders/delete/<order_id:\d+>' => 'orders/delete',    // Удаление из корзины !!!
                'POST game/add' => 'games/add',                            // Добавление игры в систему
                'DELETE game/delete/<id_game:\d+>' => 'games/delete',      // Удаление игры из системы
                'POST game/update/<id_game:\d+>' => 'games/update',        // Изменение данных об игре 
                'GET user/<id_user:\d+>' => 'user/user',                    // Получение данных пользователя
                'GET users' => 'user/users',                                // Получения данных всех пользователей
                'GET user/orders/<id_user:\d+>' => 'user/orders',           // Просмотр корзины !!!
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
