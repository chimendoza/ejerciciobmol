<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YKhIj0kUownPaqOL_-bd6zt8wpdz8Bmz',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'multipart/form-data' => 'yii\web\MultipartFormDataParser',
            ],
            'class' => 'yii\web\Request',
            'enableCsrfValidation' => false,
            'enableCookieValidation' => false,
            'enableCsrfCookie' => false,
            

        ],

        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                $response->headers->set('Access-Control-Allow-Origin', '*');
                $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT,PATCH,DELETE,OPTIONS');
                $response->headers->set('Access-Control-Allow-Headers', 'Authorization, Content-Type');
                $response->headers->set('Cache-Control', 'no-cache');
            



            },
        ],


        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => false,
            'loginUrl' => null,
            'enableAutoLogin' => false,
            'identityCookie' => null,

        ],        

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
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
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [


                $params['api_prefix'].'/auth/<action:[\w\-]+>' => 'auth/<action>',
                $params['api_prefix'].'/pagos/obtenercatalogos' => 'pago/obtenercatalogos',

                ['class' => 'yii\rest\UrlRule', 
                'controller' => 'usuario',
                'prefix'=>$params['api_prefix']
                ],

                ['class' => 'yii\rest\UrlRule', 
                'controller' => 'cuenta',
                'prefix'=>$params['api_prefix']
               ],

               ['class' => 'yii\rest\UrlRule', 
               'controller' => 'tipopago',
               'prefix'=>$params['api_prefix']
                ],
               ['class' => 'yii\rest\UrlRule', 
               'controller' => 'pago',
               'prefix'=>$params['api_prefix']
               ]


            ],
        ],

        
    ],
    'params' => $params,


    'on beforeAction'=>function($event){//la validación del JWT se realiza en este evento

        $action=$event->action;
        $controller_id=$action->controller->id;
        $action_id=$action->id;




        $user = Yii::$app->user;
        //obtener el token de autorización del encabezado de la petición
        $token = Yii::$app->request->headers->get('Authorization');




    },


    //Este código es para permitir las peticiones pre-flight de CORS que envía el navegador y evitar el error de CORS
    'on beforeRequest' => function () {

        if(Yii::$app->request->isOptions){

            Yii::$app->response->statusCode=200;
            
            Yii::$app->response->send();
            Yii::$app->end();
        }

    },




];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1','*'],
    ];
}

return $config;
