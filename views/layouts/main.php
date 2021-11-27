<?php
/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\web\View;

Icon::map($this);

AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= Url::base().'/favicon.ico' ?>" type="image/x-icon">
    <link rel="icon" href="<?= Url::base().'/favicon.ico' ?>" type="image/x-icon">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?php if (Yii::$app->session->hasFlash('success')):?>

<?php elseif (Yii::$app->session->hasFlash('error')):?>

<?php endif; ?>


<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar">
    <?= $this->render('partials/top-header', []); ?>
    <div class="app-main">
        <?= $this->render('partials/sidebar', []); ?>
        <div class="app-main__outer">
            <div class="app-main__inner">
                <?= $this->render('partials/title-section', ['title' => $this->title]); ?>
                <?= $content ?>
            </div>
            <div class="app-wrapper-footer">
                <?=$this->render('partials/footer', []); ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'main-modalmodalHeader', 'class' => 'bg-heavy-rain in'],
    'id' => 'main-modal',
    'size' => Modal::SIZE_LARGE,
    'options' => ['class' => 'modal fade'],
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'tag' => 'button',
        'data-dismiss' => 'modal',
    ],
    'clientOptions' => [
        'backdrop' => 'static',
        'keyboard' => false,
    ],
    'footer' => '&copy; '.date('Y'),
    'footerOptions' => ['id' => 'main-modalmodalFooter', 'class' => 'text-center bg-heavy-rain'],
]);
echo "
    <div id='modalContent' style='max-height: 500px; overflow-y: auto; overflow-x: hidden;'>
        <div style='text-align:center'>".Html::img('@web/img/radio.gif')."</div>
    </div>";
Modal::end();
?>
