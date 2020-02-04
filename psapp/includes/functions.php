<!-- Connect to DB -->
<?php include "db.php"; ?>
<?php

// Function for user_create.php
function createRows() {
    //Verify POST data is received
if(isset($_POST['submit'])) {
            //Make connection available outside of function
        global $connection;
            //Assign variables for POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
            //Sanitize input by escaping characters
        $username = mysqli_real_escape_string($connection, $username );
        $password = mysqli_real_escape_string($connection, $password );
        $email = mysqli_real_escape_string($connection, $email );
            //Secure sensitive input with salt and hash
        $hashFormat = "$2y$10$"; 
        $salt = "thisneedstobe22characters";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password,$hashF_and_salt);   
            //Query to insert data
        $query = "INSERT INTO users(username,password,email) ";
        $query .= "VALUES ('$username', '$password', '$email')";
            //Validate query was successful
        $result = mysqli_query($connection, $query);
        if(!$result) {
            //Display an error message
            die('Query FAILED' . mysqli_error($connection));
        } else {
            //Display a success message
        echo "User Successfully Created"; 
        }
    }
}


//Function for user_read.php
function readRows() {
        //Make connection available outside of function
    global $connection;
        //Query for all user data
    $query = "SELECT * FROM users";
        //Validate query was successful
    $result = mysqli_query($connection, $query);
    if(!$result) {
        //Display an error message
        die('Query FAILED' . mysqli_error($connection));
    }
        //Display data
    while($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }  
}


//Function for user_update.php
function UpdateTable() {
        //Verify POST data is received
    if(isset($_POST['submit'])) {
            //Make connection available outside of function
        global $connection;
            //Assign variables for POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $id = $_POST['id'];
            //Sanitize input by escaping characters
        $username = mysqli_real_escape_string($connection, $username );   
        $password = mysqli_real_escape_string($connection, $password );
        $email = mysqli_real_escape_string($connection, $email );
            //Secure sensitive input with salt and hash
        $hashFormat = "$2y$10$"; 
        $salt = "wehaveupdatedsalthereyo";
        $hashF_and_salt = $hashFormat . $salt;
        $password = crypt($password,$hashF_and_salt);
            //Query to update data
        $query = "UPDATE users SET ";
        $query .= "username = '$username', ";
        $query .= "password = '$password', ";
        $query .= "email = '$email' ";
        $query .= "WHERE userid = $id ";
            //Validate query was successful
        $result = mysqli_query($connection, $query);
        if(!$result) {
            //Display as error message
            die("QUERY FAILED" . mysqli_error($connection));    
        } else {
            //Display a success message
        echo "User Successfully Updated"; 
        }
    }
}


//Function for user_delete.php
function deleteRows() {
    //Verify POST data is received
    if(isset($_POST['submit'])) {
            //Make connection available outside of function
        global $connection;
            //Assign variables for POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $id = $_POST['id'];
            //Query to delete data
        $query = "DELETE FROM users ";
        $query .= "WHERE userid = $id ";
        //Validate query was successful
        $result = mysqli_query($connection, $query);
        if(!$result) {
            //Display an error message
            die("QUERY FAILED" . mysqli_error($connection));    
        }else {
            //Display a success message
        echo "User Successfully Deleted"; 
        }
    }
}


//Function for user_update and user_delete dropdown
function showAllData() {
        //Make connection available outside of function
    global $connection;
        //Query for all user data
    $query = "SELECT * FROM users;";
        //Validate query was successful
    $result = mysqli_query($connection, $query);
    if(!$result) {
        //Display an error message
        die('Query FAILED' . mysqli_error($connection));
    }
        //Display data
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['userid'];
        echo "<option value='$id'>$id</option>";
    }
}