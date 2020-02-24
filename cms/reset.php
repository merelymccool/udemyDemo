<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


<?php 

    if(!isset($_GET['t']) && !isset($_GET['e'])){
        redirect('index.php');
    }

// $email = 'j@sparrow.org';
// $token = '7506550977589587acb4610cbcffe119fee4785f5f1b55d374c24ea146cc102a46032a6df90d29f4e0b85419be8463ae5ced';

if($stmt = mysqli_prepare($db,'SELECT user_name, user_email, token FROM user WHERE token = ?')){
    mysqli_stmt_bind_param($stmt,"s",$_GET['t']);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$userName,$userEmail,$token);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // if($_GET['t'] !== $token || $_GET['email'] !== $e){
    //     redirect('index.php');
    // }

if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
    if($_POST['password'] === $_POST['confirmPassword']){

        $password = $_POST['password'];

        $hash_pass = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

        if($stmt = mysqli_prepare($db,"UPDATE user SET token = '', user_pass = '{$hash_pass}' WHERE user_email = ?"));
        mysqli_stmt_bind_param($stmt,"s",$_GET['e']);
        mysqli_stmt_execute($stmt);
        // mysqli_stmt_fetch($stmt);
        if(mysqli_stmt_affected_rows($stmt) > 0){
            redirect('login.php');
        } else {
            echo "Oops! Something went wrong. ";
            echo mysqli_stmt_affected_rows($stmt);
        }
        mysqli_stmt_close($stmt);

    } else {
        echo "Passwords must match";
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

                        <?php //if(isset($_POST['submit'])): ?>

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        <?php //else: ?>
                                <!-- <h2>Password updated! Login now</h2> -->
                        <?php //endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

