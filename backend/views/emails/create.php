<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Emails */

$this->title = 'Create Emails';
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emails-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
