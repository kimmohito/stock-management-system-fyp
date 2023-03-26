<?php

if(isset($_POST['add'])){

    $supplier_id = $_POST['add'];
    $supplier_name = $_POST['name'];
    $supplier_contact = $_POST['phone'];

    include 'connect.inc.php';

    $query = "UPDATE suppliers SET supplier_name='$supplier_name', supplier_contact='$supplier_contact' WHERE supplier_id='$supplier_id'";
    $result = mysqli_query($connect, $query);

    header('location: ../suppliers.php');
    exit();
}
