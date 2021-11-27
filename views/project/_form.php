<?php

use app\models\LookUp;
use app\models\User;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'id' => 'project-form',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primary_contact')->widget(Select2::classname(), [
        'data' => User::getUserList(),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => false,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'project_aim')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>

    <?= $form->field($model, 'data_type')->widget(Select2::classname(), [
        'data' => LookUp::getLookUpsvalue('data_type'),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => true,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'proposal_type')->widget(Select2::classname(), [
        'data' => LookUp::getLookUpsvalue('proposal_type'),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => false,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'irb_approved')->widget(Select2::classname(), [
        'data' => LookUp::getLookUpsvalue('yesno'),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => false,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'irb_approvers')->widget(Select2::classname(), [
        'data' => User::getUserList(),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => true,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <?= $form->field($model, 'statistical_file')->fileInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_date')->widget(DatePicker::className(),[
            'removeButton' => false,
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
    ]) ?>

    <?= $form->field($model, 'milestones')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
