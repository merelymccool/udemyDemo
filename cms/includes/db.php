<?php 
        //Define DB variables
    $db['db_host'] = 'localhost';
    $db['db_user'] = 'root';
    $db['db_pass'] = '';
    $db['db_name'] = 'cms';
        //Loop through variables and create constants
    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }
        //Connect to DB with constants
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        //Validate DB connection
    if(!$db){
        //Display an error message
        die("Houston, we have a problem" . mysqli_error($db));
    }
?>