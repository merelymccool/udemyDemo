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
                                        <?php commonQuery('post'); ?>
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
                                    <?php commonQuery('com'); ?>
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
                                    <?php commonQuery('user'); ?>
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
                                    <?php commonQuery('cat'); ?>
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

                                        $post_count = commonQuery('post');
                                        $post_pub_count = queryWhere('post','post_status','published');
                                        $post_draft_count = queryWhere('post','post_status','draft');
                                        $com_count = commonQuery('com');
                                        $com_app_count = queryWhere('com','com_status','Public');
                                        $com_unapp_count = queryWhere('com','com_status','Unapproved');
                                        $user_count = commonQuery('user');
                                        $cat_count = commonQuery('cat');
                                    

                                        
                                        $chart_titles = ['All Posts','Published Posts','Draft Posts','All Comments','Approved','Unapproved','Users','Categories'];
                                        $chart_counts = [$post_count,$com_count,$user_count,$cat_count];
                                        
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
