    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/udemyDemo/cms/">miaMakes</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                        //Query for all categories data
                        $cat_query = "SELECT * FROM cat";
                        //Validate query was successful
                        $cat_result = mysqli_query($db, $cat_query);
                        if(!$cat_result){
                            //Display as error message
                            die("Query for categories failed" . mysqli_error($db));
                        }
                        //Dynamically populate navbar from DB
                        while($row = mysqli_fetch_assoc($cat_result)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='category.php?cat={$cat_id}'>$cat_title</a></li>";
                        }
                    ?>

                    <?php 
                    if(isset($_SESSION['user_role'])){
                        $role = $_SESSION['user_role'];

                        if($role == 'Administrator'){
                            echo "<li><a href='../cms/admin/'>Admin</a></li>";
                        }
                    }
                    ?>

                    <?php 
                    if(isset($_SESSION['user_role'])){
                        if(isset($_GET['p_id'])){
                            echo $p_id = $_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$p_id}'>Edit</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>