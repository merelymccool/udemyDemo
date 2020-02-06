<!-- Headers -->
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Admin
                            <small>Comments</small>
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

                            case 'edit_comment':
                                include "./includes/edit_comment.php";
                            break;

                            default:
                                include "./includes/view_comments.php";
                            break;

                        }

                        ?>
                        
                        </div>  
                    </div>
                </div>
                <!-- /.row -->

<!-- Footers -->
<?php include "includes/footer.php" ?>
