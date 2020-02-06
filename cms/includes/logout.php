
<?php session_start(); ?>

<?php 

    $_SESSION['user_id'] = null;
    $_SESSION['user_name'] = null;
    $_SESSION['user_pass'] = null;
    $_SESSION['user_first'] = null;
    $_SESSION['user_last'] = null;
    $_SESSION['user_email'] = null;
    $_SESSION['user_image'] = null;
    $_SESSION['user_role'] = null;
    $_SESSION['user_status'] = null;

    header("Location: ../index.php");


?>