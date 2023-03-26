<?php

if(isset($_POST['add'])){

    $purchase_date = $_POST['date'].' '.$_POST['time'];
    $item_id = $_POST['item']; 
    $purchase_quantity = $_POST['quantity']; 
    $supplier_id = $_POST['supplier']; 
    $purchase_status = 0;

    include 'connect.inc.php';

    $query = "INSERT INTO purchases (purchase_date, item_id , purchase_quantity , supplier_id , purchase_status) VALUES ('$purchase_date', '$item_id', '$purchase_quantity', '$supplier_id', '$purchase_status')";
    $result = mysqli_query($connect, $query);

    header('location: ../purchases.php');
    exit();
}
