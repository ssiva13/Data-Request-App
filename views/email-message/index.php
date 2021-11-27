<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\search\EmailMessageSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Email Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-message-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'subject',
            'body:ntext',
            'from',
            'to',
            'date_sent',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
