<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LookUp */

$this->title = 'Create Look Up';
$this->params['breadcrumbs'][] = ['label' => 'Look Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-up-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
