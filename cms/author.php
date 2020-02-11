<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

<!-- Get comments data -->
<?php
if(isset($_GET['a_id'])){
    $a_id = $_GET['a_id'];
}
if(isset($_POST['create_com'])){

    $com_postid = $_GET['p_id'];

    $com_author = $_POST['com_author'];
    $com_email = $_POST['com_email'];
    $com_content = $_POST['com_content'];
    //Escape characters
    $com_author = mysqli_real_escape_string($db, $com_author );
    $com_email = mysqli_real_escape_string($db, $com_email );
    $com_content = mysqli_real_escape_string($db, $com_content );

    if(!empty($com_author) && !empty($com_email) && !empty($com_content)){

    $add_com_query = "INSERT INTO com (com_post_id, com_author, com_email, com_content, com_status, com_date ) 
                        VALUES ($com_postid, '$com_author', '$com_email', '$com_content', 'Unapproved', now()); ";

    $com_query=mysqli_query($db, $add_com_query);
    if(!$com_query){
        //Display an error message
        die("Comment was not submitted" . mysqli_error($db));
    }

    $update_count = "UPDATE post 
                        SET post_comment_count = post_comment_count + 1 
                        WHERE post_id = $com_postid; ";
    $update_com_count = mysqli_query($db, $update_count);
    if(!$update_com_count){
        die("Comment count not updated" . mysqli_error($db));
    }
    } else {
        echo "<script>alert('Fields must not be empty');</script>";
    }
    
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

        