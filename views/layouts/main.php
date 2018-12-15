<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="/js/tinymce/tinymce.min.js"></script>
<!--    <script src="/js/ckeditor5/ckeditor.js"></script>-->
    <script>tinymce.init({
            selector:'textarea',
            plugins : 'advlist autolink link lists print preview',
            theme: 'modern',
            skin : "light"
        });</script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">

        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/img/logo_sm_t.png" width="100" class="pull-left"/>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default',
                'style' => 'background-color:#AED6F1; box-shadow: 0px 16px 16px -12px rgba(0,0,0,0.16); margin-top:-60px'
            ],
            'innerContainerOptions' => ['class' => 'container-fluid',]
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Posts', 'url' => ['/site/posts']],
                ['label' => 'About', 'url' => ['/site/about']],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->name . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>


        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Chathura Madushan <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
