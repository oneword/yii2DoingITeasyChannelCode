<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PoItem */

$this->title = 'Update Po Item: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Po Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="po-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
