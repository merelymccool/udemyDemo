<?php 
        //Validate POST data is received
    if(isset($_POST['create'])){
        $user_name = escape($_POST['user-name']);
        $user_email =escape($_POST['user-email']);
        $user_pass = escape($_POST['user-pass']);
        $user_first = escape($_POST['user-first']);
        $user_last = escape($_POST['user-last']);
        $user_date = date('d-m-y');
        $user_image = escape($_FILES['user-image']['name']);
        $user_image_temp = escape($_FILES['user-image']['tmp_name']);
        $user_role = escape($_POST['user-role']);
        $user_status = escape($_POST['user-status']);
            //Hash password
        $user_pass = password_hash($user_pass, PASSWORD_BCRYPT, array('cost' => 10));
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
    <!-- <div class="form-group">
        <label for="user-role">Role</label>
            <input type="text" class="form-control" name="user-role">
        </label>
    </div> -->
    <div class="form-group">
        <select name="user-role" id="">
        <option value="Registered">User Role</option>
        <option value="Administrator">Administrator</option>
        <option value="Registered">Registered</option>
        </select>
        </label>
    </div>
    <!-- <div class="form-group">
        <label for="user-status">Status</label>
            <input type="text" class="form-control" name="user-status">
        </label>
    </div> -->
    <div class="form-group">
        <select name="user-status" id="">
        <option value="Active">User Status</option>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
        </select>
        </label>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create" value="Create">
    </div>
</form>