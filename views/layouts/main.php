<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
$this->registerJsFile('/assets/customjs/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>


<div class="wrap">
    <div class="container">

        <?php
        NavBar::begin([
             'brandLabel' => Html::img('@web/assets/img/smart_guard_logo2.png', ['alt'=>'SmartGuard', 'style' => 'max-height: 45px; margin-top: -12px;']),
            //'brandLabel' => 'SmartGuard',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'SmartGuard', 'url' => '/'],
                ],

            ]);

        //$cookies = Yii::$app->request->cookies;
        //$language = $cookies->getValue('contractLang');
        $language = $_COOKIE['contractLang'];
        \Yii::info('contractLang '.$language);
        //задаём пунты меню в зависимости от роли пользователя
        $items = [];
        if (Yii::$app->user->identity->role == User::ROLE_ADMIN  && Yii::$app->user->identity->status == User::STATUS_ACTIVE) {

            $items[] = ['label' => 'Export', 'url' => ['/contracts/export']];
            $items[] = ['label' => 'Users', 'url' => ['/user']];
        }
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $items[] = ['label' => 'Contracts', 'url' => ['/contracts']];
            $items[] = '<li class="dropdown">
                <a id="lang-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" >'
                .(($language == 'ru') ? 'Русский' : 'Română') .' <b class="caret"></b></a>
                <ul class="dropdown-menu">
                <li><a href="#" class="lang-item" data-lang="ro">Română</a></li>
                <li><a href="#" class="lang-item" data-lang="ru">Русский</a></li>
                 </ul>
                </li>';
            $items[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>' ;
        }


        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $items,
        ]);
        NavBar::end();
        ?>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; SmartGuard <?= date('Y') ?></p>

        <div id="copyright-pixelplus" style="width: 225px;height:60px;float:right; margin-top: -13px;">
            <?php if(isset($this->params['homePage']) &&  $this->params['homePage']) : ?>
                <div id="copyright-img-first" style="float:left;width: 40px; ">
                    <a href="http://www.pixelplus.ru/" target="pixel"><img src="http://vorota-pik.pixelproject.ru/wp-content/uploads/2016/10/pixelplus-red.png" border="0" height="45" alt="Компания «ПиксельПлюс»" title="Компания «ПиксельПлюс»"
                    /></a>
                </div>
                <div id="copyright-text-first" style="width: 175px;padding-left: 8px;float: right;color: #000;text-align: left;font-family: Arial, Helvetica;font-size: 12px;">
                    <a href="http://www.pixelplus.ru/" target="pixel">Создание сайта</a> &mdash;<br>
                        компания «Пиксель Плюс»
                </div>
            <?php else : ?>
            <div id="copyright-img-second" style="float:left;width: 40px;">
                <a href="http://www.pixelplus.ru/" target="pixel"><img src="http://vorota-pik.pixelproject.ru/wp-content/uploads/2016/10/pixelplus-red.png" border="0"
                height="45" alt="Компания «Пиксель Плюс»" title="Компания «Пиксель Плюс»"
                /></a>
            </div>
            <div id="copyright-text-second" style="width: 175px;padding-left: 8px;float: right;color: #000;text-align: left;font-family: Arial, Helvetica;font-size: 12px;">
                Создание сайта &mdash;<br/>
                компания «Пиксель Плюс»
            </div>
            <?php endif; ?> 
        <div>
    </div>
</footer>

<?php $this->endBody() ?>
<!--<script src="http://coock.visermort.ru/script/2"></script>-->
<!--<script src="http://yiicoocking:81/script/2"></script>-->
</body>
</html>
<?php $this->endPage() ?>

