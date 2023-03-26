<?php

if(isset($_POST['add'])){

    $sale_date = $_POST['date'].' '.$_POST['time'];
    $item_id = $_POST['item']; 
    $sale_quantity = $_POST['quantity'];

    include 'connect.inc.php';

    // Get sales
    $query_sale = "SELECT SUM(sale_quantity) AS sale_total FROM sales WHERE item_id='$item_id'";
    $result_sale = mysqli_query($connect,$query_sale);
    $row_sale = mysqli_fetch_assoc($result_sale);
    $item_sale = $row_sale['sale_total'];

    // Get stock
    $query_stock = "SELECT SUM(purchase_quantity) AS purchase_total FROM purchases WHERE item_id='$item_id' AND purchase_status=1";
    $result_stock = mysqli_query($connect,$query_stock);
    $row_stock = mysqli_fetch_assoc($result_stock);
    $item_stock = $row_stock['purchase_total']-$item_sale;

    if($sale_quantity>$item_stock){
        header('location: ../sale-add.php?e=1');
        exit();
    }

    $query = "INSERT INTO sales (sale_date, item_id, sale_quantity) VALUES ('$sale_date', '$item_id', '$sale_quantity')";
    $result = mysqli_query($connect, $query);

    header('location: ../sales.php');
    exit();
}
