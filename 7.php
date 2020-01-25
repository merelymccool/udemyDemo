<?php include "functions.php" ?>
<?php include "includes/header.php" ?>
    

	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


	<article class="main-content col-xs-8">
	
	
	
	<?php

	$db = mysqli_connect('localhost', 'root', '', 'udemydemo');
	if (!$db) {
		die("Database Connection Failed");
	} else {
		echo "You are connected" . "<br>";
	}
	
	$query = "select * from users;";

	$result = mysqli_query($db, $query);

	if(!$result){
		die("No results returned");
	} else {
		echo "You've got results!" . "<br>";
	}

	while($row = mysqli_fetch_assoc($result)){
		print_r($row);
	}
	


	/*  Step 1 - Create a database in PHPmyadmin

		Step 2 - Create a table like the one from the lecture

		Step 3 - Insert some Data

		Step 4 - Connect to Database and read data

*/
	
	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php" ?>
