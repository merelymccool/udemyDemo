<?php include "functions.php" ?>
<?php include "includes/header.php" ?>
<section class="content">

	<aside class="col-xs-4">

		<?php Navigation();?>
			
			
	</aside><!--SIDEBAR-->

<article class="main-content col-xs-8">

	
	<?php  

	class Dog {

		var $eyes = 2;
		var $legs = 4;
		var $nose = 1;
		var $fur = "brown";

		function ShowAll(){

			echo "Dog has " . $this->eyes . " eyes. <br>";
			echo "Dog has " . $this->legs . " legs. <br>";
			echo "Dog has " . $this->nose . " nose. <br>";
			echo "Dog has " . $this->fur . " fur. <br>";

		}

	}

	$pitbull = new Dog();

	$pitbull->ShowAll();

	/*  Step 1: Use the Make a class called Dog

		Step 2: Set some properties for Dog, Example, eye colors, nose, or fur color

		Step 4: Make a method named ShowAll that echos all the properties

		Step 5: Instantiate the class / create object and call it pitbull

Step 6: Call the method ShowAll

	

		
	*/
	
	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php" ?>