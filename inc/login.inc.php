<?php

if(isset($_POST['login'])){

    // Connect to database
    include 'connect.inc.php';

    // Set variables
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Set a query to retrive user to login
    $query = "SELECT * FROM users WHERE user_name='$name'";

    // Result
    $result = mysqli_query($connect, $query);

    // Count result
    $count = mysqli_num_rows($result);

    // If no result, redirect to login page.
    if($count==0){
        header('Location: ../?e=1');
        exit();
    }

    // Fetch row
    $row = mysqli_fetch_assoc($result);

    // set variables for hash from database
    $hash = $row['user_hash'];

    // Check if password match
    if(!password_verify($password, $hash)){
        header('Location: ../?e=2');
        exit();
    }

    // Start session and login using user_id
    session_start();
    $_SESSION['user_id'] = $row['user_id'];
    header('Location: ../stocks.php?w');
    exit();
    
}



?>