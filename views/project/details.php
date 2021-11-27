<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\rbac\Item;
use yii\web\YiiAsset;
use kartik\tabs\TabsX;
use kartik\icons\Icon;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = 'Data Request Details';
$this->params['view-description'] = 'Data Request Details';
$this->params['view-icon'] = 'pe-7s-settings';
$this->params['view-actions'] = [
];
$this->registerJs("$(function(){
    $('#config_tabs li').filter('.active').find('a').click();});");
?>

<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav" id="tab-nav">
    <li class="nav-item" >
        <?=Html::a('<span>Details</span>', Url::to(['/project/view', 'id' => $model->id]), ['class' => 'nav-link active'])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>Data Requests</span>', Url::to(['/request/project', 'id' => $model->id]), ['class' => 'nav-link '])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>People With Access To Data</span>', Url::to(['/data-accessor/request', 'id' => $model->id]), ['class' => 'nav-link'])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>Messages and Notifications</span>', Url::to(['/email-message/request', 'id' => $model->id]), ['class' => 'nav-link'])?>
    </li>
</ul>
<div class="tab-content">
    <div class="tabs-animation fade" id="ajax-content">
    </div>
</div>