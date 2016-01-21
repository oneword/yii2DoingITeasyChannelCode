<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Locations */

$this->title = 'Create Locations';
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
