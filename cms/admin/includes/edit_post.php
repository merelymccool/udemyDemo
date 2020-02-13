<?php 
    //Validate GET data is received
    if(isset($_GET['p_id'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $p_id = escape($_GET['p_id']);
    
    //Query for all post data
    $adm_editid_query = "SELECT * FROM post WHERE post_id = {$p_id}";
    //Validate query was successful
    $adm_editid_result = mysqli_query($db, $adm_editid_query);
    if(!$adm_editid_result){
        //Display an error message
        die("Query for posts failed" . mysqli_error($db));
    }
    //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($adm_editid_result)){
        $adm_post_id = $row['post_id'];
        $adm_post_author = $row['post_author'];
        $adm_post_title = $row['post_title'];
        $adm_post_catid = $row['post_cat_id'];
        $adm_post_status = $row['post_status'];
        $adm_post_image = $row['post_image'];
        $adm_post_content = $row['post_content'];
        $adm_post_tags = $row['post_tags'];
        $adm_post_comments = $row['post_comment_count'];
        $adm_post_date = $row['post_date'];
        $adm_post_views = $row['post_view_count'];
    }
}}
?>

<?php 
    //Validate POST data is received
    if(isset($_POST['update'])){
        $edit_title = escape($_POST['post-title']);
        $edit_catid = escape($_POST['post-catid']);
        $edit_author = escape($_POST['post-author']);
        $edit_date = date('d-m-y');
        $edit_image = $_FILES['post-image']['name'];
        $edit_image_temp = $_FILES['post-image']['tmp_name'];
        $edit_content = escape($_POST['post-content']);
        $edit_tags = escape($_POST['post-tags']);
        $edit_status = escape($_POST['post-status']);
        //Strip HTML or allow certain tags
        $edit_title = strip_tags( "$edit_title" );
        $edit_author = strip_tags( "$edit_author" );
        $edit_tags = strip_tags( "$edit_tags", '<em>' );
        //Move images from tmp to perm folder
        move_uploaded_file($edit_image_temp, "../images/$edit_image");
        //Check if image was updated
        if(empty($edit_image)){
            $img_query = "SELECT * FROM post WHERE post_id = {$adm_post_id}";
            $select_image = mysqli_query($db,$img_query);
            //If no image updated, use image from DB
            while($row = mysqli_fetch_array($select_image)){
                $edit_image = $row['post_image'];
            }
        }
        //Query to update post
        $adm_post_query = "UPDATE post 
                            SET post_cat_id = {$edit_catid}, 
                            post_title = '{$edit_title}', 
                            post_author = '{$edit_author}', 
                            post_date = now(), 
                            post_image = '{$edit_image}', 
                            post_content = '{$edit_content}', 
                            post_tags = '{$edit_tags}', 
                            post_status = '{$edit_status}'
                            WHERE post_id = {$p_id}; ";
        //Validate query was successful
        $edit_publish = mysqli_query($db,$adm_post_query);
        if(!$edit_publish){
            //Display an error message
            die("The post was not updated. " . mysqli_error($db));
        }
        echo "Successfully updated post. " . "<a href='./posts.php'>View All Posts</a>";
        
        //Refresh the page to show updated content
        // header("Location: posts.php?source=edit_post&p_id={$adm_post_id}");

    }
?>

<!-- Page title -->
<h3>Edit Post</h3>

<!-- Edit post form -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post-title">Title</label>
            <input value="<?php echo $adm_post_title; ?>" type="text" class="form-control" name="post-title">
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
    <!-- <div class="form-group">
        <label for="post-author">Author</label>
            <input value="<?php echo $adm_post_author; ?>" type="text" class="form-control" name="post-author">
        </label>
    </div> -->

    <div class="form-group">
        <label for="post-author">Author</label><br>
            <select name="post-author" id="post-author">
            <option value="<?php echo $adm_post_author; ?>"><?php echo $adm_post_author; ?></option>
            <?php populateAuthorDropdown(); ?>
            </select>
        </label>
    </div>

    <div class="form-group">
        <label for="post-image">Image</label>
            <img width="200" src="../images/<?php echo $adm_post_image; ?>" alt="<?php echo $adm_post_title; ?>">
            <input type="file" class="form-control" name="post-image">
        </label>
    </div>
    <div class="form-group">
        <label for="post-tags">Tags</label>
            <input value="<?php echo $adm_post_tags; ?>" type="text" class="form-control" name="post-tags">
        </label>
    </div>
    <div class="form-group">
        <label for="post-content">Content</label>
            <textarea class="form-control" name="post-content" id="body" cols="30" rows="10"><?php echo $adm_post_content; ?></textarea>
        </label>
    </div>
    <div class="form-group">
        <label for="post-status">Status</label>
        <select name="post-status" id="">
            <option value="<?php echo $adm_post_status; ?>"><?php echo $adm_post_status; ?></option>
            <?php 
            if($adm_post_status == 'draft'){
                echo '<option value="published">publish</option>';
            } else {
                echo '<option value="draft">draft</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update" value="Update">
    </div>
</form>