<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <!--<?= $form->field($model, 'company_created_date')->textInput() ?>-->
    
    <?= $form->field($model, 'file')->fileInput(); ?>
    
    <?= $form->field($model, 'company_created_date')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false,
             // modify template for custom rendering
            
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>

    <?= $form->field($model, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    ------------------------------------------------------------------------------下面是branch---------------------------------------------------------------------------------------------
    <!-- ------------------------------------------------------------------为这一个copany新建branch----------------------------------------------------------------------  -->
    <!--<?= $form->field($branch, 'companies_company_id')->textInput() ?>-->
    <!--<?= $form->field($branch,'companies_company_id')->dropDownList(
        ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
        ['prompt'=>'Please choose company']
     ); ?>-->
    <!--<?=
        $form->field($branch, 'companies_company_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>-->
    
    <?= $form->field($branch, 'branch_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($branch, 'branch_address')->textInput(['maxlength' => true]) ?>
    <!--<?= $form->field($branch, 'branch_create_data')->textInput() ?>--> 
    <?= $form->field($branch, 'branch_create_data')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false, 
             // modify template for custom rendering
            
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>
    <?= $form->field($branch, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>
    <!-- -------------------------------------------------------------------------------------------------------------------- -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
