<?php

use kartik\grid\ActionColumn;
use kartik\grid\DataColumn;
use kartik\grid\SerialColumn;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\EmailDraftSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Drafts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-draft-index">

    <p>
        <?= Html::button('Create Email Draft', [
            'class' => 'btn btn-success showModalButton',
            'value' => Url::to(['/email-draft/create']),
            'title' => 'Create Email Draft'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            'type',
            'subject',
            'body:ntext',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter'=> [ 1 => 'Active', 0 => 'Inactive'],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'value' => static function($model){
                    return \yii\helpers\ArrayHelper::getValue([ 1 => 'Active', 0 => 'Inactive'], $model->status, '');
                }
            ],

            ['class' => ActionColumn::class],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
