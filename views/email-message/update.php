<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmailMessage */

$this->title = 'Update Email Message: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-message-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
