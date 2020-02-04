<?php
        //Connect to the DB
    $connection = mysqli_connect('localhost', 'root', '', 'udemydemo');  
    if(!$connection) {
        //Display an error message
        die("Database connection failed");
    }