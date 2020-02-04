<!-- Call headers -->
<?php include "includes/header.php" ?>

<!-- Call this page's function -->
<?php UpdateTable();?>

<!-- Content -->
<div class="container">
    
    <div class="col-sm-9">
        <h1 class="text-center">Update</h1>
        <!-- Action this page's function -->
        <form action="user_update.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
            <select name="id" id="">
                <!-- Call this page's function -->
                <?php showAllData(); ?>
            </select>
            </div>
            <input class="btn btn-primary" type="submit" name="submit" value="UPDATE">
        </form>
    </div>

<!-- Call footers -->
<?php include "includes/footer.php"?>