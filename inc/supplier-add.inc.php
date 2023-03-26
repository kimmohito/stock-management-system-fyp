<?php

if(isset($_POST['add'])){

    $supplier_name = $_POST['name'];
    $supplier_contact = $_POST['phone'];

    include 'connect.inc.php';

    $query = "INSERT INTO suppliers (supplier_name, supplier_contact) VALUES ('$supplier_name', '$supplier_contact')";
    $result = mysqli_query($connect, $query);

    header('location: ../suppliers.php');
    exit();
}
