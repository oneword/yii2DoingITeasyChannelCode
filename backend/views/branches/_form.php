<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName()]); ?>

    <!--<?= $form->field($model, 'companies_company_id')->textInput() ?>-->
    <!--<?= $form->field($model,'companies_company_id')->dropDownList(
        ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
        ['prompt'=>'Please choose company']
     ); ?>-->
    
    <?=
        $form->field($model, 'companies_company_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Companies::find()->all(), 'company_id', 'company_name'),
            'language' => 'en',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    
    
    
    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

    
    
    
    
    <!--<?= $form->field($model, 'branch_create_data')->textInput() ?>--> 
    <?= $form->field($model, 'branch_create_data')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false, 
             // modify template for custom rendering
            
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>
    
    
    <?= $form->field($model, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
$('form#{$model->formName()}').on('beforeSubmit',function(e){
    var \$form=$(this);
    $.post(
        \$form.attr('action'),
        \$form.serialize()
    ).done(function(result){
        //console.log(result);
        if(result==1){
            $(document).find('#modal').modal('hide');
            $(\$form).trigger("reset");
            $.pjax.reload({container:'#branchesGrid'});
        }else{
            $(\$form).trigger("reset");
            $("#message").html(result);
        }
    }).fail(function(){
        console.log("server error");    
    });
    return false;
});

JS;
$this->registerJs($script);
?>






