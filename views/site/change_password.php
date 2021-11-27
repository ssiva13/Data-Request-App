<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\ChangePasswordForm */

$this->title = 'Change Password';
?>

<div class="">
    <div class="container">
        <!-- main content -->
        <div class="agile_info">
            <div class="w3l_form">
                <div class="left_grid_info">
                    <h1>Data Request App App</h1>
                        <p>Some Description</p>
                        <?=Html::img('@web/img/guest.jpg')?>
                </div>
            </div>
            <div class="w3_info">
                <h2>Change Password</h2>
                <p>Enter your new password .</p>
                <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'id' => 'change-password-form'
                ]); ?>

                <?= $form->field($model, 'password')->passwordInput(['required' => true, 'placeholder' => 'Enter password']) ?>

                <?= $form->field($model, 'confirm_password')->passwordInput(['required' => true, 'placeholder' => "Confirm Password"]) ?>

                <?= Html::submitButton('Change Password', ['class' => 'btn btn-danger btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <!-- //main content -->
    </div>
</div>