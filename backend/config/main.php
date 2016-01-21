<?php
/*
 * rbac 
 * Table:
 * `auth_assignment`，`auth_item_child`，`auth_item` 
 * `auth_item`                        ：设置所有的操作选项，
 * `auth_item_child`               ：将`auth_item`的选项进行搭配分级，一个选项一对多的关系
 * `auth_assignment`             ：将`auth_item_child`的一级选项分配一个user id
 * 最后执行代码操作
 */
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'settings' => [
            'class' => 'backend\modules\settings\Setting',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        
        //邮件
        'mailer'=>[
            'class'=>'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
            'transport' => [  
                'class' => 'Swift_SmtpTransport',  
                'host' => 'smtp.sina.com',  //每种邮箱的host配置不一样
                'username' => 'yourmail@sina.com',  
                'password' => 'yourpassword',  
                'port' => '25',
                'encryption' => 'tls',
             ],
            'messageConfig'=>[
                'charset'=>'UTF-8',
                'from'=>['yourmail@sina.com'=>'Test yii2 send mailer']
            ],
        ],
        //RBAC权限控制
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'defaultRoles'=>['guest'],
        ],
        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
