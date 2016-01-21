<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = 'Update Customers: ' . ' ' . $model->composer_id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->composer_id, 'url' => ['view', 'id' => $model->composer_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
