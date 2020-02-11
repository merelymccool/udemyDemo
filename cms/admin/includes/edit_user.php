<?php 
    //Validate GET data is received
    if(isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
    }
    //Query for all post data
    $adm_editid_query = "SELECT * FROM user WHERE user_id = {$u_id}";
    //Validate query was successful
    $adm_editid_result = mysqli_query($db, $adm_editid_query);
    if(!$adm_editid_result){
        //Display an error message
        die("Query for users failed" . mysqli_error($db));
    }
    //Dynamically populate fields from DB
    while($row = mysqli_fetch_assoc($adm_editid_result)){
        $adm_user_id = $row['user_id'];
        $adm_user_name = $row['user_name'];
        $adm_user_email = $row['user_email'];
        $adm_user_pass = $row['user_pass'];
        $adm_user_first = $row['user_first'];
        $adm_user_last = $row['user_last'];
        $adm_user_role = $row['user_role'];
        $adm_user_image = $row['user_image'];
        $adm_user_date = $row['user_date'];
        $adm_user_status = $row['user_status'];
    }

        //Validate POST data is received
    if(isset($_POST['update'])){
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
        //Salt the password
        $salt_query = "SELECT randSalt FROM user; ";
        $salt_result = mysqli_query($db,$salt_query);
        if(!$salt_result){
            die("No salt for you. " . mysqli_error($db));
        }
        $row = mysqli_fetch_array($salt_result);
        $salt = $row['randSalt'];

        $hash_pass = crypt($user_pass,$salt);
        //Move images from tmp to perm folder
        move_uploaded_file($user_image_temp, "../avatars/$user_image");
        //Check if image was updated
        if(empty($user_image)){
            $img_query = "SELECT * FROM user WHERE user_id = {$u_id}";
            $select_image = mysqli_query($db,$img_query);
            //If no image updated, use image from DB
            while($row = mysqli_fetch_array($select_image)){
                $user_image = $row['user_image'];
            }
        }
        //Query to update user
        $adm_com_query = "UPDATE user 
                            SET user_name = '{$user_name}', 
                            user_email = '{$user_email}', 
                            user_pass = '{$hash_pass}',
                            user_first = '{$user_first}', 
                            user_last = '{$user_last}', 
                            user_date = now(),
                            user_image = '{$user_image}', 
                            user_role = '{$user_role}', 
                            user_status = '{$user_status}'
                            WHERE user_id = {$u_id}; ";
        //Validate query was successful
        $edit_publish = mysqli_query($db,$adm_com_query);
        if(!$edit_publish){
            //Display an error message
            die("The user was not updated. " . mysqli_error($db));
        }
        //Refresh the page to show updated content
        header("Location: users.php?source=edit_user&u_id={$u_id}");
    }
?>

<!-- Page title -->
<h3>Edit User</h3>

<!-- Edit post form -->
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">Editing User ID <?php echo $adm_user_id ?></div>
    <div class="form-group">
        <label for="user-name">Username</label>
            <input value="<?php echo $adm_user_name; ?>" type="text" class="form-control" name="user-name">
        </label>
    </div>
    <div class="form-group">
        <label for="user-email">Email</label>
            <input value="<?php echo $adm_user_email; ?>" type="email" class="form-control" name="user-email">
        </label>
    </div>
    <div class="form-group">
        <label for="user-pass">Password</label>
            <input value="<?php echo $adm_user_pass; ?>" type="password" class="form-control" name="user-pass">
        </label>
    </div>
    <div class="form-group">
        <label for="user-first">First Name</label>
            <input value="<?php echo $adm_user_first; ?>" type="text" class="form-control" name="user-first">
        </label>
    </div>
    <div class="form-group">
        <label for="user-last">Last Name</label>
            <input value="<?php echo $adm_user_last; ?>" type="text" class="form-control" name="user-last">
        </label>
    </div>
    <div class="form-group">
        <label for="user-image">Avatar</label>
            <img width="200" src="../avatars/<?php echo $adm_user_image; ?>" alt="<?php echo $adm_user_name; ?>">
            <input type="file" class="form-control" name="user-image">
        </label>
    </div>
    <div class="form-group">
        <label for="user-role">Role</label>
        <select name="user-role" id="">
            <option value="<?php echo $adm_user_role; ?>"><?php echo $adm_user_role; ?></option>
            <?php 
            if($adm_user_role == 'Administrator'){
                echo '<option value="Registered">Registered</option>';
            } else {
                echo '<option value="Administrator">Administrator</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="user-status">Status</label>
        <select name="user-status" id="">
            <option value="<?php echo $adm_user_status; ?>"><?php echo $adm_user_status; ?></option>
            <?php 
            if($adm_user_role == 'Active'){
                echo '<option value="Inactive">Inactive</option>';
            } else {
                echo '<option value="Active">Active</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update" value="Update">
    </div>
</form>