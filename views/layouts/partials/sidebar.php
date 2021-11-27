<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\icons\Icon;

?>
<div class="app-sidebar sidebar-shadow bg-heavy-rain sidebar-text-dark side-bar-toggle">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">
                    Requests Management
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-home"></i> All Requests', Url::to(['/project/index']))?>
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-microscope"></i> Under Review Requests', Url::to(['/project/index', 'status' => 1]))?>
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-pause"></i> Pending Approval Requests', Url::to(['/project/index', 'status' => 3]))?>
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-check-double"></i> Approved Requests', Url::to(['/project/index', 'status' => 4]))?>
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-archive"></i> Archived Requests', Url::to(['/project/index', 'status' => 'archive']))?>
                </li>
                <li class="app-sidebar__heading">
                    Application Settings
                </li>
                <li>
                    <?= Html::a('<i class="metismenu-icon fa fa-users-cog"></i> Settings', Url::to(['/user/details']), ['class' => ''])?>
                </li>
            </ul>
        </div>
    </div>
</div>
