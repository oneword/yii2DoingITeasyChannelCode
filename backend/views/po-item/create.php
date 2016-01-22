<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PoItem */

$this->title = 'Create Po Item';
$this->params['breadcrumbs'][] = ['label' => 'Po Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
