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

$this->title = 'Settings';
$this->params['view-description'] = 'System Application Settings';
$this->params['view-icon'] = 'pe-7s-settings';
$this->params['view-actions'] = [
];
$this->registerJs("$(function(){
    $('#config_tabs li').filter('.active').find('a').click();});");
?>

<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav" id="tab-nav">
    <li class="nav-item" >
        <?=Html::a('<span>Question Look Up Values</span>', Url::to(['/look-up/index']), ['class' => 'nav-link active'])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>Users List</span>', Url::to(['/user/index']), ['class' => 'nav-link '])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>Message Drafts</span>', Url::to(['/email-draft/index']), ['class' => 'nav-link'])?>
    </li>
    <li class="nav-item">
        <?=Html::a('<span>User Profile</span>', Url::to(['/user/view', 'id' => Yii::$app->user->identity->id]), ['class' => 'nav-link'])?>
    </li>
</ul>
<div class="tab-content">
    <div class="tabs-animation fade" id="ajax-content">
    </div>
</div>