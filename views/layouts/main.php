<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;

/* @var $this \yii\web\View */
/* @var $content string */
use mdm\admin\components\MenuHelper;
use kartik\icons\Icon;
Icon::map($this, Icon::BSG);

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link type="image/x-icon" href="<?php echo \Yii::$app->request->BaseUrl."/images/icon/favicon.ico.png"; ?>" rel="icon">
    <link type="image/x-icon" href="<?php echo \Yii::$app->request->BaseUrl."/images/icon/favicon.ico.png"; ?>" rel="shortcut icon">

    <link rel="apple-touch-icon" href="<?php echo \Yii::$app->request->BaseUrl."/images/icon/syspex_kemasindo_ios_icon.png"; ?>"/>
    <link rel="icon" type="image/png" href="<?php echo \Yii::$app->request->BaseUrl."/images/icon/syspex_kemasindo_ios_icon.png"; ?>">

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<img src="'.\Yii::$app->request->BaseUrl.'/images/icon/syspex_kemasindo_logo.png" class="img-responsive" alt="Responsive image" style="margin-top: -11px;" width="80%">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $usermenu = [
                [
                    'label' => Icon::show('user'), 
                    'url' => ['/site/about'],
                    'linkOptions' => ['data-method' => 'post'],
                    'items'=>[
                        'label'=>'test2',
                        'url'=>['site/index'],
                    ],
                ],
            ];

            if(Yii::$app->user->isGuest)
            {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Sign up', 'url' => ['/user/registration/register']],
                        ['label' => 'Login', 'url' => ['/user/security/login']],
                    ],
                ]);
            }
            else
            {
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    //'items' => $usermenu,
                    'items' => [
                        ['label' => Icon::show('user'), 'url' => '#', 'items'=>[
                            ['label' => 'My Profile', 'url' => ['/user/profile']],
                            ['label' => 'Account Settings', 'url' => ['/user/settings']],
                            '<li class="divider"></li>',
                            ['label'=>Icon::show('log-out').'Log out', 'url'=>['/user/security/logout'], 'linkOptions'=>['data-method' => 'post']]
                        ]],
                    ],
                    'encodeLabels' => false,

                    /*[
                        [
                            //'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'label' => $items,
                            'url' => ['/user/security/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                            'encodeLabels' => false,
                        ],
                    ],*/
                ]);
            }

            /*echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    //['label' => 'Home', 'url' => ['/site/index']],
                    //['label' => 'About', 'url' => ['/site/about']],
                    //['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/user/security/login']] :
                        ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/user/security/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ],
            ]);*/
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ],
            ]);

            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p style="text-align: center;">&copy; PT. Syspex Kemasindo <?= date('Y') ?>
            </br>Bangunan Industri Multiguna, Bumi Serpong Damai Blok H1 No.22, BSD Sektor XI- Serpong, Tangerang 15310, Indonesia

            </br><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> +62 21 75875140 | F +62 21 75875141 | <a href="http://www.syspex.com" style="text-decoration: none;">www.syspex.com</a> | <a href="http://www.yellowbox.com" style="text-decoration: none;">www.yellowbox.com</a>
            </p>
            <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
