<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\search\ProjectSeacrh */
/* @var $form ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_name') ?>

    <?= $form->field($model, 'primary_contact') ?>

    <?= $form->field($model, 'project_aim') ?>

    <?= $form->field($model, 'data_type') ?>

    <?php // echo $form->field($model, 'proposal_type') ?>

    <?php // echo $form->field($model, 'irb_approved') ?>

    <?php // echo $form->field($model, 'irb_approvers') ?>

    <?php // echo $form->field($model, 'statistical_file') ?>

    <?php // echo $form->field($model, 'target_date') ?>

    <?php // echo $form->field($model, 'milestones') ?>

    <?php // echo $form->field($model, 'fk_user') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
