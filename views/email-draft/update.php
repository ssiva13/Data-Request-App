<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmailDraft */

$this->title = 'Update Email Draft: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Drafts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-draft-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
