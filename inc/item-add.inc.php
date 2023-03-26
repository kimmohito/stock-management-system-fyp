<?php

if(isset($_POST['add'])){

    $item_name = $_POST['name'];
    $item_price = $_POST['price'];

    include 'connect.inc.php';

    $item_id = uniqid();

    $query = "INSERT INTO items (item_id, item_name, item_price) VALUES ('$item_id', '$item_name', '$item_price')";
    $result = mysqli_query($connect, $query);

    header('location: ../stocks.php');
    exit();
}
