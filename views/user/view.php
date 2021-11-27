<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->first_name.' '.$model->last_name ;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <p>
        <?= Html::button('Edit User', [
            'class' => 'btn btn-success showModalButton',
            'value' => Url::to(['user/update','id' => $model->id]),
            'title' => 'Edit User'
        ]) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            'date_created',
            'date_modified',
            'password',
            'auth_key',
        ],
    ]) ?>

</div>
