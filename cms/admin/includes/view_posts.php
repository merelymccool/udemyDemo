<?php 
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $checkBoxValue){
        $bulk_opt = $_POST['bulkOptions'];

        echo $checkBoxValue;
        switch($bulk_opt) {

            case 'published':
            $update_query = "UPDATE post SET post_status = '{$bulk_opt}' WHERE post_id = {$checkBoxValue}; ";
            $bulk_update = mysqli_query($db,$update_query);
            if(!$bulk_update){
                die("Update failed. " . mysqli_error($db));
            }
            break;
            case 'draft':
            $draft_query = "UPDATE post SET post_status = '{$bulk_opt}' WHERE post_id = {$checkBoxValue}; ";
            $bulk_draft = mysqli_query($db,$draft_query);
            if(!$bulk_draft){
                die("Draft failed. " . mysqli_error($db));
            }
            break;
            case 'delete':
            $delete_query = "DELETE FROM post WHERE post_id = {$checkBoxValue}; ";
            $bulk_delete = mysqli_query($db,$delete_query);
            if(!$bulk_delete){
                die("Delete failed. " . mysqli_error($db));
            }
            break;
        }

    }
}



?>


<!-- Page title -->
<h3>View All Posts</h3>


<form action="" method="post">
<!-- Posts table -->
<table class="table table-bordered table-hover">

<div class="col-xs-6" id="bulkOptionContainer">
    <select name="bulkOptions" id="" class="form-control">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    </select>
</div>
<div class="col-xs-6">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
</div>


    <thead>
        <tr>
            <th><input class='checkBoxes' type='checkbox' id='selectAllCheckbox'></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Images</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Views</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        //Query for all posts data
        $adm_post_query = "SELECT * FROM post ORDER BY post_id DESC";
        //Validate query was successful
        $adm_post_result = mysqli_query($db, $adm_post_query);
        if(!$adm_post_result){
            //Display an error message
            die("Query for posts failed" . mysqli_error($db));
        }
        //Dynamically populate post table from DB
        while($row = mysqli_fetch_assoc($adm_post_result)){
            $adm_post_id = $row['post_id'];
            $adm_post_author = $row['post_author'];
            $adm_post_title = $row['post_title'];
            $adm_post_catid = $row['post_cat_id'];
            $adm_post_status = $row['post_status'];
            $adm_post_image = $row['post_image'];
            $adm_post_tags = $row['post_tags'];
            $adm_post_comments = $row['post_comment_count'];
            $adm_post_date = $row['post_date'];
            $adm_post_views = $row['post_view_count']; ?>


                    <tr>
                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $adm_post_id ?>'>


            <?php echo "<td>{$adm_post_id}</td>
                        <td>{$adm_post_author}</td>
                        <td><a href='../post.php?p_id={$adm_post_id}'>{$adm_post_title}</a></td>";
                        //Query for all data from category ID
                        $cat_query = "SELECT * FROM cat WHERE cat_id = {$adm_post_catid} ";
                        //Validate query was successful
                        $cat_result = mysqli_query($db, $cat_query);
                        if(!$cat_result){
                            //Display as error message
                            die("Query for categories failed" . mysqli_error($db));
                        }
                        //Dynamically populate category title from db
                        while($row = mysqli_fetch_assoc($cat_result)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<td>{$cat_title}</td>";
                        }
            echo        "<td>{$adm_post_status}</td>
                        <td><img width='100' src='../images/{$adm_post_image}' alt={$adm_post_title}></td>
                        <td>{$adm_post_tags}</td>"; ?>
            <?php 
            
            $comment_count_query = "SELECT * FROM com WHERE com_post_id = $adm_post_id ";
            $comment_count = mysqli_query($db,$comment_count_query);
            if(!$comment_count){
                die("Comment query failed. " . mysqli_error($db));
            }
            $row = mysqli_fetch_array($comment_count);
            $cp_id = $row['com_post_id'];
            $com_total = mysqli_num_rows($comment_count);
            ?>

                        <td><?php echo $com_total; ?></td>


            <?php echo  "<td>{$adm_post_date}</td>
                        <td>{$adm_post_views}</td>
                        <td><small><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='./posts.php?delete={$adm_post_id}'>Delete</a></small>|<small><a href='./posts.php?source=edit_post&p_id={$adm_post_id}'>Edit</a></small>
                        <br><small><a href='./posts.php?approve={$adm_post_id}'>Approve</a></small>|<small><a href='./posts.php?unapprove={$adm_post_id}'>Unapprove</a></small></td>
                    </tr>";
        }
        ?>
    </tbody>
</table>
</form>

<!-- DELETE Posts -->
<?php 
    //Validate GET data is received
    if(isset($_GET['delete'])){
        $adm_del_id = $_GET['delete'];
        //Query to delete post ID
        $adm_del_query = "DELETE FROM post WHERE post_id = $adm_del_id; ";
        //Validate query was successful
        $adm_deleted = mysqli_query($db,$adm_del_query);
        if(!$adm_deleted){
            //Display an error message
            die("The post was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: posts.php");
    }
?>

<!-- APPROVE Posts -->
<?php 
    //Validate GET data is received
    if(isset($_GET['approve'])){
        $adm_app_id = $_GET['approve'];
        //Query to delete post ID
        $adm_app_query = "UPDATE post SET post_status = 'Publish' WHERE post_id = $adm_app_id; ";
        //Validate query was successful
        $adm_approved = mysqli_query($db,$adm_app_query);
        if(!$adm_approved){
            //Display an error message
            die("The post was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: posts.php");
    }
?>

<!-- UNAPPROVE Posts -->
<?php 
    //Validate GET data is received
    if(isset($_GET['unapprove'])){
        $adm_unapp_id = $_GET['unapprove'];
        //Query to delete post ID
        $adm_unapp_query = "UPDATE post SET post_status = 'Draft' WHERE post_id = $adm_unapp_id; ";
        //Validate query was successful
        $adm_unapproved = mysqli_query($db,$adm_unapp_query);
        if(!$adm_unapproved){
            //Display an error message
            die("The post was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: posts.php");
    }
?>