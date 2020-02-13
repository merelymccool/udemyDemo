<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

<!-- Get comments data -->
<?php
if(isset($_GET['p_id'])){
    $com_postid = escape($_GET['p_id']);
// Update comment count
// $view_query = "UPDATE post SET post_view_count = post_view_count + 1 WHERE post_id = {$p_id}; ";
// $view_result = mysqli_query($db,$view_query);
// If(!$view_result){
//     die("Views not updated. " . mysqli_error($db));
// }

if(isset($_POST['create_com'])){

    $com_author = escape($_POST['com_author']);
    $com_email = escape($_POST['com_email']);
    $com_content = escape($_POST['com_content']);

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

                <!-- Display post -->
                <?php showOnePost(); ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <div class="form-group">
                            <label for="com_author">Name: </label>
                            <input type="text" class="form-control" name="com_author">
                        </div>
                        <div class="form-group">
                            <label for="com_email">E-Mail:</label>
                            <input type="email" class="form-control" name="com_email">
                        </div>
                        <div class="form-group">
                            <label for="com_content">Comment:</label>
                            <textarea class="form-control" rows="3" name="com_content"></textarea>
                        </div>
                        <button type="submit" name="create_com" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 
                
                $com_postid = escape($_GET['p_id']);

                $get_com_query = "SELECT * FROM com 
                                    WHERE com_post_id = {$com_postid} 
                                    AND com_status = 'Public' 
                                    ORDER BY com_id DESC; ";
                $get_comments = mysqli_query($db, $get_com_query);
                if(!$get_comments){
                    die("Query for comments failed" . mysqli_error($db));
                }

                while($row = mysqli_fetch_assoc($get_comments)){
                    $com_date = $row['com_date'];
                    $com_author = $row['com_author'];
                    $com_content = $row['com_content']; ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $com_author; ?>
                            <small><?php echo $com_date; ?></small>
                        </h4>
                        <?php echo $com_content; ?>
                    </div>
                </div>
                <?php } } else {
                    header("Location: ./index.php"); }
                    ?>

                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Nested Comment
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        End Nested Comment
                    </div>
                </div> -->

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>

        