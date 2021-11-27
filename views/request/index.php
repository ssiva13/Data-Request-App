<?php

use app\models\LookUp;
	use app\models\Project;
	use app\models\User;
	use kartik\grid\DataColumn;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\RequestSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">
    <p>
        <?= Html::button('Create Data Request', [
            'class' => 'btn btn-success pull-right  showModalButton',
            'value' => Url::to(['request/create', 'id' => $searchModel->fk_project]),
            'title' => 'Create Data Request'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'fk_project',
                'class' => 'kartik\grid\DataColumn',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => Project::getUserProjectList(),
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'prompt' => 'Select Project'
                ],
                'contentOptions' => [
                    'vAlign' => 'middle',
                    'hAlign' => 'left',
                    'class' => 'kartik-sheet-style',
                    'width' => '90px'
                ],
                'format' => 'raw',
                'value' => static function($model){
                    return $model->fkProject->project_name;
                }
            ],
            [
                'attribute' => 'fk_user',
                'class' => 'kartik\grid\DataColumn',
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filter' => User::getUserList(),
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'prompt' => 'Select User'
                ],
                'contentOptions' => [
                    'vAlign' => 'middle',
                    'hAlign' => 'left',
                    'class' => 'kartik-sheet-style',
                    'width' => '90px'
                ],
                'format' => 'raw',
                'value' => static function($model){
                    return '<span class="badge badge-warning">'. $model->fkUser->first_name .' '.$model->fkUser->last_name .'</span>';
                }
            ],
            'data_variables:ntext',
            'data_crfs:ntext',
            [
                'attribute' => 'data_sites',
                'format' => 'raw',
                'value' => static function($model){
                    $label = '';
                    if($model->data_sites){
                        foreach ($model->data_sites as $data_sites){
                            $data = ArrayHelper::getValue(LookUp::getLookUpsvalue('data_sites'), $data_sites);
                            $label.= '<span class="badge badge-info">'. $data .'</span>';
                        }
                    }
                    return $label;
                }
            ],
            'variable_justification:ntext',
            'date_from',
            'date_to',
            'date_received',

            [
                'format' => 'raw',
                'class' => DataColumn::class,
                'header' => 'Actions',
                'hAlign' => 'center',
                'width' => '15%',
                'vAlign' => 'middle',
                'value' => function($model) {
                    return
                        Html::button(Icon::show('edit'), [
                            'type' => 'button',
                            'title' => 'Update Request',
                            'class' => 'm-2 btn-transition border-0 btn btn-warning showModalButton',
                            'value' =>  Url::to(['/request/update', 'id' => $model->id])
                        ]).' '.
                        Html::button(Icon::show('eye'), [
                            'type' => 'button',
                            'title' => 'View Request Details',
                            'class' => 'm-2 btn-transition border-0 btn btn-primary showModalButton',
                            'value' =>  Url::to(['/request/view', 'id' => $model->id])
                        ]);
                }
            ],
            [
                'format' => 'raw',
                'class' => DataColumn::class,
                'header' => 'Review/Approve',
                'hAlign' => 'center',
                'width' => '5%',
                'vAlign' => 'middle',
                'value' => function($model) {
                    $data = ArrayHelper::getValue(LookUp::getLookUpsvalue('request_status'), $model->status);
                    if($model->status == 2 || $model->status == 4 || $model->status == 5){
                        return
                            Html::button($data, [
                                'type' => 'button',
                                'title' => $data,
                                'class' => 'm-2 btn-transition border-0 btn btn-'. $model->fkProject->statusBadges($model->status) .' disabled',
                            ]);
                    }elseif($model->status == 3){
                        return
                            Html::button('Approve', [
                                'type' => 'button',
                                'title' => 'Approve',
                                'class' => 'm-2 btn-transition border-0 btn btn-'. $model->fkProject->statusBadges($model->status) .' showModalButton',
                                'value' =>  Url::to(['/request/review', 'id' => $model->id])
                            ]). ' '.
                            Html::button($data, [
                                'type' => 'button',
                                'title' => $data,
                                'class' => 'm-2 btn-transition border-0 btn btn-warning disabled',
                            ]);
                    }
                    return
                        Html::button('Review', [
                            'type' => 'button',
                            'title' => 'Review',
                            'class' => 'm-2 btn-transition border-0 btn btn-'. $model->fkProject->statusBadges($model->status) .' showModalButton',
                            'value' =>  Url::to(['/request/review', 'id' => $model->id])
                        ]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
