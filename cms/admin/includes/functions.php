<?php

function escape($str){
    global $db;
    return mysqli_real_escape_string($db,trim($str));
}

function commonQuery($table) {
    global $db;
    $query = "SELECT * FROM $table";
    $result_query = mysqli_query($db, $query);
    if(!$result_query){
        die("Users query failed. " . mysqli_error($db));
    }
    $count = mysqli_num_rows($result_query);
    echo "<div class='huge'>{$count}</div>";
}

function queryWhere($table,$column,$value) {
    global $db;
    $query = "SELECT * FROM $table WHERE $column = '$value'; ";
    $result = mysqli_query($db, $query);
    if(!$result){
        die("Query query failed. " . mysqli_error($db));
    }
    $count = mysqli_num_rows($result);

    return $count;
}


////////// Category Page functions

function createCategory() {
    //Make connection available outside of function
    global $db;
    //Verify POST data is received
    if(isset($_POST['submit'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_cat = escape($_POST['cat_title']);
        //Validate POST data is not empty
        if($adm_cat == "" || empty($adm_cat)){
            //Display an error message
            echo "Category Title cannot not be empty!";
        } else {
        //Query for all categories data
        $adm_cat_query = "INSERT INTO cat(cat_title) ";
        $adm_cat_query .= "VALUE('{$adm_cat}') ";
        //Validate query was successful
        $adm_cat_create = mysqli_query($db,$adm_cat_query);
        if(!$adm_cat_create){
            //Display an error message
            die("Failed to create new Category. " . mysqli_error($db));
        }
        }
    }}
}

function readCategory() {
    //Make connection available outside of function
    global $db;
    //Query for all categories data
    $adm_cat_query = "SELECT * FROM cat";
    //Validate query was successful
    $adm_cat_result = mysqli_query($db, $adm_cat_query);
    if(!$adm_cat_result){
        //Display an error message
        die("Query for categories failed" . mysqli_error($db));
    }
    //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($adm_cat_result)){
        $adm_cat_id = $row['cat_id'];
        $adm_cat_title = $row['cat_title'];
        echo "<tr>
                <td>$adm_cat_id</td>
                <td>$adm_cat_title</td>
                <td>
                    <small><a href='cat.php?delete={$adm_cat_id}'>Delete</a></small>
                    <small><a href='cat.php?edit={$adm_cat_id}'>Edit</a></small>
                </td></tr>";
    //Save second column for possible future use
    // <tr>
    //     <td>Thing 1</td>
    //     <td>Thing 2</td>
    // </tr>
    }
}

function updateCategory() {
    //Make connection available outside of function
    global $db;
    //Verify GET data is received
    if(isset($_GET['edit'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $cat_id = escape($_GET['edit']);
        include "includes/update_cat.php";
    } 
    //Verify POST data is received
    if(isset($_POST['update'])){
        $adm_cat_upd = escape($_POST['cat_title']);
        //Validate POST data is not empty
        if(empty($adm_cat_upd)){
            //Display an error message
            echo "Category ID not found. Cannot update!";
        } else {
        //Query for all categories data
        $adm_cat_updq = "UPDATE cat SET cat_title = '{$adm_cat_upd}' WHERE cat_id = {$cat_id} ; ";
        //Validate query was successful
        $adm_cat_changed = mysqli_query($db,$adm_cat_updq);
        if(!$adm_cat_changed){
            //Display an error message
            die("Failed to update Category. " . mysqli_error($db));
        }
        //Refresh the page to clear Update form
        header("Location: cat.php");
        }
    }}
}

function deleteCategory() {
    //Make connection available outside of function
    global $db;
    //Verify GET data is received
    if(isset($_GET['delete'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_cat_del = escape($_GET['delete']);
        //Validate GET data is not empty
        if(empty($adm_cat_del)){
            //Display an error message
            echo "Category ID not found. Cannot delete!";
        } else {
        //Query for all categories data
        $adm_cat_del = "DELETE FROM cat WHERE cat_id = {$adm_cat_del} ; ";
        //Validate query was successful
        $adm_cat_deleted = mysqli_query($db,$adm_cat_del);
        if(!$adm_cat_deleted){
            //Display an error message
            die("Failed to delete Category. " . mysqli_error($db));
        }
        //Refresh the page to remove deleted category
        header("Location: cat.php");
        }
    }}
}

////////// END Category Page functions



////////// Comment Page functions

function viewAllComments() {
    //Make connection available outside of function
    global $db;
    
    //Query for all comments data
    $adm_com_query = "SELECT * FROM com";
    //Validate query was successful
    $adm_com_result = mysqli_query($db, $adm_com_query);
    if(!$adm_com_result){
        //Display an error message
        die("Query for comments failed" . mysqli_error($db));
    }
    //Dynamically populate post table from DB
    while($row = mysqli_fetch_assoc($adm_com_result)){
        $adm_com_id = $row['com_id'];
        $adm_com_postid = $row['com_post_id'];
        $adm_com_author = $row['com_author'];
        $adm_com_email = $row['com_email'];
        $adm_com_status = $row['com_status'];
        $adm_com_content = $row['com_content'];
        $adm_com_date = $row['com_date'];
        echo "  <tr>
                    <td>{$adm_com_id}</td>"; 
                        //Query for all categories data
                        $post_query = "SELECT * FROM post WHERE post_id = {$adm_com_postid}; ";
                        //Validate query was successful
                        $post_result = mysqli_query($db, $post_query);
                        if(!$post_result){
                            //Display as error message
                            die("Query for categories failed" . mysqli_error($db));
                        }
                        //Dynamically populate dropdown from DB
                        while($row = mysqli_fetch_assoc($post_result)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                        }
                    echo "
                    <td>{$adm_com_author}</td>
                    <td>{$adm_com_email}</td>
                    <td>{$adm_com_status}</td>
                    <td>{$adm_com_content}</td>
                    <td>{$adm_com_date}</td>
                    <td><small><a href='./comments.php?delete={$adm_com_id}'>Delete</a></small>|<small><a href='./comments.php?source=edit_comment&c_id={$adm_com_id}'>Edit</a></small>
                    <br><small><a href='./comments.php?approve={$adm_com_id}'>Approve</a></small>|<small><a href='./comments.php?unapprove={$adm_com_id}'>Unapprove</a></small></td>
                </tr>";
    }
}

function commentOptions(){
    //Make connection available outside of function
    global $db;

//Delete 
    //Validate GET data is received
    if(isset($_GET['delete'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_del_id = escape($_GET['delete']);
        //Query to delete post ID
        $adm_del_query = "DELETE FROM com WHERE com_id = $adm_del_id; ";
        //Validate query was successful
        $adm_deleted = mysqli_query($db,$adm_del_query);
        if(!$adm_deleted){
            //Display an error message
            die("The comment was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}


// Approve
    //Validate GET data is received
    if(isset($_GET['approve'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_app_id = escape($_GET['approve']);
        //Query to delete post ID
        $adm_app_query = "UPDATE com SET com_status = 'Public' WHERE com_id = $adm_app_id; ";
        //Validate query was successful
        $adm_approved = mysqli_query($db,$adm_app_query);
        if(!$adm_approved){
            //Display an error message
            die("The comment was not approved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}


// Unapprove
    //Validate GET data is received
    if(isset($_GET['unapprove'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_unapp_id = escape($_GET['unapprove']);
        //Query to delete post ID
        $adm_unapp_query = "UPDATE com SET com_status = 'Moderated' WHERE com_id = $adm_unapp_id; ";
        //Validate query was successful
        $adm_unapped = mysqli_query($db,$adm_unapp_query);
        if(!$adm_unapped){
            //Display an error message
            die("The comment was not unapproved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}
}

function populatePostDropdown() {
    //Make connection available outside of function
    global $db;

    //Query for all posts data
    $post_query = "SELECT * FROM post";
    //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed" . mysqli_error($db));
    }
    //Dynamically populate dropdown from DB
    while($row = mysqli_fetch_assoc($post_result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<option value='{$post_id}'>{$post_title}</option>";
    }
}

////////// END Comment Page functions




function populateCatDropdown() {
    //Make connection available outside of function
    global $db;
    
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
    }
}

function populateAuthorDropdown() {
    //Make connection available outside of function
    global $db;
    
    //Query for all categories data
    $user_query = "SELECT * FROM user";
    //Validate query was successful
    $user_result = mysqli_query($db, $user_query);
    if(!$user_result){
        //Display as error message
        die("Query for categories failed" . mysqli_error($db));
    }
    //Dynamically populate dropdown from DB
    while($row = mysqli_fetch_assoc($user_result)){
        // $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        echo "<option value='{$user_name}'>{$user_name}</option>";
    }
}


?>