<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->registerJsFile('@web/js/goods.js', ['depends' => 'yii\web\YiiAsset']);
?>

<main class="container_login">
    <div class="d-flex justify-content-center h-100" >
        <div class="card_login">
            <div class="card-body">
                <?php if (Yii::$app->session->hasFlash('message')): ?>
                    <?php echo '<div class="form-group control-label line">' . Yii::$app->session->getFlash('message') . '</div>'; ?>
                <?php endif; ?>

                <?php $form = ActiveForm::begin([   'options' => [
                                                    'id' => 'addForm',
                                                    'class' => 'form-group line']]) ?>
                <?= $form->field($modelGoods, 'user_id')->hiddenInput('', $modelGoods->user_id) ?>
                <?= $form->field($modelGoods, 'name')->input('text', ['placeholder' => "Enter name"]) ?>
                <?= Html::submitButton('Добавить', ['class' => 'btn regist_btn']) ?>
                <?php $form = ActiveForm::end() ?>
            </div>
        </div>
    </div>
</main>