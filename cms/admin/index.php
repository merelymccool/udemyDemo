<!-- Headers -->
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

            <?php 
                    // Count Draft Posts
            $post_draft_query = "SELECT * FROM post WHERE post_status = 'draft'; ";
            $post_drafts = mysqli_query($db, $post_draft_query);
            if(!$post_drafts){
                die("Posts drafts query failed. " . mysqli_error($db));
            }
            $post_draft_count = mysqli_num_rows($post_drafts);
                    // Count Published Posts
            $post_pub_query = "SELECT * FROM post WHERE post_status = 'published'; ";
            $post_pubs = mysqli_query($db, $post_pub_query);
            if(!$post_pubs){
                die("Posts published query failed. " . mysqli_error($db));
            }
            $post_pub_count = mysqli_num_rows($post_pubs);
                    // Count Unapproved Comments
            $com_unapp_query = "SELECT * FROM com WHERE com_status = 'Moderated'; ";
            $com_unapps = mysqli_query($db, $com_unapp_query);
            if(!$com_unapps){
                die("Comments unapproved query failed. " . mysqli_error($db));
            }
            $com_unapp_count = mysqli_num_rows($com_unapps);
                    // Count Approved Comments
            $com_app_query = "SELECT * FROM com WHERE com_status = 'Public'; ";
            $com_apps = mysqli_query($db, $com_app_query);
            if(!$com_apps){
                die("Comments approved query failed. " . mysqli_error($db));
            }
            $com_app_count = mysqli_num_rows($com_apps);
            ?>

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
                                        
                                        $chart_titles = ['All Posts','Published Posts','Draft Posts','All Comments','Approved','Unapproved','Users','Categories'];
                                        $chart_counts = [$post_count,$post_pub_count,$post_draft_count,$com_count,$com_app_count,$com_unapp_count,$user_count,$cat_count];
                                        
                                        for( $i=0 ; $i<8 ; $i++ ){
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
