<!-- Headers -->
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Posts</small>
                        </h1>
                        
                        <!-- Content --> 
                        <div class="col-xs-6">
                           
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }

                        switch($source) {
                            case 'add_post':
                                include "./includes/add_post.php";
                            break;

                            case 'edit_post':
                                include "./includes/edit_post.php";
                            break;

                            default:
                                include "./includes/view_posts.php";
                            break;

                        }

                        ?>
                        
                        </div>  
                    </div>
                </div>
                <!-- /.row -->

<!-- Footers -->
<?php include "includes/footer.php" ?>
