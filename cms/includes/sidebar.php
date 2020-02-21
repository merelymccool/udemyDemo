<?php include "./admin/includes/functions.php" ?>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="terms" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="search" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>


    <?php 
    if(isset($_SESSION['user_role'])){
        $name = escape($_SESSION['user_first']); ?>

    <div class="well">
        <h4>Welcome, <?php echo $name; ?></h4>
        <!-- /.input-group -->
    </div>



    <?php } else { ?>

    <!-- Blog Login Form -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Username">
        </div>
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="input-group-btn">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </span>
        </div>
        <div class="form-group">
            <a href="forgot.php?forgot=<?php echo uniqid(); ?>">Forgot Password?</a>
        </div>
        </form>
        <!-- /.input-group -->
    </div>
    
    
    <?php } ?>

    <!-- Blog Categories Well -->
    <?php sidebarCat(); ?>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
    
</div>