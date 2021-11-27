<?php

use kartik\grid\DataColumn;
use kartik\icons\Icon;
use kartik\grid\ActionColumn;
use kartik\grid\SerialColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::button('Create User', [
            'class' => 'btn btn-success showModalButton',
            'value' => Url::to(['user/create']),
            'title' => 'Create User'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'phone',
            //'date_created',
            //'date_modified',
            //'password',
            //'auth_key',

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
                            'title' => 'Update ' . ucfirst($model->first_name). ' '. ucfirst($model->first_name),
                            'class' => 'm-2 btn-transition border-0 btn btn-primary showModalButton',
                            'value' =>  Url::to(['/user/update', 'id' => $model->id])
                        ]). ' '.
                        Html::button(Icon::show('eye'), [
                            'type' => 'button',
                            'title' => 'View ' . ucfirst($model->first_name). ' '. ucfirst($model->first_name),
                            'class' => 'm-2 btn-transition border-0 btn btn-info showModalButton',
                            'value' =>  Url::to(['/user/view', 'id' => $model->id])
                        ]);
                }
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
