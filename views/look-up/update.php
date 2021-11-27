<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LookUp */

$this->title = 'Update Look Up: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Look Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="look-up-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
