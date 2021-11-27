<?php

use Carbon\Carbon;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->project_name;
$this->params['view-description'] = substr($model->project_aim, 0, 200). '...';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['view-actions'] = [
    [
        'type' => 'button',
        'content' => Html::a(Icon::show('edit') . ' Update '. $model->project_name, Url::to(['project/update' , 'id' => $model->id]), [
            'title' => ' Update '. $model->project_name,
            'class' => 'mr-2 text-decoration-none',
        ])
    ],
];

\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'project_name',
            'primary_contact',
            'project_aim',
//            'data_type',
            'proposal_type',
            'irb_approved',
//            'irb_approvers',
            'statistical_file',
            [
                'attribute' => 'target_date',
                'value' => static function($model) {
                    return Carbon::parse($model->target_date)->rawFormat('D, M j, Y');
                }
            ],
            'milestones',
            [
                'attribute' => 'fk_user',
                'value' => static function($model){
                    return $model->fkUser->first_name. ' '. $model->fkUser->last_name;
                }
            ],
            [
                'attribute' => 'date_created',
                'value' => static function($model) {
                    return Carbon::parse($model->date_created)->rawFormat('D, M j, Y');
                }
            ],
            [
                'attribute' => 'date_modified',
                'value' => static function($model) {
                    return Carbon::parse($model->date_modified)->rawFormat('D, M j, Y');
                }
            ],
        ],
    ]) ?>

    <p>
        <?= Html::button('Update Data Request', [
            'class' => 'btn btn-info pull-right btn-lg showModalButton',
            'value' => Url::to(['update', 'id' => $model->id]),
            'title' => 'Update Data Request'
        ]) ?>
    </p>
</div>
