<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 

$msg = "This is a message";
$msg = wordwrap($msg, 70);
mail('admin@merelymccool.ca', 'My Subject', $msg);

if(isset($_POST['contact'])){
    $to = 'admin@merelymccool.ca';
    $subject = escape($_POST['subject']);
    $header = "FROM: " . escape($_POST['email']);
    $message = escape(wordwrap($_POST['message'], 70));

    mail($to, $subject, $message, $header);

    if(!$subject || ){
        die("Registration failed. " . mysqli_error($db) . '' . mysqli_errno($db));
    }
        $message = "Account created! <a href='./'>Click here to login.</a>";
    } else {
        $message = "Please complete all fields";
    }
} else {

    $message = '';
}
?>

    <!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Me</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="your@email.com">
                        </div>
                         <div class="form-group">
                            <label for="message" class="sr-only">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="contact" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
