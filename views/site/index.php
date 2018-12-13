<?php

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="/img/logo.png">
        <h1>SCMA Interactive Student Handbook</h1>

        <?php if (Yii::$app->user->isGuest){
            echo "<p class='lead'>Please Login to continue..</p>";
            echo  "<p><a class=\"btn btn-lg btn-success\" href=\"/site/login\">Login</a></p>";
        }
        ?>
    </div>

    <?php if(!Yii::$app->user->isGuest){
        if(Yii::$app->user->identity->role->name === "SA"){
         echo "
<div class='body-content'>
    <div class='row text-center'>
        <div class='col-lg-3'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Posts (Text)</div>
              <div class='panel-body'>
                <a href='/post' class='btn btn-primary'>Manage Posts</a> 
              </div>
            </div>
        </div>
        
        <div class='col-lg-3'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Media</div>
              <div class='panel-body'>
              <a href='/media' class='btn btn-primary'>Manage Media</a> 
              </div>
            </div>
        </div>
        
        <div class='col-lg-3'>
            <div class='panel panel-danger' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Users</div>
              <div class='panel-body'>
              <a href='/user' class='btn btn-danger'>Manage Users</a> 
              </div>
            </div>
        </div>
        
        <div class='col-lg-3'>
            <div class='panel panel-danger' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage API Credentials</div>
              <div class='panel-body'>
              <a href='/apikey' class='btn btn-danger'>Manage API Credentials</a> 
              </div>
            </div>
        </div>
    </div>
</div>
        
        ";
        }
        else{
            echo "
<div class='body-content'>
    <div class='row text-center'>
        <div class='col-lg-3 col-lg-offset-3'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>View Content</div>
              <div class='panel-body'>
                <a href='/post' class='btn btn-primary'>View Content</a> 
              </div>
            </div>
        </div>
        
        <div class='col-lg-3'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Add Content</div>
              <div class='panel-body'>
              <a href='/post/create' class='btn btn-primary'>Add Content</a> 
              </div>
            </div>
        </div>
    </div>
</div>
";
        }
    }


        ?>
</div>
