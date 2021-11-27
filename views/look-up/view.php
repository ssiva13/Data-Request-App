<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LookUp */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Look Ups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="look-up-view">

    <p>
        <?= Html::button('Edit Look Up', [
            'class' => 'btn btn-success showModalButton',
            'value' => Url::to(['look-up/update','id' => $model->id]),
            'title' => 'Edit Look Up'
        ]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'value',
            'name',
            'status',
        ],
    ]) ?>

</div>
