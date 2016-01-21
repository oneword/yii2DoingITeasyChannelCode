<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;
use yii\base\Object;
use backend\models\AuthAssignment;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    
    public $permissions;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['first_name', 'required' ,'message'=>'必填'],
            ['last_name', 'required'],
            
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup(){
        if ($this->validate()) {
            $user = new User();
            
            $user->first_name=$this->first_name;
            $user->last_name=$this->last_name;
            
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            $user->save();
            //添加权限
            $permissionList=$_POST['SignupForm']['permissions'];
            foreach ($permissionList as $value){
                $newPermission = new AuthAssignment();
                $newPermission->user_id=$user->id;
                $newPermission->item_name=$value;
                $newPermission->save();
                print_r($newPermission->getErrors());
            }//die;
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
