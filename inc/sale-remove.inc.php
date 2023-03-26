<?php

include 'connect.inc.php';

$sale_id = $_GET['id'];
$query = "DELETE FROM sales WHERE sale_id='$sale_id'";
$result = mysqli_query($connect, $query);

header('Location: ../sales.php');
exit();