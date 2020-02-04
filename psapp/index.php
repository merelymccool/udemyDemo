<!-- Call this page's function -->


<!-- Call headers -->
<?php include "includes/header.php"; ?>

    <!-- Content -->
    <div class="container">
        <div class="col-sm-9">
            <h1 class="text-center">Welcome</h1>
            <table class="table table-responsive">
                <thead>
                    <th class="text-center success">Create</th>
                    <th class="text-center info">Read</th>
                </thead>
                <tbody>
                    <td class="text-center">
                        <img src="./images/create.png" alt="Add a Login"><br>
                        <a href="user_create.php">Add a Login</a>
                    </td>
                    <td class="text-center">
                        <img src="./images/read.png" alt="placeholder"><br>
                        <a href="user_read.php">List all Logins</a>
                    </td>
                </tbody>
                <thead>
                    <th class="text-center warning">Update</th>
                    <th class="text-center danger">Delete</th>
                </thead>
                <tbody>
                    <td class="text-center">
                        <img src="./images/update.png" alt="placeholder"><br>
                        <a href="user_update.php">Update a Login</a>
                    </td>
                    <td class="text-center">
                        <img src="./images/delete.png" alt="placeholder"><br>
                        <a href="user_delete.php">Delete a Login</a>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
