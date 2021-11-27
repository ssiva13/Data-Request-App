<?php

use app\models\LookUp;
use Carbon\Carbon;
use kartik\grid\DataColumn;
use kartik\icons\Icon;
use yii\grid\SerialColumn;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\ProjectSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Request Information';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <p>
        <?= Html::button('Create Data Request', [
            'class' => 'btn btn-success showModalButton',
            'value' => Url::to(['project/create']),
            'title' => 'Create Data Request'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'project_name',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'width' => '10%',
                'format' => 'raw',
            ],
            [
                'attribute' => 'data_type',
                'format' => 'raw',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter'=> LookUp::getLookUpsvalue('data_type'),
                'filterInputOptions' => ['placeholder' => 'Select...'],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'value' => static function($model){
                    $label = '';
                    if($model->data_type){
                        foreach ($model->data_type as $data_type){
                            $data = ArrayHelper::getValue(LookUp::getLookUpsvalue('data_type'), $data_type);
                            $label.= '<span class="badge badge-info">'. $data .'</span>';
                        }
                    }
                    return $label;
                }
            ],
            [
                'attribute' => 'proposal_type',
                'format' => 'raw',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter'=> LookUp::getLookUpsvalue('proposal_type'),
                'filterInputOptions' => ['placeholder' => 'Select...'],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'value' => static function($model){
                    $label = '';
                    if($model->proposal_type){
                        $data = ArrayHelper::getValue(LookUp::getLookUpsvalue('proposal_type'), $model->proposal_type);
                        $label.= '<span class="badge badge-primary">'. $data .'</span>';
                    }
                    return $label;
                }
            ],
            [
                'attribute' => 'date_created',
                'header' => 'Date Submitted',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'model' => $searchModel,
                    'startAttribute' => 'date_created_start',
                    'endAttribute' => 'date_created_end',
                    'presetDropdown' => true,
                    'pluginOptions' => [
                        'autoclose' => true,
                    ]
                ],
                'value' => static function($model) {
                    return Carbon::parse($model->date_created)->rawFormat('D, M j, Y');
                }
            ],
            [
                'attribute' => 'fk_user',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'header' => 'Responsible User',
                'width' => '8%',
                'format' => 'raw',
                'filterType' => GridView::FILTER_SELECT2,
                'filter'=> \app\models\User::getUserList(),
                'filterInputOptions' => ['placeholder' => 'Select...'],
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'value' => static function($model){
                        return '<span class="badge badge-warning">'. $model->primaryContact->first_name .' '.$model->primaryContact->last_name .'</span>';
                }
            ],
            [
                'attribute' => 'target_date',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => static function($model) {
                    return Carbon::parse($model->target_date)->rawFormat('D, M j, Y');
                }
            ],
            [
                'header' => 'Status',
                'format' => 'raw',
                'class' => DataColumn::class,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_SELECT2,
                'filter'=> LookUp::getLookUpsvalue('request_status'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Select...'],
                'value' => static function($model){
                    if($model->fkRequests){
                        $label = '';
                        foreach ($model->fkRequests as $fkRequest){
                            $data = ArrayHelper::getValue(LookUp::getLookUpsvalue('request_status'), $fkRequest->status);
                            $label.= '<span class="badge badge-'.$model->statusBadges($fkRequest->status).' btn-lg">'.  $data .'</span>';
                        }
                        return $label;
                    }
                    return '';
                }
            ],
            [
                'format' => 'raw',
                'class' => DataColumn::class,
                'width' => '15%',
                'header' => 'Actions',
                'hAlign' => 'center',
                'vAlign' => 'middle',
                'value' => static function($model) {
                    return
                        Html::button(Icon::show('edit').' Edit/Update', [
                            'type' => 'button',
                            'title' => 'Update ' . ucfirst($model->project_name),
                            'class' => 'm-2 btn-transition border-0 btn btn-warning showModalButton',
                            'value' =>  Url::to(['/project/update', 'id' => $model->id])
                        ]). ' '.
                        Html::a(Icon::show('eye'). ' View', Url::to(['/project/details', 'id' => $model->id]), [
                            'class' => 'm-2 btn-transition border-0 btn btn-info',
                            'title' => 'View Project Details'
                        ]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
