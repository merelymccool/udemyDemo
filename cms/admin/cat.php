<!-- Headers -->
<?php include "includes/header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

            <!-- CREATE Categories -->
            <?php createCategory(); ?>

            <!-- DELETE Categories -->
            <?php deleteCategory(); ?>

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Categories</small>
                        </h1>
                        
                        <div class="col-xs-6">
                            <!-- ADD Category Form -->
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" placeholder="Category Title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add New">
                                </div>
                            </form>

                            <!-- UPDATE Category Form -->
                            <?php updateCategory(); ?>
                                    
                        </div>  
                        <!-- Category List -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- READ Categories -->
                                    <?php readCategory(); ?>
                                </tbody>
                            </table>
                        </div>                      
                    </div>
                </div>
                <!-- /.row -->

<!-- Footers -->
<?php include "includes/footer.php" ?>
