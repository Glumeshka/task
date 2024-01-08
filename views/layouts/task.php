<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
	<head>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
	</head>
    <?php $this->beginBody() ?>

    <!-- <div class='wrap'>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Goods</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>            
        </div>
    </div>    -->

    <?= $content ?>

    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>