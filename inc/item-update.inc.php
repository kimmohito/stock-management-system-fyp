<?php

if(isset($_POST['add'])){

    $item_id = $_POST['add'];
    $item_name = $_POST['name'];
    $item_price = $_POST['price'];

    include 'connect.inc.php';

    $query = "UPDATE items SET item_name='$item_name', item_price='$item_price' WHERE item_id='$item_id'";
    $result = mysqli_query($connect, $query);

    header('location: ../stocks.php');
    exit();
}
