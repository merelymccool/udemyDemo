<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 

checkLoggedInAndRedirect('index.php');


if(isset($_POST['register'])){
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);

    if(!empty($password)){
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    }

    if(usernameExists($username)){
        $message = "This username already exists. <a href='login.php'>Login instead</a>?";
    } 
    elseif(emailExists($email)){
        $message = "This email already exists. <a href='login.php'>Login instead</a>?";
    } 
    elseif(!empty($username) && !empty($email) && !empty($password)){
    $create_user_query = "INSERT INTO user (user_name,user_email,user_pass,user_role,user_status,user_date) 
                            VALUES('$username','$email','$password','Registered','Active',now()); ";
    $create_user_result = mysqli_query($db,$create_user_query);
    if(!$create_user_result){
        die("Registration failed. " . mysqli_error($db) . '' . mysqli_errno($db));
    }
        $message = "Account created! <a href='login.php'>Click here to login.</a>";
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
                <h1>Register</h1>
                    <form role="form" action="register.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"><?php echo $message; ?></h6>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
