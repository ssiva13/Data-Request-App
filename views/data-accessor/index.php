<?php

use kartik\grid\ActionColumn;
use app\models\User;
use kartik\grid\SerialColumn;
use kartik\grid\DataColumn;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\DataAccessorSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Accessors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-accessor-index">

    <p>
        <?= Html::button('Create Data Accessor', [
            'class' => 'btn btn-success pull-right  showModalButton',
            'value' => Url::to(['data-accessor/create', 'id' => $searchModel->fk_request]),
            'title' => 'Create Data Accessor'
        ]) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => SerialColumn::class],
            'name',
            'email:email',

            'role',
            'affiliation',
            //'date_created',
            //'date_modified',

            ['class' => ActionColumn::class],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
