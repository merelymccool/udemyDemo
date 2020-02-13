<!-- Call headers -->
<?php include "includes/header.php"; ?>

<!-- Call navigation -->
<?php include "includes/nav.php"; ?>

<?php 
    $postPerPage = '10';
    
    if(isset($_GET['page'])){
        $page = escape($_GET['page']);
    } else {
        $page = '';
    }

    if($page == '' || $page == 1){
        $page_1 = 0;
    } else {
        $page_1 = ($page * $postPerPage) - $postPerPage;
    }

    $count_query = "SELECT * FROM post WHERE post_status = 'published'; ";
    $count_result = mysqli_query($db,$count_query);
    if(!$count_result){
        die("Count posts query failed. " . mysqli_error($db));
    }
    $count = mysqli_num_rows($count_result);

    $count = ceil($count / $postPerPage);

    $perpage_query = "SELECT * FROM post WHERE post_status = 'published' LIMIT $page_1, $postPerPage; ";
    $perpage_result = mysqli_query($db,$perpage_query);
    if(!$perpage_result){
        die("Post per page query failed. " . mysqli_error($db));
    }

    while($row = mysqli_fetch_assoc($perpage_result)){
        $post_id = $row['post_id'];
        $post_id = $row['post_title'];
        $post_id = $row['post_author'];
        $post_id = $row['post_date'];
        $post_id = $row['post_image'];
        $post_id = $row['post_content'];
        $post_id = $row['post_status'];
    }
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- Page title -->
                <h1 class="page-header">
                    miaMakes
                    <small>all the posts</small>
                </h1>

                <!-- Display all posts -->
                <?php showAllPosts(); ?>

            </div>

            <!-- Call sidebar -->
            <?php include "includes/sidebar.php"; ?>            

        </div>
        <!-- /.row -->
        <hr>

        <ul class="pager">
        <!-- Pagination -->
        <?php 
        for($i = 1;  $i <= $count; $i++){
            echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
        ?>
        </ul>

        <!-- Call footer -->
        <?php include "includes/footer.php"; ?>