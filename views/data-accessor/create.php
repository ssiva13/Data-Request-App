<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DataAccessor */

$this->title = 'Create Data Accessor';
$this->params['breadcrumbs'][] = ['label' => 'Data Accessors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-accessor-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
