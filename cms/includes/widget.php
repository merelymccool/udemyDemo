<!-- Latest Comments Well -->
<div class="well">
    <h4>Latest Comments</h4>
    <p>
    <?php    //Query for all categories data
        $sb_com_query = "SELECT * FROM com ORDER BY com_date DESC LIMIT 3;";
            //Validate query was successful
        $sb_com_result = mysqli_query($db, $sb_com_query);
        if(!$sb_com_result){
            //Display as error message
            die("Query for comments failed" . mysqli_error($db));
        }
        while($row = mysqli_fetch_assoc($sb_com_result)){
            $sb_com_postid = $row['com_post_id'];
            $sb_com_content = $row['com_content'];    ?>
    <li><a href='posts.php?p_id=<?php echo $sb_com_postid; ?>'><?php echo $sb_com_content; ?></a></li>
    <?php } ?>
    </p>
</div>

<!-- Latest Posts Well -->
<div class="well">
    <h4>Latest Posts</h4>
    <p>
    <?php    //Query for all categories data
        $sb_post_query = "SELECT * FROM post ORDER BY post_date DESC LIMIT 5;";
            //Validate query was successful
        $sb_post_result = mysqli_query($db, $sb_post_query);
        if(!$sb_post_result){
            //Display as error message
            die("Query for posts failed" . mysqli_error($db));
        }
        while($row = mysqli_fetch_assoc($sb_post_result)){
            $sb_post_id = $row['post_id'];
            $sb_post_title = $row['post_title'];
            $sb_post_author = $row['post_author'];
            $sb_post_date = $row['post_date'];    ?>
    <li><a href='posts.php?p_id=<?php echo $sb_post_id; ?>'><?php echo $sb_post_title; ?></a> - by <?php echo $sb_post_author; ?> on <?php echo $sb_post_date; ?></li>
    <?php } ?>
    </p>
</div>

    
<!-- Side Widget Well -->
<div class="well">
    <h4>spaghetti yarn and groom forever</h4>
    <p>Get scared by doggo also cucumerro licks your face but chase red laser dot kitty kitty chew master's slippers. Cough damn that dog claws in the eye of the beholder for cry louder at reflection yet sniff all the things for see brother cat receive pets, attack out of jealousy cat snacks. More napping, more napping all the napping is exhausting cat milk copy park pee walk owner escape bored tired cage droppings sick vet vomit sun bathe, yet slap kitten brother with paw.</p>
</div>
