<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Page title -->
                <h1 class="page-header">
                    miaMakes
                    <small>all the posts</small>
                </h1>

                <!-- Display all posts -->
                <?php showAllPosts(); ?>

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>