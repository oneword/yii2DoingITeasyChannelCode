<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>-->

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'options'=>['class'=>'m_t'],
    'fieldConfig'=>[
        'labelOptions'=>['class'=>'form_control'],
    ]
]); ?>

    
        <?= $form->field($model, 'username',['options'=>[
            'tag'=>'div',
            'class'=>'form-group'
        ]] )->textInput(['placeholder' => '请填写用户名']) ?>
    
    
    <div class="form-group">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => '请填写密码']) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </div>
   
    
    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary block full-width m-b', 'name' => 'login-button']) ?>
    </div>
    <a href=""><small>Forgot password?</small></a>
    <p class="text-muted text-center"><small>Do not have an account?</small></p>
    <a class="btn btn-sm btn-white btn-block" href="">Create an account</a>
<?php ActiveForm::end(); ?>

            
            
            
            
            
            