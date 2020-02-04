<?php 
        //Validate POST data is received
    if(isset($_POST['publish'])){
        $post_title = $_POST['post-title'];
        $post_catid = $_POST['post-catid'];
        $post_author = $_POST['post-author'];
        $post_date = date('d-m-y');
        $post_image = $_FILES['post-image']['name'];
        $post_image_temp = $_FILES['post-image']['tmp_name'];
        $post_content = $_POST['post-content'];
        $post_tags = $_POST['post-tags'];
        $post_status = $_POST['post-status'];
            //Escape characters 
        $post_title = mysqli_real_escape_string($db, $post_title );
        $post_author = mysqli_real_escape_string($db, $post_author );
        $post_content = mysqli_real_escape_string($db, $post_content );
        $post_tags = mysqli_real_escape_string($db, $post_tags );
            //Strip HTML or allow certain tags
        $post_title = strip_tags( "$post_title" );
        $post_author = strip_tags( "$post_author" );
        $post_tags = strip_tags( "$post_tags", '<em>' );
            //Move images from tmp to perm folder
        move_uploaded_file($post_image_temp, "../images/$post_image");
            //Query to add new posts
        $adm_post_query = "INSERT INTO post(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
        $adm_post_query .= "VALUES({$post_catid},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}'); ";
        $post_publish = mysqli_query($db,$adm_post_query);
            //Validate query was successful
        if(!$post_publish){
                //Display an error message
            die("The post was not published. " . mysqli_error($db));
        }
    }
?>

<!-- Page title -->
<h3>Add Post</h3>

<!-- Add Post Form -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post-title">Title</label>
            <input type="text" class="form-control" name="post-title">
        </label>
    </div>
    <div class="form-group">
        <label for="post-catid">Category</label><br>
            <select name="post-catid" id="post-catid">
            <?php 
                //Query for all categories data
                $cat_query = "SELECT * FROM cat";
                //Validate query was successful
                $cat_result = mysqli_query($db, $cat_query);
                if(!$cat_result){
                    //Display as error message
                    die("Query for categories failed" . mysqli_error($db));
                }
                //Dynamically populate dropdown from DB
                while($row = mysqli_fetch_assoc($cat_result)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }?>
            </select>
        </label>
    </div>
    <div class="form-group">
        <label for="post-author">Author</label>
            <input type="text" class="form-control" name="post-author">
        </label>
    </div>
    <div class="form-group">
        <label for="post-tags">Tags</label>
            <input type="text" class="form-control" name="post-tags">
        </label>
    </div>
    <div class="form-group">
        <label for="post-image">Image</label>
            <input type="file" class="form-control" name="post-image">
        </label>
    </div>
    <div class="form-group">
        <label for="post-content">Content</label>
            <textarea class="form-control" name="post-content" id="" cols="30" rows="10"></textarea>
        </label>
    </div>
    <div class="form-group">
        <label for="post-status">Status</label>
            <input type="text" class="form-control" name="post-status">
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="publish" value="Publish">
    </div>
</form>