<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

	<section class="content">

	<aside class="col-xs-4">

	<?php Navigation();?>
			
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<?php  

if( "blue" == "navy" ) {
	echo "I dislike PHP" . "<br>";
} elseif( 3 < 1 ) {
	echo "I am impartial to PHP" . "<br>";
} else {
	echo "I love PHP" . "<br>";
}

for( $i = 55; $i <= 65; $i++ ) {
	echo $i . "<br>";
}

$colour = "orange";
switch($colour) {
	case "red":
		echo "next is orange";
	break;
	case "orange":
		echo "next is yellow";
	break;
	case "yellow":
		echo "next is green";
	break;
	case "green":
		echo "next is blue";
	break;
	case "blue":
		echo "next is purple";
	break;
	default:
		echo "you're outta the rainbow";
	break;
}


/*  Step1: Make an if Statement with elseif and else to finally display string saying, I love PHP



	Step 2: Make a forloop  that displays 10 numbers


	Step 3 : Make a switch Statement that test againts one condition with 5 cases

 */

	
?>






</article><!--MAIN CONTENT-->
	
<?php include "includes/footer.php" ?>