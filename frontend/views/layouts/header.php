<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?=
    Html::a('<span class="logo-mini">' .
            'DG'
            . '</span><span class="logo-lg">'
            . '<img style="width:55%;" src="' . Yii::$app->urlManager->createUrl('..' . Yii::$app->params['rutaBaseLogo'] . 'datum_position.png') . '" class="">' .
            '</span>', Yii::$app->homeUrl, ['class' => 'logo'])
    ?>
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="fa fa-user-circle-o"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <span class="fa fa-user-circle-o" style="font-size: 40px;color: #fff;"></span>
                            <p>
                                <?php echo Yii::$app->user->identity->name ?>
                                <small>Usuario desde <?php echo Yii::$app->user->identity->created_at ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!--                        <li class="user-body">
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Followers</a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Sales</a>
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <a href="#">Friends</a>
                                                    </div>
                                                </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Mi perfil</a>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        'Salir', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!--                <li>
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li>-->
            </ul>
        </div>
    </nav>
</header>
