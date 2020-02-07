<?php 
    //Validate GET data is received
    if(isset($_GET['c_id'])){
        $c_id = $_GET['c_id'];
    }
    //Query for all post data
    $adm_editid_query = "SELECT * FROM com WHERE com_id = {$c_id}";
    //Validate query was successful
    $adm_editid_result = mysqli_query($db, $adm_editid_query);
    if(!$adm_editid_result){
        //Display an error message
        die("Query for comments failed" . mysqli_error($db));
    }
    //Dynamically populate fields from DB
    while($row = mysqli_fetch_assoc($adm_editid_result)){
        $adm_com_id = $row['com_id'];
        $adm_com_postid = $row['com_post_id'];
        $adm_com_author = $row['com_author'];
        $adm_com_email = $row['com_email'];
        $adm_com_status = $row['com_status'];
        $adm_com_content = $row['com_content'];
        $adm_com_date = $row['com_date'];
    }
?>

<!-- Page title -->
<h3>Edit Comment</h3>

<!-- Edit post form -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="com-author">Author</label>
            <input value="<?php echo $adm_com_author; ?>" type="text" class="form-control" name="com-author">
        </label>
    </div>
    <div class="form-group">
        <label for="com-email">Email</label>
            <input value="<?php echo $adm_com_email; ?>" type="text" class="form-control" name="com-email">
        </label>
    </div>
    <div class="form-group">
        <label for="com-content">Content</label>
            <textarea class="form-control" name="com-content" id="body" cols="30" rows="10"><?php echo $adm_com_content; ?></textarea>
        </label>
    </div>
    <div class="form-group">
        <label for="com-postid">Post ID</label><br>
            <select name="com-postid" id="com-postid">
            <?php populatePostDropdown(); ?>
            </select>
        </label>
    </div>
    <div class="form-group">
        <label for="com-status">Status</label>
            <input value="<?php echo $adm_com_status; ?>" type="text" class="form-control" name="com-status">
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update" value="Update">
    </div>
</form>

<?php 
    //Validate POST data is received
    if(isset($_POST['update'])){
        $edit_author = $_POST['com-author'];
        $edit_email = $_POST['com-email'];
        $edit_content = $_POST['com-content'];
        $edit_postid = $_POST['com-postid'];
        $edit_status = $_POST['com-status'];
        //Escape characters
        $edit_email = mysqli_real_escape_string($db, $edit_email );
        $edit_author = mysqli_real_escape_string($db, $edit_author );
        $edit_content = mysqli_real_escape_string($db, $edit_content );
        //Query to update comment
        $adm_com_query = "UPDATE com 
                            SET com_author = '{$edit_author}', 
                            com_email = '{$edit_email}', 
                            com_content = '{$edit_content}',
                            com_post_id = '{$edit_postid}', 
                            com_status = '{$edit_status}'
                            WHERE com_id = {$c_id}; ";
        //Validate query was successful
        $edit_publish = mysqli_query($db,$adm_com_query);
        if(!$edit_publish){
            //Display an error message
            die("The comment was not updated. " . mysqli_error($db));
        }
        //Refresh the page to show updated content
        header("Location: comments.php?source=edit_post&c_id={$adm_com_id}");
    }
?>