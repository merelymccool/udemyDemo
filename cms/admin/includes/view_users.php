<!-- Page title -->
<h3>View All Users</h3>

<!-- Posts table -->
<table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Avatar</th>
            <th>Updated</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        //Query for all comments data
        $adm_user_query = "SELECT * FROM user";
        //Validate query was successful
        $adm_user_result = mysqli_query($db, $adm_user_query);
        if(!$adm_user_result){
            //Display an error message
            die("Query for comments failed" . mysqli_error($db));
        }
        //Dynamically populate post table from DB
        while($row = mysqli_fetch_assoc($adm_user_result)){
            $adm_user_id = $row['user_id'];
            $adm_user_name = $row['user_name'];
            $adm_user_email = $row['user_email'];
            $adm_user_first = $row['user_first'];
            $adm_user_last = $row['user_last'];
            $adm_user_role = $row['user_role'];
            $adm_user_image = $row['user_image'];
            $adm_user_date = $row['user_date'];
            $adm_user_status = $row['user_status'];
            echo "  <tr>
                        <td>{$adm_user_id}</td>
                        <td>{$adm_user_name}</td>
                        <td>{$adm_user_email}</td>
                        <td>{$adm_user_first}</td>
                        <td>{$adm_user_last}</td>
                        <td>{$adm_user_role}</td>
                        <td><img width=100 src='../avatars/{$adm_user_image}' alt='{$adm_user_name}'></td>
                        <td>{$adm_user_date}</td>
                        <td>{$adm_user_status}</td>
                        <td><small><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?'); \" href='./users.php?delete={$adm_user_id}'>Delete</a></small>|<small><a href='./users.php?source=edit_user&u_id={$adm_user_id}'>Edit</a></small>
                        <br><small><a href='./users.php?adm={$adm_user_id}'>Promote</a></small>|<small><a href='./users.php?reg={$adm_user_id}'>Demote</a></small>
                        <br><small><a href='./users.php?approve={$adm_user_id}'>Approve</a></small>|<small><a href='./users.php?unapprove={$adm_user_id}'>Unapprove</a></small></td>

                    </tr>";
        }
        ?>
    </tbody>
</table>

<!-- DELETE Users -->
<?php 
    //Validate GET data is received
    if(isset($_GET['delete'])){

        if($_SESSION['user_role'] == 'Administrator'){

        $adm_del_id = mysqli_real_escape_string($db, $_GET['delete']);
        
        //Query to delete post ID
        $adm_del_query = "DELETE FROM user WHERE user_id = $adm_del_id; ";
        //Validate query was successful
        $adm_deleted = mysqli_query($db,$adm_del_query);
        if(!$adm_deleted){
            //Display an error message
            die("The user was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: users.php");
    }}
?>

<!-- APPROVE Users -->
<?php 
    //Validate GET data is received
    if(isset($_GET['approve'])){
        $adm_app_id = $_GET['approve'];
        //Query to delete post ID
        $adm_app_query = "UPDATE user SET user_status = 'Active' WHERE user_id = $adm_app_id; ";
        //Validate query was successful
        $adm_approved = mysqli_query($db,$adm_app_query);
        if(!$adm_approved){
            //Display an error message
            die("The user was not approved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: users.php");
    }
?>

<!-- UNAPPROVE Users -->
<?php 
    //Validate GET data is received
    if(isset($_GET['unapprove'])){
        $adm_unapp_id = $_GET['unapprove'];
        //Query to delete post ID
        $adm_unapp_query = "UPDATE user SET user_status = 'Inactive' WHERE user_id = $adm_unapp_id; ";
        //Validate query was successful
        $adm_unapped = mysqli_query($db,$adm_unapp_query);
        if(!$adm_unapped){
            //Display an error message
            die("The user was not unapproved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: users.php");
    }
?>

<!-- PROMOTE Users -->
<?php 
    //Validate GET data is received
    if(isset($_GET['adm'])){
        $adm_adm_id = $_GET['adm'];
        //Query to delete post ID
        $adm_adm_query = "UPDATE user SET user_role = 'Administrator' WHERE user_id = $adm_adm_id; ";
        //Validate query was successful
        $adm_promote = mysqli_query($db,$adm_adm_query);
        if(!$adm_promote){
            //Display an error message
            die("The user was not approved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: users.php");
    }
?>

<!-- DEMOTE Users -->
<?php 
    //Validate GET data is received
    if(isset($_GET['reg'])){
        $adm_reg_id = $_GET['reg'];
        //Query to delete post ID
        $adm_reg_query = "UPDATE user SET user_role = 'Registered' WHERE user_id = $adm_reg_id; ";
        //Validate query was successful
        $adm_demote = mysqli_query($db,$adm_reg_query);
        if(!$adm_demote){
            //Display an error message
            die("The user was not approved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: users.php");
    }
?>