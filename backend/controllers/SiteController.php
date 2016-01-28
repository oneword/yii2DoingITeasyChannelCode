<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','set-cookie','show-cookie'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 设置和读取cookie
     */
    public function actionSetCookie(){
        $cookie=new yii\web\Cookie([
            'name'=>'cookiename',
            'value'=>'cookievalue',
        ]);
        \Yii::$app->getResponse()->getCookies()->add($cookie);
        
    }
    
    public function actionShowCookie(){
        if (\Yii::$app->getRequest()->getCookies()->has('cookiename')) {
            print_r(\Yii::$app->getRequest()->getCookies()->getValue('cookiename'));;
        }
    }
    
    public function actionIndex()
    {
        //$lkrValue=Yii::$app->MyComponent->currencyConvert('USD','LKR',100);
        //print_r($lkrValue);
        return $this->render('index');
    }

    public function actionLogin(){
        
        $this->layout='loginLayout';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
