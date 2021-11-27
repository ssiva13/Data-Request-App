<?php

use app\models\LookUp;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin([
            'id' => 'request-form'
    ]); ?>

    <?= $form->field($model, 'fk_project')->widget(Select2::classname(), [
        'data' => \app\models\Project::getUserProjectList(),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => false,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'primary_contact')->widget(Select2::classname(), [
        'data' => \app\models\User::getUserList(),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => false,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'data_variables')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>

    <?= $form->field($model, 'data_crfs')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>

    <?= $form->field($model, 'data_sites')->widget(Select2::classname(), [
        'data' => LookUp::getLookUpsvalue('data_sites'),
        'options' => [
            'placeholder' => 'Select...',
            'multiple' => true,
            'disabled' => false,
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'variable_justification')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>

    <?= $form->field($model, 'date_from')->widget(DatePicker::className(),[
        'removeButton' => false,
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'date_to')->widget(DatePicker::className(),[
        'removeButton' => false,
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'date_received')->widget(DatePicker::className(),[
        'removeButton' => false,
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
