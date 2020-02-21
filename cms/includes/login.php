<?php include "db.php" ?>
<?php include "functions.php" ?>

<?php include "../admin/includes/functions.php" ?>

<?php session_start(); ?>

<?php

if(ifItIsMethod('post')){
	if(isset($_POST['username']) && isset($_POST['password'])){
		loginUser($_POST['username'],$_POST['password']);
		redirect('../admin/index.php');
	} else {
		redirect('index.php');
	}
}

?>