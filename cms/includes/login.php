<?php include "db.php" ?>

<?php session_start(); ?>

<?php

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);

    $check_login_query = "SELECT * FROM user WHERE user_name = '{$username}'; ";
    $select_user = mysqli_query($db, $check_login_query);
    if(!$select_user){
        die("Username not found " . mysqli_error($db));
    }

    while($row = mysqli_fetch_array($select_user)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_pass = $row['user_pass'];
        $user_first = $row['user_first'];
        $user_last = $row['user_last'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];
    }

    if(password_verify($password, $user_pass)){

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_pass'] = $user_pass;
        $_SESSION['user_first'] = $user_first;
        $_SESSION['user_last'] = $user_last;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_image'] = $user_image;
        $_SESSION['user_role'] = $user_role;
        $_SESSION['user_status'] = $user_status;

        header('Location: ../admin');
    }
    
    // Reverse encrypt the password
    // $password = crypt($password,$user_pass);

    // if($username === $user_name && $password === $user_pass) {
    //     $_SESSION['user_id'] = $user_id;
    //     $_SESSION['user_name'] = $user_name;
    //     $_SESSION['user_pass'] = $user_pass;
    //     $_SESSION['user_first'] = $user_first;
    //     $_SESSION['user_last'] = $user_last;
    //     $_SESSION['user_email'] = $user_email;
    //     $_SESSION['user_image'] = $user_image;
    //     $_SESSION['user_role'] = $user_role;
    //     $_SESSION['user_status'] = $user_status;

    //     header('Location: ../admin');
    // } 
    
    else {
        header('Location: ../index.php');
    }

    
}

?>