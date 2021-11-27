<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmailDraft */

$this->title = 'Create Email Draft';
$this->params['breadcrumbs'][] = ['label' => 'Email Drafts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-draft-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
