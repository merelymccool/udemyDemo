<!-- Headers -->
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->

                        <h1 class="page-header">
                            Admin
                            <small>Dashboard</small>
                        </h1>

                                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                        
                                        $post_query = "SELECT * FROM post";
                                        $all_posts_query = mysqli_query($db, $post_query);
                                        if(!$all_posts_query){
                                            die("Posts query failed. " . mysqli_error($db));
                                        }
                                        $post_count = mysqli_num_rows($all_posts_query);
                                        echo "<div class='huge'>{$post_count}</div>";
                                        ?>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                        
                                        $com_query = "SELECT * FROM com";
                                        $all_com_query = mysqli_query($db, $com_query);
                                        if(!$all_com_query){
                                            die("Comments query failed. " . mysqli_error($db));
                                        }
                                        $com_count = mysqli_num_rows($all_com_query);
                                        echo "<div class='huge'>{$com_count}</div>";
                                        ?>
                                    <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                        
                                        $user_query = "SELECT * FROM user";
                                        $all_user_query = mysqli_query($db, $user_query);
                                        if(!$all_user_query){
                                            die("Users query failed. " . mysqli_error($db));
                                        }
                                        $user_count = mysqli_num_rows($all_user_query);
                                        echo "<div class='huge'>{$user_count}</div>";
                                        ?>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <?php 
                                        
                                        $cat_query = "SELECT * FROM cat";
                                        $all_cat_query = mysqli_query($db, $cat_query);
                                        if(!$all_cat_query){
                                            die("Categories query failed. " . mysqli_error($db));
                                        }
                                        $cat_count = mysqli_num_rows($all_cat_query);
                                        echo "<div class='huge'>{$cat_count}</div>";
                                        ?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="cat.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                                <!-- /.row -->

                                <div class="row">
                                <script type="text/javascript">
                                    google.charts.load('current', {'packages':['bar']});
                                    google.charts.setOnLoadCallback(drawChart);

                                    function drawChart() {
                                        var data = google.visualization.arrayToDataTable([
                                        ['Data', 'Count'],

                                        <?php 
                                        
                                        $chart_titles = ['Active Posts','Comments','Users','Categories'];
                                        $chart_counts = [$post_count,$com_count,$user_count,$cat_count];
                                        
                                        for( $i=0 ; $i<4 ; $i++ ){
                                            echo "['{$chart_titles[$i]}'" . " , " . "{$chart_counts[$i]}],";
                                        }
                                        ?>
                                        ]);

                                        var options = {
                                        chart: {
                                            title: '',
                                            subtitle: '',
                                        }
                                        };

                                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                        chart.draw(data, google.charts.Bar.convertOptions(options));
                                    }
                                    </script>

                                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
                                </div>

<!-- Footers -->
<?php include "includes/footer.php" ?>
