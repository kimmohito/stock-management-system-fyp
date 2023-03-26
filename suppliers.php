<?php
    session_start();
    if(!$_SESSION['user_id']){
        header('Location: ../?e=3');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="m-auto bg-white max-w-7xl">

        <?php
            include 'nav.php';
        ?>

        <div class="mt-4 p-4">
            
            <div class="mb-2 text-2xl">
                Suppliers
            </div>

            <table class="border border-gray-200 w-full table-fixed text-center rounded-md overflow-hidden shadow-md">
                <tr class="bg-blue-500 text-white">
                    <th class="p-2">
                        Supplier Name
                    </th>
                    <th class="p-2">
                        Contact
                    </th>
                    <th class="p-2">
                        Item Supplied
                    </th>
                    <th class="p-2">
                        Option
                    </th>
                </tr>

                <?php
                
                    // Connect to database
                    include 'inc/connect.inc.php';
                
                    // Query all items
                    $query = "SELECT * FROM suppliers ORDER BY supplier_name ASC";

                    // Result
                    $result = mysqli_query($connect,$query);

                    while($row = mysqli_fetch_assoc($result)){

                        $supplier_id = $row['supplier_id'];
                        $supplier_name = $row['supplier_name'];
                        $supplier_contact = $row['supplier_contact'];

                        // Get item id
                        $items = [];
                        $query_purchase = "SELECT DISTINCT item_id FROM purchases WHERE supplier_id='$supplier_id'";
                        $result_purchase = mysqli_query($connect,$query_purchase);
                        $count_purchase = mysqli_num_rows($result_purchase);
                        while($row_purchase = mysqli_fetch_assoc($result_purchase)){
                            $items[] = $row_purchase['item_id'];
                        }

                        echo '<tr class="border-b border-gray-200">';

                            echo '<td class="p-2">'.$supplier_name.'</td>';
                            echo '<td class="p-2">'.$supplier_contact.'</td>';
                            echo '<td class="p-2">';
                                foreach($items as $item_id){
                                    // Get supplier name, contact
                                    $query_item = "SELECT * FROM items WHERE item_id='$item_id'";
                                    $result_item = mysqli_query($connect,$query_item);
                                    while($row_item = mysqli_fetch_assoc($result_item)){
                                        echo $row_item['item_name'].' ('.$row_item['item_id'].')<br>';
                                    }
                                }
                            echo '</td>';

                            echo '<td class="p-2">';                      
                                echo '<a href="supplier-edit.php?id='.$supplier_id.'">Edit</a>';
                                if($count_purchase==0){
                                    echo '<a href="inc/supplier-remove.inc.php?id='.$supplier_id.'" class="pl-2">Remove</a>';
                                }
                            echo '</td>';


                        echo '</tr>';


                    }

                    // Add new item
                    echo '<tr>';
                        echo '<td class="p-2" colspan=4>';
                            echo '<a href="supplier-add.php">Add new supplier</a>';
                        echo '</td>';
                    echo '</tr>';
                ?>





            </table>


        </div>
        <?php
            include 'footer.php';
        ?>

    </div>






</body>
</html>