<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .custom-shit{
        margin-top: 60px;
        padding-left: 40px;
        padding-right: 40px;
        box-shadow: 2px 12px 30px -15px rgba(133,133,133,1);
    }
</style>

<div class="site-login">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 panel panel-default custom-shit">
            <div class="row">
                <div class="col-md-12" align="center" style="margin-top: 30px">
                    <img src="/img/logo.png">
                </div>
            </div>

            <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

            <p style="text-align: center">Please fill out the following fields to login:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'labelOptions' => ['class' => 'control-label'],
                ],
            ]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'type'=>'email']) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
            ]) ?>

            <div class="form-group" style="margin-bottom: 60px">
<!--                <div class="col-lg-offset-1 col-lg-11">-->
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
<!--                </div>-->
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
