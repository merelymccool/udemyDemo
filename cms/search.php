<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                    miaMakes
                    <small>search results</small>
            </h1>

            <!-- Display search results -->
            <?php showSearchPosts(); ?>

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>

        