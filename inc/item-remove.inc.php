<?php

include 'connect.inc.php';

$item_id = $_GET['id'];
$query = "DELETE FROM items WHERE item_id='$item_id'";
$result = mysqli_query($connect, $query);

header('Location: ../stocks.php');
exit();