<?php

use yii\helpers\Html;
//use yii\grid\GridView;

//use kartik\editable\Editable;
//use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\base\Widget;

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
            'options'=>[
                'tabindex'=>false,//抱歉，因为代码都是跟随视频做的，这个地方视频中没有指明：如果用modal方式，不加这句代码，会出现搜索框有但无法选中的bug，开始我以为是z-index的原因，后来去官网看了一下，原来modal方式要加这句话，“important for Select2 to work properly”，but，我发现，把浏览器的窗口缩小到一定程度，还是会出现无法选中input的情况
        ],
            'header'=>'<h4> Branches </h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
            
        ]);
        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
    
    
    <!-- 下载文件 -->
    <?php 


    $gridColumns = [
        'companiesCompany.company_name',
        'branch_name',
        [
            'attribute'=>'branch_name',
            'label'=>'自定义头标题（用branch_name的数据）',
            'vAlign'=>'middle',
            'width'=>'500px',
            'value'=>function ($model, $key, $index, $widget) {
                return Html::a($model->branch_name, '#', []);
            },
            'format'=>'raw'
        ],
        'branch_address',
        'branch_create_data',
        'branch_status',
        
    ];
    
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
        'dropdownOptions' => [
            'label' => 'Export All',

        ]
    ]);

    
    
    
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
