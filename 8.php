<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


		
	<article class="main-content col-xs-8">
	
	
	<?php  

	$encryptMe = "thisismyinsecurepassword";

	$hash = "$2y$05$";
	$salt = "thisneedstobe22characters";
	$hashSalt = $hash . $salt;

	$encrypted = crypt($encryptMe, $hashSalt);

	echo $encrypted;



	/*  Step 1 -Make a variable with some text as value

		Step 2 - Use crypt() function to encrypt it

		Step 3 - Assign the crypt result to a variable

		Step 4 - echo the variable

	*/
	
	?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>