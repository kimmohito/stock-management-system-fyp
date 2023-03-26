<?php

include 'connect.inc.php';

$supplier_id = $_GET['id'];
$query = "DELETE FROM suppliers WHERE supplier_id='$supplier_id'";
$result = mysqli_query($connect, $query);

header('Location: ../suppliers.php');
exit();