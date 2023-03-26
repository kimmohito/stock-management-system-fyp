<?php

    // Connect to Database
    $db_hostname = 'localhost';
    $db_username = 'root';
    $db_password = '';
    $db_database = 'sms_fyp';
    $connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or die('Error connect database!');

?>