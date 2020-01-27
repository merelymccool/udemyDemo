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
                    <li><a href="../cms/admin/">Admin</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>