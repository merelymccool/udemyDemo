<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use phpmailer\phpmailer\PHPMailer;
// use phpmailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require 'classes/config.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
?>

<?php 

// $msg = "This is a message";
// $msg = wordwrap($msg, 70);
// mail('admin@merelymccool.ca', 'My Subject', $msg);

// if(isset($_POST['contact'])){
//     $to = 'admin@merelymccool.ca';
//     $subject = escape($_POST['subject']);
//     $header = "FROM: " . escape($_POST['email']);
//     $message = escape(wordwrap($_POST['message'], 70));

//     mail($to, $subject, $message, $header);
// }
if(ifItIsMethod('post')){
    if(isset($_POST['email'])){
        $email = trim($_POST['email']);
        $subject = escape($_POST['subject']);
        $message = escape($_POST['message']);
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                           // Send using SMTP
        $mail->Host       = Config::SMTP_HOST;                     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
        $mail->Username   = Config::SMTP_USER;                     // SMTP username
        $mail->Password   = Config::SMTP_PASSWORD;                 // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = Config::SMTP_PORT;                     // TCP port to connect to

        $mail->addAddress('admin@merelymccool.ca', 'Mia');
        $mail->setFrom($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if($mail->send()){
            $emailSent = true;
        } else {
            echo "Email was not sent";
        }
    }
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
                        <h6 class="text-center"><?php //echo $message; ?></h6>
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
