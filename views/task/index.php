<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerJsFile('@web/js/login.js', ['depends' => 'yii\web\YiiAsset']);
?>

<main class="container_login">
    <div class="d-flex justify-content-center h-100" >
        <div class="card_login">
            <div class="card-header">
                <ul class="d-flex justify-content-center title">
                    <li><a href="#" class="btn btn-primary btn-lg active log_btn" role="button" aria-pressed="true" id="showLogin">Вход</a>
                    <li><a href="#" class="btn btn-secondary btn-lg active reg_btn" role="button" aria-pressed="true" id="showRegistr">Регистрация</a>
                </ul>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin([   'options' => [
                                                    'id' => 'loginForm', 
                                                    'class' => 'form-group line']]) ?>
                <?= $form->field($modelLogin, 'email')->input('email', ['placeholder' => "Enter Your Email"]) ?>
                <?= $form->field($modelLogin, 'password')->input('password', ['placeholder' => "Enter Your password"]) ?>
                <?= Html::submitButton('Войти', ['class' => 'btn login_btn']) ?>                
                <?php $form = ActiveForm::end() ?>

                <?php $form = ActiveForm::begin([   'options' => [
                                                    'id' => 'registrForm',
                                                    'class' => 'form-group line',
                                                    'hidden' => 'hidden']]) ?>
                <?= $form->field($modelSing, 'email')->input('email', ['placeholder' => "Enter Your Email"]) ?>
                <?= $form->field($modelSing, 'password')->input('password', ['placeholder' => "Enter Your password"]) ?>
                <?= $form->field($modelSing, 'password2')->input('password', ['placeholder' => "Confirm Your password"]) ?>
                <?= Html::submitButton('Зарегистрировать', ['class' => 'btn regist_btn']) ?>
                <?php $form = ActiveForm::end() ?>
            </div>
        </div>
    </div>
</main>