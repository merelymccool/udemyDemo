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
        $a_id = $_GET['a_id'];
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
        $post_cat_id = $_GET['cat'];
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
        $p_id = $_GET['p_id'];
    }
        //Query for all post data
    $post_query = "SELECT * FROM post WHERE post_id = {$p_id}";
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
<?php }} ?>




<?php
//////////Displays search results
function showSearchPosts() {
        //Make connection available outside of function
    global $db;
        //Validate POST data received
    if(isset($_POST['search'])){
        //Assign input to variable
        $search_terms = $_POST['terms'];
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