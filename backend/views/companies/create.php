<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Companies */

$this->title = 'Create Companies';
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'branch' => $branch,
    ]) ?>

</div>
