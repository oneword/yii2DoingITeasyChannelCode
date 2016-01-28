<?php
namespace backend\components;
use yii\base\Behavior;


class CheckIfLofgedIn extends Behavior{
    
    public function events(){
        return [
            //http://www.yiiframework.com/doc-2.0/guide-concept-behaviors.html
            //ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            \yii\web\Application::EVENT_BEFORE_REQUEST => 'checkIfLoggedIn',
        ];
    }
    
    
    public function checkIfLoggedIn(){
        if (\Yii::$app->user->isGuest) {
            //echo 'guest';
        }else{
            //echo 'login';
        }
        //die;
    }
    
    
}

?>