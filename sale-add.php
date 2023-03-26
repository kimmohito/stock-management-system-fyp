<?php
    session_start();
    if(!$_SESSION['user_id']){
        header('Location: ../?e=3');
        exit();
    }
    date_default_timezone_set('Asia/Kuala_Lumpur');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Add</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 bg-white border border-gray-200 rounded-md shadow-md text-center">
        <form action="inc/sale-add.inc.php" method="post">
            <div class="text-2xl font-bold mb-4">
                Add New Sale
            </div>
            <?php
                if(isset($_GET['e'])){
                    if($_GET['e']==1){
                        echo '
                            <div class="mb-4 text-sm text-red-500">
                                *Item is out of stock. Try different amount. 
                            </div>
                        ';
                    }
                }
            ?>
            

            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2 w-full" type="date" name="date" placeholder="Date" value="<?php echo date('Y-m-d'); ?>" required/><br>

            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2 w-full" type="time" name="time" placeholder="Time" value="<?php echo date('H:i:s'); ?>" required/><br>

            <select class="mb-4 border border-gray-200 rounded bg-gray-100 p-2 w-full" name="item" required>
                <?php
                    echo '<option value="" style="display:none">Item</option>';
                    include 'inc/connect.inc.php';
                    $query = "SELECT * FROM items ORDER BY item_name ASC";
                    $result = mysqli_query($connect, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row['item_id'].'">'.$row['item_name'].'</option>';
                    }

                ?>
            </select>



            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2 w-full" type="number" name="quantity" placeholder="Quantity" step="1" required/><br>

            <button class="bg-blue-500 text-white p-2 w-full rounded-md hover:bg-blue-400" type="submit" name="add">
                Add
            </button>
        </form>
    </div>

</body>
</html>