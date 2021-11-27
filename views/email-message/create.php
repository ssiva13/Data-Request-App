<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmailMessage */

$this->title = 'Create Email Message';
$this->params['breadcrumbs'][] = ['label' => 'Email Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-message-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
