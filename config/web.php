<?php
use \kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name'=>'Syspex Internal Network Application (syspex.co.id)',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', function(){
        Yii::$app->attachBehavior('access',[
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                //'admin/*', // add or remove allowed actions to this list
                //'site/*',
                //'user/*',
            ]
        ]);
    },],
    'modules' => [
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
             
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd-MM-yyyy',
                Module::FORMAT_TIME => 'HH:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm:ss',
                //Module::FORMAT_DATETIME => 'php:d-m-Y H:i:s',
            ],
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                //Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
             
            // set your display timezone
            'displayTimezone' => 'Asia/Jakarta',
             
            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
            // use ajax conversion for processing dates from display format to save format.
            //'ajaxConversion' => true,
             
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'yii\jui\DatePicker', // example
                    'options' => [
                        'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
            // other settings
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'components' => [
                'manager' => [
                    'class' => 'dektrium\user\Module',
                    // Active record classes
                    'userClass'    => 'dektrium\user\models\User',
                    'tokenClass'   => 'dektrium\user\models\Token',
                    'profileClass' => 'dektrium\user\models\Profile',
                    'accountClass' => 'dektrium\user\models\Account',
                    // Model that is used on user search on admin pages
                    'userSearchClass' => 'dektrium\user\models\UserSearch',
                    // Model that is used on registration
                    'registrationFormClass' => 'dektrium\user\models\RegistrationForm',
                    // Model that is used on resending confirmation messages
                    'resendFormClass' => 'dektrium\user\models\ResendForm',
                    // Model that is used on logging in
                    'loginFormClass' => 'dektrium\user\models\LoginForm',
                    // Model that is used on password recovery
                    'recoveryFormClass' => 'dektrium\user\models\RecoveryForm',
                    // Model that is used on requesting password recovery
                    'recoveryRequestFormClass' => 'dektrium\user\models\RecoveryRequestForm',
                ],
            ],
            'enableUnconfirmedLogin' => false,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['timothy']
        ],
        'admin' => [
            'layout' => 'left-menu', // default null. other avaliable value 'right-menu' and 'top-menu'
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    'idField' => 'id', // id field of model User
                ]
            ],
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
        /*'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',

            // format settings for displaying each date attribute
            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            // format settings for saving each date attribute
            'saveSettings' => [
                'date' => 'Y-m-d', 
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,
        ],*/
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            /*'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'sales-request'],
            ],*/
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
            'defaultRoles' => ['Guest'],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Mz_uXkboAo4-2_7HASRbd7oEFSDjIYzy',
            /*'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],*/
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.syspex.co.id',
                'username' => 'notification@syspex.co.id',
                'password' => 'sianok',
                'port' => '26',
                'encryption' => 'tls',
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
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
    ],
    /*'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'admin/*', // add or remove allowed actions to this list
            //'site/*',
            //'user/*',
        ]
    ],*/
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
    $config['modules']['gii']['class'] = 'yii\gii\Module';
    $config['modules']['gii']['generators'] = [
        'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
    ];
}

return $config;
