<?php

use app\models\LoginForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model LoginForm */

$this->title = 'Sign In';
?>

<div class="signupform">
    <div class="container">
        <!-- main content -->
        <div class="agile_info">
            <div class="w3l_form">
                <div class="left_grid_info">
                    <h1>Data Request App</h1>
                    <p> Description </p>
                    <?=Html::img('@web/img/guest.jpg')?>
                </div>
            </div>
            <div class="w3_info">
                <h2>Login to your Account</h2>
                <p>Enter your details to login.</p>
                <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['enctype' => 'multipart/form-data']
                ]); ?>

                <label>Username/Email</label>
                <?= $form->field($model, 'username')->textInput(['required' => true, 'placeholder' => 'Enter your username'])->label(false) ?>

                <label>Password</label>
                <?= $form->field($model, 'password')->passwordInput(['required' => true, 'placeholder' => "Enter your Password"])->label(false) ?>

                <div class="login-check">
                    <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Remember me</label>
                </div>
                <?= Html::submitButton('Login', ['class' => 'btn btn-info btn-block', 'name' => 'login-button']) ?>
                <?php ActiveForm::end(); ?>
                <p class="account">By clicking login, you agree to our <a href="#">Terms & Conditions!</a></p>
            </div>
        </div>
        <!-- //main content -->
    </div>
</div>
