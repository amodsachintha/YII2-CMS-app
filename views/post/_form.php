<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')
        ->dropDownList(
            ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'title')
        )
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 16]) ?>

    <div class="form-group">
        <?=
         Select2::widget([
            'name' => 'tags',
            'options' => [
                'placeholder' => 'enter tags..',
                'multiple' => true
            ],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 20
            ],
        ]);
        ?>
        <small>*separate each tag with a comma(,)</small>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
