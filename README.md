
由于国内的yii2学习视频太少，所以才有了这个根据youtube的DoingITeasyChannel视频而来的项目。


youtube视频地址：https://www.youtube.com/watch?v=z1xtFbO9jgQ

或百度网盘分享：

地址：http://pan.baidu.com/s/1o6RW6Jg 密码：vmxi 

或 ： http://pan.baidu.com/s/1kUoxQJX

目前已更新至52集，后期如果youtube更新，网盘将同步更新


其中包含了每节课的代码和数据库等内容（sorry，从第10节课开始的，但是包含第10节前面advanced的内容,未包含

base的任何东西）。

其中第39、40集的视频所用的后台模板为免费模板，我用的是一个收费模板（虽然我也不是买的），如果谁想使

用，可以发邮件给我。

视频为全套，代码更新至第50集，剩余的两节视频是两种国际化语言设置，希望各位yii developers自己动手写

完，毕竟不能只看

不写，多写写还是有好处的。


请clone项目后，请执行：composer update 或者 php composer.phar update

**注意：视频中用到了大量的第三方扩展库，会导致某些问题：

1、因第三方扩展库随时会更新、修复，所以composer也许会出现新的依赖等意外情况，请按照composer的错误提

示解决，谢谢。


2、扩展库会自动引入js与css，或许会造成与html模板的js和css冲突，视频中未说明如何解决，如果各位yii 

developers有好的解

决办法，希望你能在回复里贡献你的方法。

OK，第二个问题，过了个周末，我找到解决的方法了，在此公布分享出来，在你的配置文件里面写入下面的配置项：

    'components' => [
        'assetManager' => [
            'assetMap' => [
                'bootstrap.js' => '@web/js/bootstrap.min.js',
            ],
        ],
    ]

'bootstrap.js' => '@web/js/bootstrap.min.js'，这句话的意思是页面用到的资源文件bootstrap.js，全部用web目录下面的js目录下面的bootstrap.min.js替换，从而放弃使用bootstrap.js，这样的话，一个页面就只会调用一个bootstrap.min.js了。

其它的具体的属性值可以查看：http://www.yiiframework.com/doc-2.0/yii-web-assetmanager.html

**

希望大家共同努力，共同学习。

```
**Congratulations

Have a good day**
```









Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
