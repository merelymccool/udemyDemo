<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>
        <?php 
            //Validate GET data was received
            if(isset($_GET['edit'])){
                if($_SESSION['user_role'] == 'Administrator'){
                $adm_cat_edit = escape($_GET['edit']);
                //Verify data is not empty
                if(empty($adm_cat_edit)){
                    //Display an error message
                    echo "Category ID not found. Cannot edit!";
                } else {
                //Query for all categories data
                $adm_cat_editq = "SELECT * FROM cat WHERE cat_id = {$adm_cat_edit} ; ";
                //Verify query was successful
                $adm_cat_updated = mysqli_query($db,$adm_cat_editq);
                if(!$adm_cat_updated){
                    //Display as error message
                    die("Failed to update Category. " . mysqli_error($db));
                } else {
                    //Dynamically populate the value for category title from db
                    while($row = mysqli_fetch_assoc($adm_cat_updated)){
                        $edit_cat_id = $row['cat_id'];
                        $edit_cat_title = $row['cat_title']; ?>
        <input type="text" class="form-control" name="cat_title" value="<?php if(isset($edit_cat_title)) { echo $edit_cat_title; } ?>">
        <?php }}}}} ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update">
    </div>
</form>