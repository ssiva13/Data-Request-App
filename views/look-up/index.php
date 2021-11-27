<?php

use kartik\grid\DataColumn;
use kartik\grid\GridView;
use kartik\grid\ActionColumn;
use kartik\grid\SerialColumn;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\LookUpSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Look Ups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="look-up-index">
    <p>
        <?= Html::button('Create Look Up', [
                'class' => 'btn btn-success showModalButton',
                'value' => Url::to(['look-up/create']),
                'title' => 'Create Look Up'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            [
                'attribute' => 'value',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '10%',
                'format' => 'raw',
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'class' => DataColumn::class,
                'vAlign' => 'middle',
            ],
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
            [
                'format' => 'raw',
                'class' => DataColumn::class,
                'header' => 'Actions',
                'hAlign' => 'center',
                'width' => '10%',
                'vAlign' => 'middle',
                'value' => function($model) {
                    return
                        Html::button(Icon::show('edit'), [
                            'type' => 'button',
                            'title' => 'Update ' . ucfirst($model->name),
                            'class' => 'm-2 btn-transition border-0 btn btn-primary showModalButton',
                            'value' =>  Url::to(['/look-up/update', 'id' => $model->id])
                        ]). ' '.
                        Html::button(Icon::show('eye'), [
                            'type' => 'button',
                            'title' => 'View ' . ucfirst($model->name),
                            'class' => 'm-2 btn-transition border-0 btn btn-info showModalButton',
                            'value' =>  Url::to(['/look-up/view', 'id' => $model->id])
                        ]);
                }
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
