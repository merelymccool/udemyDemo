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
                    <small>posts by category</small>
                </h1>
                <!-- Display all category posts -->
                <?php 
                if(isset($_GET['cat'])){
                    $cat = escape($_GET['cat']);
                
                    $count_query = "SELECT * FROM post WHERE post_cat_id = $cat AND post_status = 'published'; ";
                    $count_result = mysqli_query($db,$count_query);
                    if(!$count_result){
                        die("Count posts query failed. " . mysqli_error($db));
                    }
                    $count = mysqli_num_rows($count_result);
                
                    if($count < 1) {
                        echo "No posts";
                    } else {
                        showCatPosts(); 
                    }
                } ?>

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>

        