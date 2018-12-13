<?php

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index">

    <div class="jumbotron">
        <img src="/img/logo.png">
        <h1>SCMA Interactive Student Handbook</h1>

        <?php if (Yii::$app->user->isGuest) {
            echo "<p class='lead'>Please Login to continue..</p>";
            echo "<p><a class=\"btn btn-lg btn-success\" href=\"/site/login\">Login</a></p>";
        }
        ?>
    </div>

    <?php if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->identity->role->name === "SA") {
            echo "
<div class='body-content'>
    <div class='row'>
        <div class='alert alert-danger' align='center'>You are logged in as SUPER ADMIN</div>
    </div>
    <div class='row text-center'>
        <div class='col-lg-4'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Content</div>
              <div class='panel-body'>
              <div class='row'>
                <a href='/post' class='btn btn-primary' style='width: 80%'>Manage Posts</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/media' class='btn btn-primary' style='width: 80%'>Manage Media</a>
              </div>  
              
                
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-info' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Metadata</div>
              <div class='panel-body'>
              <div class='row' >
                <a href='/category' class='btn btn-info' style='width: 80%'>Manage Categories</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/tag' class='btn btn-info' style='width: 80%'>Manage Tags</a>
              </div> 
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-danger' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Auth</div>
              <div class='panel-body'>
              <div class='row' >
                 <a href='/user' class='btn btn-danger' style='width: 80%'>Manage Users</a>
              </div>
             <div class='row' style='margin-top: 10px'>
                 <a href='/apikey' class='btn btn-danger' style='width: 80%'>Manage API Credentials</a>
              </div> 
              
              </div>
            </div>
        </div>
    </div>
</div>
        
        ";
        } else {
            echo "
<div class='body-content'>
    <div class='row' style='margin-bottom: 10px'>
        <div class='alert alert-warning' align='center'><h5>You are logged in as CONTENT-CREATOR</h5></div>
    </div>
    <div class='row text-center'>
        <div class='col-lg-4 col-lg-offset-2'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Content</div>
              <div class='panel-body'>
              <div class='row'>
                <a href='/post' class='btn btn-primary' style='width: 80%'>Manage Posts</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/media' class='btn btn-primary' style='width: 80%'>Manage Media</a>
              </div>  
              
                
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-info' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Metadata</div>
              <div class='panel-body'>
              <div class='row' >
                <a href='/category' class='btn btn-info' style='width: 80%'>Manage Categories</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/tag' class='btn btn-info' style='width: 80%'>Manage Tags</a>
              </div> 
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
