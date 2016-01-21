<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\branchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            //'branch_id',
            'companiesCompany.company_name',
            'branch_name',
            'branch_address',
            'branch_create_data',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
