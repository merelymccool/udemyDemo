<?php


////////// Category Page functions

function createCategory() {
    //Make connection available outside of function
    global $db;
    //Verify POST data is received
    if(isset($_POST['submit'])){
        $adm_cat = $_POST['cat_title'];
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
    }
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
        $cat_id = $_GET['edit'];
        include "includes/update_cat.php";
    } 
    //Verify POST data is received
    if(isset($_POST['update'])){
        $adm_cat_upd = $_POST['cat_title'];
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
    }
}

function deleteCategory() {
    //Make connection available outside of function
    global $db;
    //Verify GET data is received
    if(isset($_GET['delete'])){
        $adm_cat_del = $_GET['delete'];
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
    }
}

////////// END Category Page functions




?>