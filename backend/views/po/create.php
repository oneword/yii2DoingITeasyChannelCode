<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Po */

$this->title = 'Create Po';
$this->params['breadcrumbs'][] = ['label' => 'Pos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPoItem'=>$modelsPoItem,
    ]) ?>

</div>
