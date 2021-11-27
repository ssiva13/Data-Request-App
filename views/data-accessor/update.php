<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataAccessor */

$this->title = 'Update Data Accessor: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Data Accessors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-accessor-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
