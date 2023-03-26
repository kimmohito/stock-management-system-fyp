<?php

include 'connect.inc.php';

$purchase_id = $_GET['id'];
$query = "UPDATE purchases SET purchase_status=1 WHERE purchase_id='$purchase_id'";
$result = mysqli_query($connect, $query);

header('Location: ../purchases.php');
exit();