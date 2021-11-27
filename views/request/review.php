<?php

use yii\helpers\Html;
use app\models\LookUp;
use kartik\date\DatePicker;
use kartik\markdown\MarkdownEditor;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;

/* @var $this \yii\web\View */
/* @var $model \app\models\Request */


$this->title = 'Update Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-update">
    <div class="request-form">

        <?php $form = ActiveForm::begin([
            'id' => 'review-form'
        ]); ?>
        <?php if($model->status == 1): ?>
            <?= $form->field($model, 'review_notes')->widget(MarkdownEditor::classname(), ['height' => 200, 'encodeLabels' => false]) ?>
        <?php endif; ?>
        <?= $form->field($model, 'status')->widget(Select2::classname(), [
            'data' => LookUp::getLookUpsvalue('request_status'),
            'options' => [
                'placeholder' => 'Select Status',
                'disabled' => false,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
