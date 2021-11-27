<?php

use app\models\LookUp;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LookUp */
/* @var $form ActiveForm */
?>

<div class="look-up-form">
    <?php $form = ActiveForm::begin([
            'id' => 'look-up-form'
    ]); ?>

    <?= $form->field($model, 'type')->widget(Select2::classname(), [
        'data' => LookUp::getLookUpsvalue('lookup'),
        'options' => [
            'placeholder' => 'Select...',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>


    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropdownList([ 1 => 'Active', 0 => 'Inactive'], ['prompt' => 'Select Status']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-block pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
