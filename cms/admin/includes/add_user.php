<?php 
        //Validate POST data is received
    if(isset($_POST['create'])){
        $user_name = $_POST['user-name'];
        $user_email = $_POST['user-email'];
        $user_pass = $_POST['user-pass'];
        $user_first = $_POST['user-first'];
        $user_last = $_POST['user-last'];
        $user_date = date('d-m-y');
        $user_image = $_FILES['user-image']['name'];
        $user_image_temp = $_FILES['user-image']['tmp_name'];
        $user_role = $_POST['user-role'];
        $user_status = $_POST['user-status'];
            //Escape characters 
        $user_name = mysqli_real_escape_string($db, $user_name );
        $user_email = mysqli_real_escape_string($db, $user_email );
        $user_pass = mysqli_real_escape_string($db, $user_pass );
        $user_first = mysqli_real_escape_string($db, $user_first );
        $user_last = mysqli_real_escape_string($db, $user_last );
            //Strip HTML or allow certain tags
        $user_name = strip_tags( "$user_name" );
        $user_email = strip_tags( "$user_email" );
        $user_pass = strip_tags( "$user_pass" );
        $user_first = strip_tags( "$user_first" );
        $user_last = strip_tags( "$user_last" );
            //Move images from tmp to perm folder
        move_uploaded_file($user_image_temp, "../avatars/$user_image");
            //Query to add new posts
        $adm_user_query = "INSERT INTO user(user_name, user_email, user_pass, user_first, user_last, user_date, user_image, user_role, user_status) ";
        $adm_user_query .= "VALUES('{$user_name}','{$user_email}','{$user_pass}','{$user_first}','{$user_last}',now(),'{$user_image}','{$user_role}','{$user_status}'); ";
        $user_create = mysqli_query($db,$adm_user_query);
            //Validate query was successful
        if(!$user_create){
                //Display an error message
            die("The user was not created. " . mysqli_error($db));
        }

        echo "User successfully created. " . "<a href='users.php'>View All Users</a>";
    }
?>

<!-- Page title -->
<h3>Add User</h3>

<!-- Add Post Form -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user-name">Username</label>
            <input type="text" class="form-control" name="user-name">
        </label>
    </div>
    <div class="form-group">
        <label for="user-email">Email</label>
            <input type="email" class="form-control" name="user-email">
        </label>
    </div>
    <div class="form-group">
        <label for="user-pass">Password</label>
            <input type="text" class="form-control" name="user-pass">
        </label>
    </div>
    <div class="form-group">
        <label for="user-first">First Name</label>
            <input type="text" class="form-control" name="user-first">
        </label>
    </div>
    <div class="form-group">
        <label for="user-last">Last Name</label>
            <input type="text" class="form-control" name="user-last">
        </label>
    </div>
    <div class="form-group">
        <label for="user-image">Avatar</label>
            <input type="file" class="form-control" name="user-image">
        </label>
    </div>
    <div class="form-group">
        <label for="user-role">Role</label>
            <input type="text" class="form-control" name="user-role">
        </label>
    </div>
    <div class="form-group">
        <label for="user-status">Status</label>
            <input type="text" class="form-control" name="user-status">
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create" value="Publish">
    </div>
</form>