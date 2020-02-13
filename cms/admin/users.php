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
                            <small>Users</small>
                        </h1>
                        
                        <!-- Content --> 
                        <div class="col-xs-6">
                           
                        <?php
                        if(isset($_GET['source'])){
                            $source = escape($_GET['source']);
                        } else {
                            $source = '';
                        }

                        switch($source) {
                            case 'add_user':
                                include "./includes/add_user.php";
                            break;

                            case 'edit_user':
                                include "./includes/edit_user.php";
                            break;

                            default:
                                include "./includes/view_users.php";
                            break;

                        }

                        ?>
                        
                        </div>  
                    </div>
                </div>
                <!-- /.row -->

<!-- Footers -->
<?php include "includes/footer.php" ?>
