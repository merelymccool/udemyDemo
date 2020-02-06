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
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <?php sidebarCat(); ?>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>
    
</div>