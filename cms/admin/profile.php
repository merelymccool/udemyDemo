<!-- Headers -->
<?php include "includes/header.php" ?>

<?php 

if(isset($_SESSION['user_name'])){

    $username = $_SESSION['user_name'];

    $profile_query = "SELECT * FROM user WHERE user_name = '{$username}'; ";
    $select_profile = mysqli_query($db, $profile_query);
    if(!$select_profile){
        die("Username not found " . mysqli_error($db));
    }

    while($row = mysqli_fetch_array($select_profile)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_pass = $row['user_pass'];
        $user_first = $row['user_first'];
        $user_last = $row['user_last'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        $user_status = $row['user_status'];
    }
}

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/nav.php" ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Admin
                            <small>Profile</small>
                        </h1>
                        
                        <!-- Content --> 
                        <div class="col-xs-6">
                            <!-- Edit post form -->
                            <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">Edit your profile, <?php echo $_SESSION['user_first']; ?></div>
                                <div class="form-group">
                                    <label for="user-name">Username</label>
                                        <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user-name">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-email">Email</label>
                                        <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user-email">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-pass">Password</label>
                                        <input value="<?php echo $user_pass; ?>" type="text" class="form-control" name="user-pass">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-first">First Name</label>
                                        <input value="<?php echo $user_first; ?>" type="text" class="form-control" name="user-first">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-last">Last Name</label>
                                        <input value="<?php echo $user_last; ?>" type="text" class="form-control" name="user-last">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-image">Avatar</label>
                                        <img width="200" src="../avatars/<?php echo $user_image; ?>" alt="<?php echo $user_name; ?>">
                                        <input type="file" class="form-control" name="user-image">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-role">Role</label>
                                        <input value="<?php echo $user_role; ?>" type="text" class="form-control" name="user-role">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="user-status">Status</label>
                                        <input value="<?php echo $user_status; ?>" type="text" class="form-control" name="user-status">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="update" value="Update">
                                </div>
                            </form>

                        
                        
                        </div>  
                    </div>
                </div>
                <!-- /.row -->

<!-- Footers -->
<?php include "includes/footer.php" ?>

<?php 
    //Validate POST data is received
    if(isset($_POST['update'])){
        $pro_user_name = $_POST['user-name'];
        $pro_user_email = $_POST['user-email'];
        $pro_user_pass = $_POST['user-pass'];
        $pro_user_first = $_POST['user-first'];
        $pro_user_last = $_POST['user-last'];
        $pro_user_date = date('d-m-y');
        $pro_user_image = $_FILES['user-image']['name'];
        $pro_user_image_temp = $_FILES['user-image']['tmp_name'];
        $pro_user_role = $_POST['user-role'];
        $pro_user_status = $_POST['user-status'];
            //Escape characters 
        $pro_user_name = mysqli_real_escape_string($db, $pro_user_name );
        $pro_user_email = mysqli_real_escape_string($db, $pro_user_email );
        $pro_user_pass = mysqli_real_escape_string($db, $pro_user_pass );
        $pro_user_first = mysqli_real_escape_string($db, $pro_user_first );
        $pro_user_last = mysqli_real_escape_string($db, $pro_user_last );
            //Strip HTML or allow certain tags
        $pro_user_name = strip_tags( "$pro_user_name" );
        $pro_user_email = strip_tags( "$pro_user_email" );
        $pro_user_pass = strip_tags( "$pro_user_pass" );
        $pro_user_first = strip_tags( "$pro_user_first" );
        $pro_user_last = strip_tags( "$pro_user_last" );
        //Move images from tmp to perm folder
        move_uploaded_file($pro_user_image_temp, "../avatars/$pro_user_image");
        //Check if image was updated
        if(empty($pro_user_image)){
            $img_query = "SELECT * FROM user WHERE user_id = {$user_id}";
            $select_image = mysqli_query($db,$img_query);
            //If no image updated, use image from DB
            while($row = mysqli_fetch_array($select_image)){
                $pro_user_image = $row['user_image'];
            }
        }
        //Query to update comment
        $adm_com_query = "UPDATE user 
                            SET user_name = '{$pro_user_name}', 
                            user_email = '{$pro_user_email}', 
                            user_pass = '{$pro_user_pass}',
                            user_first = '{$pro_user_first}', 
                            user_last = '{$pro_user_last}', 
                            user_date = now(),
                            user_image = '{$pro_user_image}', 
                            user_role = '{$pro_user_role}', 
                            user_status = '{$pro_user_status}'
                            WHERE user_id = {$user_id}; ";
        //Validate query was successful
        $edit_publish = mysqli_query($db,$adm_com_query);
        if(!$edit_publish){
            //Display an error message
            die("Your profile was not updated. " . mysqli_error($db));
        }
        //Refresh the page to show updated content
        header("Location: profile.php");
    }
?>
