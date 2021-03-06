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

checkLoggedInAndRedirect('index.php');

if(!isset($_GET['forgot'])){
    redirect('index.php');
}

if(ifItIsMethod('post')){
    if(isset($_POST['email'])){
        $email = trim($_POST['email']);
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if(emailExists($email)){
        if($stmt = mysqli_prepare($db,"UPDATE user SET token = '{$token}' WHERE user_email = ?")){
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                           // Send using SMTP
            $mail->Host       = Config::SMTP_HOST;                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                  // Enable SMTP authentication
            $mail->Username   = Config::SMTP_USER;                     // SMTP username
            $mail->Password   = Config::SMTP_PASSWORD;                 // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = Config::SMTP_PORT;                     // TCP port to connect to

            $mail->setFrom('admin@merelymccool.ca', 'Mia');
            $mail->addAddress($email);     // Add a recipient
            $mail->Subject = 'CMS Password Reset';
            $mail->Body    = '<a href="http://localhost:80/udemyDemo/cms/reset.php?e='.$email.'&t='.$token.'"><b>Reset Your Password</b></a>';

            if($mail->send()){
                $emailSent = true;
            } else {
                echo "Email was not sent";
            }
        }
        }
    }
}
?>


<?php  include "includes/nav.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                        <?php if(!isset($emailSent)): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        <?php else: ?>
                                
                            <h2>Email sent! Check your inbox.</h2>

                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

