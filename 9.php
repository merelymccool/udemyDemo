<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

<?php 

session_start();

$_SESSION['message'] = "I did it all for the sessions";

$name = "cookieMonster";
$value = "I did it all for the cookies";
$expire = time() + (60*60*24*7);

setcookie($name, $value, $expire);

?>

	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


			<article class="main-content col-xs-8">
			
		
	
	<?php 

	if(isset($_GET['id'])) {
		echo "Got it" . "<br>";
	}

	if(isset($_COOKIE[$name])){
		echo $_COOKIE[$name] . "<br>";
	}

	if(isset($_SESSION['message'])){
		echo $_SESSION['message'] . "<br>";
	}


	/*  Create a link saying Click Here, and set 
	the link href to pass some parameters and use the GET super global to see it

		Step 2 - Set a cookie that expires in one week

		Step 3 - Start a session and set it to value, any value you want.
	*/
	
	?>

	<a href="9.php?id=42">Click It</a>



</article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>