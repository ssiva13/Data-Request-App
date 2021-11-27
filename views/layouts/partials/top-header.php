<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="app-header header-shadow bg-asteroid header-text-light">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div class="" data-content="Click here to collapse the sidebar menu" title="Sidebar">
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="open-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div class="" data-content="Click here to collapse the sidebar menu" title="Sidebar">
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
    <div class="app-header__content">
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="p-0 btn">
                                    <?= Html::img('@web/img/icons8-user-48.png', ['width' => '42', 'class' => 'rounded-circle']) ?>
                                </a>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                <?= Html::a(
                                    'Sign out( '. Yii::$app->user->identity->first_name. ' '. Yii::$app->user->identity->last_name . ' )',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'text-light']
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>