<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="row">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="/site/posts" method="GET">
                            <div class="row">
                                <div class="col-sm-2">
                                    <p style="font-size: x-large; text-align: center"><?= Html::encode($this->title) ?></p>
                                </div>
                                <div class="col-sm-8">
                                    <input id="search" name="search" type="text" class="form-control" placeholder="Search.." value="<?= isset($search) ? $search : ''?>">
                                </div>
                                <div class="col-sm-2">
                                    <input type="submit" class="btn btn-default btn-block" value="Search">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(isset($count) && isset($message)){
            echo "
            <div class='row'>
                $message
            </div>
            ";
        }
    ?>

    <?php
    $i = 1;
    foreach ($posts as $post) {
        $content = \yii\helpers\HtmlPurifier::process(str_split($post->content, 500)[0]);
        $author = $post->user->name;
        echo "
              <div class='row'>
                <div class='panel panel-info'>
                   <div class='panel-heading'>
                <div class='panel-title'><kbd>$i</kbd><strong><a href='/post/view?id=$post->id'> $post->title</a></strong></div>
                   </div>
                    <div class='panel-body'>
                        $content  <a href='/post/view?id=$post->id'>more...</a>
                    </div>
                    <div class='panel-footer'>
                        <div class='row'>
                            <div class='col-md-4'>author: <span class='badge'> $author</span></div>
                            <div class='col-md-4'><i>created at: $post->created_at</i></div>
                            <div class='col-md-4' align='right'><a href='/post/view?id=$post->id' class='btn btn-success'>View Full</a></div>
                        </div>
                    </div>
                 </div>
              </div>
";
        $i++;
    }

    ?>

</div>
