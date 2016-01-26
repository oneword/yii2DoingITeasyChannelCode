<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
//use kartik\editable\Editable;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\branchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        <?= Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    
    <p>
        <?= Html::button('Create Branches', ['value'=>Url::to('index.php?r=branches/create'),'class' => 'btn btn-success','id'=>'modalButton']) ?>
    </p>
    <?php 
        Modal::begin([
            'header'=>'<h4> Branches </h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
            
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
    
    
    

    <?php //Pjax::begin(['id'=>'branchesGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
        'pjax'=>true,
        'rowOptions'=>function ($model){
            if ($model->branch_status=='inactive'){
                return ['class'=>'danger'];
            }else if ($model->branch_status=='active'){
                return ['class'=>'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'companies_company_id',
                'value'=>'companiesCompany.company_name'
            ],
            [
              'class'=>'kartik\grid\EditableColumn',
                'header'=>'改标题：Branch',
                'attribute'=>'branch_name',//要修改哪一个字段
                'value'=>function ($model){
                    return '我是默认字： '.$model->branch_name;//弹出来后默认显示这个字段的内容
               }
            ],
            //'branch_id',
            'companiesCompany.company_name',
            'branch_name',
            'branch_address',
            'branch_create_data',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php //Pjax::end(); ?>

</div>
