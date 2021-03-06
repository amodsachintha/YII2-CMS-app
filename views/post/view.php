<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
if(Yii::$app->user->isGuest){
    $this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['site/posts']];
}else{
    $this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <p>
        <?= Yii::$app->user->isGuest ? '' : Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Yii::$app->user->isGuest ? '' : Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label'=>'Category',
                'value'=> $model->category->title
            ],
            [
                    'label'=>'Author',
                    'value'=> $model->user->name
            ],
            'title',
            'content:raw',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <hr>
    <p>
        <strong>Media: </strong>
        <?php
        foreach ($media as $item) {
            if(preg_match('(png|jpeg|jpg|bmp)', $item->url) === 1) {
                echo "<img src='$item->url' width='200' class='img-thumbnail'> &nbsp;";
            }
            else{
                echo "<a href='$item->url' class='btn btn-warning' target='_blank'>Download File</a> &nbsp;";
            }

        }
        ?>
    </p>
    <hr>
    <p>
        <strong>Tags: </strong>
        <?php
        foreach ($tags as $tag) {
            echo "<span class='label label-success'>$tag->title</span> &nbsp;";
        }
        ?>
    </p>


</div>
