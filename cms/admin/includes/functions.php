<?php
// =======================================
// GENERAL HELPER FUNCTIONS
// =======================================
function escape($str){
    global $db;
    return mysqli_real_escape_string($db,trim($str));
}

function redirect($location){
    header("Location: " . $location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkLoggedInAndRedirect($redirectLocation){

    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}

function commonQuery($table) {
    global $db;
    $query = "SELECT * FROM $table";
    $result_query = mysqli_query($db, $query);
    if(!$result_query){
        die("Users query failed. " . mysqli_error($db));
    }
    $count = mysqli_num_rows($result_query);
    echo "<div class='huge'>{$count}</div>";
}

function queryWhere($table,$column,$value) {
    global $db;
    $query = "SELECT * FROM $table WHERE $column = '$value'; ";
    $result = mysqli_query($db, $query);
    if(!$result){
        die("Query query failed. " . mysqli_error($db));
    }
    $count = mysqli_num_rows($result);

    return $count;
}

function loginUser($username,$password){
    global $db;

    if(isset($_POST['login'])){
        $username = escape($_POST['username']);
        $password = escape($_POST['password']);
    
        $check_login_query = "SELECT * FROM user WHERE user_name = '{$username}'; ";
        $select_user = mysqli_query($db, $check_login_query);
        if(!$select_user){
            die("Username not found " . mysqli_error($db));
        }
    
        while($row = mysqli_fetch_array($select_user)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_pass = $row['user_pass'];
            $user_first = $row['user_first'];
            $user_last = $row['user_last'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_status = $row['user_status'];

            if(password_verify($password, $user_pass)){
    
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_pass'] = $user_pass;
                $_SESSION['user_first'] = $user_first;
                $_SESSION['user_last'] = $user_last;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_image'] = $user_image;
                $_SESSION['user_role'] = $user_role;
                $_SESSION['user_status'] = $user_status;
        
            }
        }
    
    }
}

function usernameExists($username){
    global $db;

    $query = "SELECT user_name FROM user WHERE user_name = '{$username}';";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Query failed. " . mysqli_error($db));
    }
    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function emailExists($email){
    global $db;

    $query = "SELECT user_email FROM user WHERE user_email = '{$email}';";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Query failed. " . mysqli_error($db));
    }
    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}



////////// Category Page functions

function createCategory() {
    //Make connection available outside of function
    global $db;
    //Verify POST data is received
    if(isset($_POST['submit'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_cat = escape($_POST['cat_title']);
        //Validate POST data is not empty
        if($adm_cat == "" || empty($adm_cat)){
            //Display an error message
            echo "Category Title cannot not be empty!";
        } else {
        //Query for all categories data
        $adm_cat_query = "INSERT INTO cat(cat_title) ";
        $adm_cat_query .= "VALUE('{$adm_cat}') ";
        //Validate query was successful
        $adm_cat_create = mysqli_query($db,$adm_cat_query);
        if(!$adm_cat_create){
            //Display an error message
            die("Failed to create new Category. " . mysqli_error($db));
        }
        }
    }}
}

function readCategory() {
    //Make connection available outside of function
    global $db;
    //Query for all categories data
    $adm_cat_query = "SELECT * FROM cat";
    //Validate query was successful
    $adm_cat_result = mysqli_query($db, $adm_cat_query);
    if(!$adm_cat_result){
        //Display an error message
        die("Query for categories failed" . mysqli_error($db));
    }
    //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($adm_cat_result)){
        $adm_cat_id = $row['cat_id'];
        $adm_cat_title = $row['cat_title'];
        echo "<tr>
                <td>$adm_cat_id</td>
                <td>$adm_cat_title</td>
                <td>
                    <small><a href='cat.php?delete={$adm_cat_id}'>Delete</a></small>
                    <small><a href='cat.php?edit={$adm_cat_id}'>Edit</a></small>
                </td></tr>";
    //Save second column for possible future use
    // <tr>
    //     <td>Thing 1</td>
    //     <td>Thing 2</td>
    // </tr>
    }
}

function updateCategory() {
    //Make connection available outside of function
    global $db;
    //Verify GET data is received
    if(isset($_GET['edit'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $cat_id = escape($_GET['edit']);
        include "includes/update_cat.php";
    } 
    //Verify POST data is received
    if(isset($_POST['update'])){
        $adm_cat_upd = escape($_POST['cat_title']);
        //Validate POST data is not empty
        if(empty($adm_cat_upd)){
            //Display an error message
            echo "Category ID not found. Cannot update!";
        } else {
        //Query for all categories data
        $adm_cat_updq = "UPDATE cat SET cat_title = '{$adm_cat_upd}' WHERE cat_id = {$cat_id} ; ";
        //Validate query was successful
        $adm_cat_changed = mysqli_query($db,$adm_cat_updq);
        if(!$adm_cat_changed){
            //Display an error message
            die("Failed to update Category. " . mysqli_error($db));
        }
        //Refresh the page to clear Update form
        header("Location: cat.php");
        }
    }}
}

function deleteCategory() {
    //Make connection available outside of function
    global $db;
    //Verify GET data is received
    if(isset($_GET['delete'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_cat_del = escape($_GET['delete']);
        //Validate GET data is not empty
        if(empty($adm_cat_del)){
            //Display an error message
            echo "Category ID not found. Cannot delete!";
        } else {
        //Query for all categories data
        $adm_cat_del = "DELETE FROM cat WHERE cat_id = {$adm_cat_del} ; ";
        //Validate query was successful
        $adm_cat_deleted = mysqli_query($db,$adm_cat_del);
        if(!$adm_cat_deleted){
            //Display an error message
            die("Failed to delete Category. " . mysqli_error($db));
        }
        //Refresh the page to remove deleted category
        header("Location: cat.php");
        }
    }}
}

////////// END Category Page functions



////////// Comment Page functions

function viewAllComments() {
    //Make connection available outside of function
    global $db;
    
    //Query for all comments data
    $adm_com_query = "SELECT * FROM com";
    //Validate query was successful
    $adm_com_result = mysqli_query($db, $adm_com_query);
    if(!$adm_com_result){
        //Display an error message
        die("Query for comments failed" . mysqli_error($db));
    }
    //Dynamically populate post table from DB
    while($row = mysqli_fetch_assoc($adm_com_result)){
        $adm_com_id = $row['com_id'];
        $adm_com_postid = $row['com_post_id'];
        $adm_com_author = $row['com_author'];
        $adm_com_email = $row['com_email'];
        $adm_com_status = $row['com_status'];
        $adm_com_content = $row['com_content'];
        $adm_com_date = $row['com_date'];
        echo "  <tr>
                    <td>{$adm_com_id}</td>"; 
                        //Query for all categories data
                        $post_query = "SELECT * FROM post WHERE post_id = {$adm_com_postid}; ";
                        //Validate query was successful
                        $post_result = mysqli_query($db, $post_query);
                        if(!$post_result){
                            //Display as error message
                            die("Query for categories failed" . mysqli_error($db));
                        }
                        //Dynamically populate dropdown from DB
                        while($row = mysqli_fetch_assoc($post_result)){
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                        }
                    echo "
                    <td>{$adm_com_author}</td>
                    <td>{$adm_com_email}</td>
                    <td>{$adm_com_status}</td>
                    <td>{$adm_com_content}</td>
                    <td>{$adm_com_date}</td>
                    <td><small><a href='./comments.php?delete={$adm_com_id}'>Delete</a></small>|<small><a href='./comments.php?source=edit_comment&c_id={$adm_com_id}'>Edit</a></small>
                    <br><small><a href='./comments.php?approve={$adm_com_id}'>Approve</a></small>|<small><a href='./comments.php?unapprove={$adm_com_id}'>Unapprove</a></small></td>
                </tr>";
    }
}

function commentOptions(){
    //Make connection available outside of function
    global $db;

//Delete 
    //Validate GET data is received
    if(isset($_GET['delete'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_del_id = escape($_GET['delete']);
        //Query to delete post ID
        $adm_del_query = "DELETE FROM com WHERE com_id = $adm_del_id; ";
        //Validate query was successful
        $adm_deleted = mysqli_query($db,$adm_del_query);
        if(!$adm_deleted){
            //Display an error message
            die("The comment was not deleted. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}


// Approve
    //Validate GET data is received
    if(isset($_GET['approve'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_app_id = escape($_GET['approve']);
        //Query to delete post ID
        $adm_app_query = "UPDATE com SET com_status = 'Public' WHERE com_id = $adm_app_id; ";
        //Validate query was successful
        $adm_approved = mysqli_query($db,$adm_app_query);
        if(!$adm_approved){
            //Display an error message
            die("The comment was not approved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}


// Unapprove
    //Validate GET data is received
    if(isset($_GET['unapprove'])){
        if($_SESSION['user_role'] == 'Administrator'){
        $adm_unapp_id = escape($_GET['unapprove']);
        //Query to delete post ID
        $adm_unapp_query = "UPDATE com SET com_status = 'Moderated' WHERE com_id = $adm_unapp_id; ";
        //Validate query was successful
        $adm_unapped = mysqli_query($db,$adm_unapp_query);
        if(!$adm_unapped){
            //Display an error message
            die("The comment was not unapproved. " . mysqli_error($db));
        }
        //Refresh the page to remove post
        header("Location: comments.php");
    }}
}

function populatePostDropdown() {
    //Make connection available outside of function
    global $db;

    //Query for all posts data
    $post_query = "SELECT * FROM post";
    //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed" . mysqli_error($db));
    }
    //Dynamically populate dropdown from DB
    while($row = mysqli_fetch_assoc($post_result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        echo "<option value='{$post_id}'>{$post_title}</option>";
    }
}

////////// END Comment Page functions




function populateCatDropdown() {
    //Make connection available outside of function
    global $db;
    
    //Query for all categories data
    $cat_query = "SELECT * FROM cat";
    //Validate query was successful
    $cat_result = mysqli_query($db, $cat_query);
    if(!$cat_result){
        //Display as error message
        die("Query for categories failed" . mysqli_error($db));
    }
    //Dynamically populate dropdown from DB
    while($row = mysqli_fetch_assoc($cat_result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}

function populateAuthorDropdown() {
    //Make connection available outside of function
    global $db;
    
    //Query for all categories data
    $user_query = "SELECT * FROM user";
    //Validate query was successful
    $user_result = mysqli_query($db, $user_query);
    if(!$user_result){
        //Display as error message
        die("Query for categories failed" . mysqli_error($db));
    }
    //Dynamically populate dropdown from DB
    while($row = mysqli_fetch_assoc($user_result)){
        // $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        echo "<option value='{$user_name}'>{$user_name}</option>";
    }
}


?>



<?php 

//////// Displays all posts on index
function showAllPosts() {
        //Make connection available outside of function
    global $db;
        //Query for all post data
    $post_query = "SELECT * FROM post
                    WHERE post_status = 'published' 
                    ORDER BY post_id DESC ";
        //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed. " . mysqli_error($db));
    }
        //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($post_result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 250); ?>
            <!-- Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
<?php }} ?>

<?php
function showAuthorPosts() {
        //Make connection available outside of function
    global $db;

    if(isset($_GET['a_id'])){
        $a_id = escape($_GET['a_id']);
        //Query for all post data
    $post_query = "SELECT * FROM post
                    WHERE post_author = '{$a_id}' 
                    ORDER BY post_id DESC ";
        //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed. " . mysqli_error($db));
    }
        //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($post_result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 250); ?>
            <!-- Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
<?php }}} ?>


<?php
///////Displays all category posts
function showCatPosts() {
        //Make connection available outside of function
    global $db;
        //Validate GET data is received
    if(isset($_GET['cat'])){
        $post_cat_id = escape($_GET['cat']);
        //Query for all post data
    $post_query = "SELECT * FROM post 
                    WHERE post_cat_id = $post_cat_id
                    AND post_status = 'published' 
                    ORDER BY post_id DESC ";
        //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed. " . mysqli_error($db));
    }
        //Dynamically populate navbar from DB
    while($row = mysqli_fetch_array($post_result)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = substr($row['post_content'], 0, 250);?>
            <!-- Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>
<?php }}} ?>



<?php 
/////////Displays a single post
function showOnePost() {
        //Make connection available outside of function
    global $db;
        //Validate GET data is received
    if(isset($_GET['p_id'])){
        $p_id = escape($_GET['p_id']);

        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'Administrator'){
            //Query for all post data
            $post_query = "SELECT * FROM post WHERE post_id = {$p_id}";
        } else {
            echo "Oops! Nothing to see here. Return to <a href='./index.php'>Home</a>.";
            //Query only published post data
        $post_query = "SELECT * FROM post WHERE post_id = {$p_id} AND post_status = 'published';";
        }
        //Validate query was successful
    $post_result = mysqli_query($db, $post_query);
    if(!$post_result){
        //Display as error message
        die("Query for posts failed. " . mysqli_error($db));
    }
    
        //Dynamically populate navbar from DB
    while($row = mysqli_fetch_assoc($post_result)){
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];?>
            <!-- Blog Post -->
            <h1 class="page-header">
            <?php echo $post_title; ?>
            </h1>
            <h2><small>by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a></small></h2>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <hr>
<?php }}} ?>




<?php
//////////Displays search results
function showSearchPosts() {
        //Make connection available outside of function
    global $db;
        //Validate POST data received
    if(isset($_POST['search'])){
        //Assign input to variable
        $search_terms = escape($_POST['terms']);
        //Query for search terms in post_tags
        $search_query = "SELECT * FROM post 
                            WHERE post_tags LIKE '%$search_terms%'
                            AND post_status = 'published' 
                            ORDER BY post_id DESC ";
        //Validate the query was successful
        $search_result = mysqli_query($db,$search_query);
        if(!$search_result){
            //Display an error message
            die("No search results found. " . mysqli_error($db));
        }
        //Count results
        $count = mysqli_num_rows($search_result);
        //Validate results are more than 0
        if($count <= 0){
            //Display an error message
            echo "<h3> Hmm.. nothing here. Try some other terms? </h3>";
        } elseif($count === 1) {
            echo "<h3> We have " . $count . " result! </h3>"; 
        //Validate query was successful
        $post_result = mysqli_query($db, $search_query);
        if(!$post_result){
            //Display as error message
            die("Query for posts failed. " . mysqli_error($db));
        }
        //Dynamically populate navbar from DB
        while($row = mysqli_fetch_assoc($post_result)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 250);?>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_title; ?>"></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
        <?php }
        } else {
            echo "<h3> We have " . $count . " results! </h3>";
            //Validate query was successful
            $post_result = mysqli_query($db, $search_query);
            if(!$post_result){
                //Display as error message
                die("Query for posts failed. " . mysqli_error($db));
        }
        //Dynamically populate navbar from DB
        while($row = mysqli_fetch_assoc($post_result)){
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 250);?>
                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author.php?a_id=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
<?php }}}} ?>




<?php 
/////////////Display category sidebar widget
function sidebarCat() { ?>
            <div class="well">
                <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
    <?php
        //Make connection available outside of function
    global $db;
        //Query for all categories data
    $sb_cat_query = "SELECT * FROM cat;";
        //Validate query was successful
    $sb_cat_result = mysqli_query($db, $sb_cat_query);
    if(!$sb_cat_result){
        //Display as error message
        die("Query for categories failed" . mysqli_error($db));
    }
        //Dynamically populate sidebar from DB
    while($row = mysqli_fetch_assoc($sb_cat_result)){
        $sb_catid = $row['cat_id'];
        $sb_cat_title = $row['cat_title'];
        echo "<li><a href='category.php?cat={$sb_catid}'>$sb_cat_title</a></li>";
            //Save second row for future use
            // <div class="col-lg-6">
            //     <ul class="list-unstyled">
            //         <li><a href="#">Category Name</a>
            //         </li>
            //         <li><a href="#">Category Name</a>
            //         </li>
            //         <li><a href="#">Category Name</a>
            //         </li>
            //         <li><a href="#">Category Name</a>
            //         </li>
    } ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
<?php } ?>