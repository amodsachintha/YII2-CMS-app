<?php

use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="site-index" style="margin-top: -20px">
    <div class="row" style="text-align: center">
        <p></p>
    </div>

    <?php
    echo Carousel::widget([
        'items' => [
            [
                'content' => '<img src="/img/slides_1/1.jpg"/>',
                'caption' => '<img src="/img/logo.png" width="300"><h3>Interactive Student Handbook CMS</h3>',
                'options' => ['align' => 'center'],
            ],
            [
                'content' => '<img src="/img/slides_1/2.jpg"/>',
                'caption' => '<h2>SCMA CMS</h2><p>Powers the SCMA API</p>',
                'options' => ['align' => 'center'],
            ],
            [
                'content' => '<img src="/img/slides_1/3.png"/>',
                'options' => ['align' => 'center'],
            ],
        ]
    ]);
    ?>
<hr>
    <div class="row" style="margin-top: 20px">
        <div class="col-md-7">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-md-5">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
<hr>
    <div class="jumbotron">
        <!--        <img src="/img/logo.png" width="200">-->
        <?php if (Yii::$app->user->isGuest) {
            echo "<p class='lead'>Please Login to continue..</p>";
            echo "<p><a class=\"btn btn-lg btn-success\" href=\"/site/login\">Login</a></p>";
        }
        ?>
    </div>

    <?php if (!Yii::$app->user->isGuest) {
        if (Yii::$app->user->identity->role->name === "SA") {
            echo "
<div class='body-content' style='margin-top: -110px'>
    <div class='row'>
        <div class='alert alert-danger' align='center'>You are logged in as SUPER ADMIN</div>
    </div>
    <div class='row text-center'>
        <div class='col-lg-4'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Content</div>
              <div class='panel-body'>
              <div class='row'>
                <a href='/post' class='btn btn-primary' style='width: 80%'><span class='glyphicon glyphicon-list' aria-hidden='true'></span> Manage Posts</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/media' class='btn btn-primary' style='width: 80%'><span class='glyphicon glyphicon-picture' aria-hidden='true'></span> Manage Media</a>
              </div>  
              </div>
              <div class='panel-footer'>
                  <p>Posts: <span class='badge'>$count->postCount</span></p>
                  <p>Media: <span class='badge'>$count->mediaCount</span></p>
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-info' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Metadata</div>
              <div class='panel-body'>
              <div class='row' >
                <a href='/category' class='btn btn-info' style='width: 80%'><span class='glyphicon glyphicon-folder-close' aria-hidden='true'></span> Manage Categories</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/tag' class='btn btn-info' style='width: 80%'><span class='glyphicon glyphicon-tags' aria-hidden='true'></span> Manage Tags</a>
              </div> 
              </div>
              <div class='panel-footer'>
                  <p>Categories: <span class='badge'>$count->categoryCount</span></p>
                  <p>Tags: <span class='badge'>$count->tagCount</span></p>
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-danger' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Auth</div>
              <div class='panel-body'>
              <div class='row' >
                 <a href='/user' class='btn btn-danger' style='width: 80%'><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Manage Users</a>
              </div>
             <div class='row' style='margin-top: 10px'>
                 <a href='/apikey' class='btn btn-danger' style='width: 80%'><span class='glyphicon glyphicon-cloud' aria-hidden='true'></span> Manage API Credentials</a>
              </div> 
              </div>
              <div class='panel-footer'>
                  <p>Users: <span class='badge'>$count->userCount</span></p>
                  <p>API Keys: <span class='badge'>$count->apikeyCount</span></p>
              </div>
            </div>
        </div>
    </div>
</div>
        
        ";
        } else {
            echo "
<div class='body-content' style='margin-top: -110px'>
    <div class='row' style='margin-bottom: 10px'>
        <div class='alert alert-warning' align='center'><h5>You are logged in as CONTENT-CREATOR</h5></div>
    </div>
    <div class='row text-center'>
        <div class='col-lg-4 col-lg-offset-2'>
            <div class='panel panel-primary' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Content</div>
              <div class='panel-body'>
              <div class='row'>
                <a href='/post' class='btn btn-primary' style='width: 80%'><span class='glyphicon glyphicon-list' aria-hidden='true'></span> Manage Posts</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/media' class='btn btn-primary' style='width: 80%'><span class='glyphicon glyphicon-picture' aria-hidden='true'></span> Manage Media</a>
              </div>  
              </div>
              <div class='panel-footer'>
                  <p>Posts: <span class='badge'>$count->postCount</span></p>
                  <p>Media: <span class='badge'>$count->mediaCount</span></p>
              </div>
            </div>
        </div>
        
        <div class='col-lg-4'>
            <div class='panel panel-info' style='box-shadow: 0px 0px 30px -6px rgba(0,0,0,0.75);'>
            <div class='panel-heading'>Manage Metadata</div>
              <div class='panel-body'>
              <div class='row' >
                <a href='/category' class='btn btn-info' style='width: 80%'><span class='glyphicon glyphicon-folder-close' aria-hidden='true'></span> Manage Categories</a>
              </div>
              <div class='row' style='margin-top: 10px'>
                 <a href='/tag' class='btn btn-info' style='width: 80%'><span class='glyphicon glyphicon-tags' aria-hidden='true'></span> Manage Tags</a>
              </div> 
              </div>
              <div class='panel-footer'>
                  <p>Categories: <span class='badge'>$count->categoryCount</span></p>
                  <p>Tags: <span class='badge'>$count->tagCount</span></p>
              </div>
            </div>
        </div>
    </div>
</div>
";
        }
    }
    ?>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var ctx2 = document.getElementById('myChart2').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',

            data: {
                <?php
                echo "labels:[";
                foreach ($textMonths as $month) {
//                        $posts = $postsPerMonth[$i];
                    echo '"' . $month . '",';
                }
                echo "],";
                ?>
                datasets: [{
                    label: "Number of Posts",
                    backgroundColor: 'rgb(133, 193, 233)',
                    borderColor: 'rgb(133, 193, 233)',
                    <?php
                    $i = 1;
                    echo "data:[";
                    foreach ($fullMonths as $month) {
                        echo $postsPerMonth[$month] . ',';
                        $i++;
                    }
                    echo "]";
                    ?>
                }]
            },

            options: {
                responsive: true,
                title: {
                    display: true,
                    text: '<?= "Posts per Month (".date('Y').")" ?>'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Posts'
                        }
                    }]
                }
            }
        });
        window.chartColors = {
            1: 'rgb(255, 99, 132)',
            2: 'rgb(255, 159, 64)',
            3: 'rgb(255, 205, 86)',
            4: 'rgb(75, 192, 192)',
            5: 'rgb(54, 162, 235)',
            6: 'rgb(153, 102, 255)',
            7: 'rgb(201, 203, 207)'
        };

        var pieChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        <?php
                        foreach ($postsPerUser as $item) {
                            echo $item['count'] . ",";
                        }
                        ?>
                    ],
                    backgroundColor: [
                        <?php
                        $i = 1;
                        foreach ($postsPerUser as $item) {
                            echo "window.chartColors[$i],";
                            $i++;
                            if ($i % 7 == 0)
                                $i = 1;
                        }
                        ?>
                    ],
                    label: 'Dataset 1',
                }],

                labels: [
                    <?php
                    foreach ($postsPerUser as $item) {
                        echo "'" . $item['name'] . "',";
                    }
                    ?>
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Posts per User'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });


    </script>
</div>
