<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

<?php 
if(isset($_GET['a_id'])){
    $a_id = escape($_GET['a_id']);
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <!-- Page title -->
                <h1 class="page-header">
                    Author Page
                    <small><?php echo $a_id; ?></small>
                </h1>

                <!-- Display post -->
                <?php showAuthorPosts(); ?>

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>

        