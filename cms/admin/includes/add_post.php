<?php 
        //Validate POST data is received
    if(isset($_POST['publish'])){
        $post_title = escape($_POST['post-title']);
        $post_catid = escape($_POST['post-catid']);
        $post_author = escape($_POST['post-author']);
        $post_date = date('d-m-y');
        $post_image = $_FILES['post-image']['name'];
        $post_image_temp = $_FILES['post-image']['tmp_name'];
        $post_content = escape($_POST['post-content']);
        $post_tags = escape($_POST['post-tags']);
        $post_status = escape($_POST['post-status']);
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

        echo "Successfully added post. " . "<a href='./posts.php'>View All Post</a>";
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
            <?php populateCatDropdown(); ?>
            </select>
        </label>
    </div>
    <div class="form-group">
        <label for="post-author">Author</label><br>
            <select name="post-author" id="post-author">
            <?php populateAuthorDropdown(); ?>
            </select>
        </label>
    </div>
    <!-- <div class="form-group">
        <label for="post-author">Author</label>
            <input type="text" class="form-control" name="post-author">
        </label>
    </div> -->
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
            <textarea class="form-control" name="post-content" id="body" cols="30" rows="10"></textarea>
        </label>
    </div>
    <div class="form-group">
        <select name="post-status" id="">
        <option value="draft">Post Status</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        </select>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="publish" value="Publish">
    </div>
</form>