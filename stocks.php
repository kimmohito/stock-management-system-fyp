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
    <title>Stocks</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="m-auto bg-white max-w-7xl">

        <?php
            include 'welcome.php';
        ?>

        <?php
            include 'nav.php';
        ?>

        

        <div class="mt-4 p-4">
            
            <div class="mb-2 text-2xl">
                Stocks
            </div>

            <table class="border border-gray-200 w-full table-fixed text-center rounded-md overflow-hidden shadow-md">
                <tr class="bg-blue-500 text-white">
                    <th class="p-2">
                        Id
                    </th>
                    <th class="p-2">
                        Name
                    </th>
                    <th class="p-2">
                        Prices
                    </th>
                    <th class="p-2">
                        Stocks
                    </th>
                    <th class="p-2">
                        Purchases
                    </th>
                    <th class="p-2">
                        Sales
                    </th>
                    <th class="p-2">
                        Suplliers
                    </th>
                    <th class="p-2">
                        Option
                    </th>
                </tr>

                <?php
                
                    // Connect to database
                    include 'inc/connect.inc.php';
                
                    // Query all items
                    $query = "SELECT * FROM items";

                    // Result
                    $result = mysqli_query($connect,$query);

                    while($row = mysqli_fetch_assoc($result)){

                        $item_id = $row['item_id'];
                        $item_name = $row['item_name'];
                        $item_price = $row['item_price'];

                        
                        // Get sales
                        $query_sale = "SELECT SUM(sale_quantity) AS sale_total FROM sales WHERE item_id='$item_id'";
                        $result_sale = mysqli_query($connect,$query_sale);
                        $row_sale = mysqli_fetch_assoc($result_sale);
                        $item_sale = $row_sale['sale_total'];

                        // Get purchase
                        $query_purchase = "SELECT SUM(purchase_quantity) AS purchase_total FROM purchases WHERE item_id='$item_id' AND purchase_status=0";
                        $result_purchase = mysqli_query($connect,$query_purchase);
                        $row_purchase = mysqli_fetch_assoc($result_purchase);
                        $item_purchase = $row_purchase['purchase_total'];

                        // Get stock
                        $query_stock = "SELECT SUM(purchase_quantity) AS purchase_total FROM purchases WHERE item_id='$item_id' AND purchase_status=1";
                        $result_stock = mysqli_query($connect,$query_stock);
                        $row_stock = mysqli_fetch_assoc($result_stock);
                        $item_stock = $row_stock['purchase_total']-$item_sale;

                        // Get suppliers
                        $item_suppliers = [];
                        $query_suppliers = "SELECT DISTINCT supplier_id FROM purchases WHERE item_id='$item_id'";
                        $result_suppliers = mysqli_query($connect,$query_suppliers);
                        while($row_suplliers = mysqli_fetch_assoc($result_suppliers)){
                            $item_suppliers[] = $row_suplliers['supplier_id'];
                        }
                        

                        echo '<tr class="border-b border-gray-200">';

                            echo '<td class="p-2">'.$item_id.'</td>';
                            echo '<td class="p-2">'.$item_name.'</td>';
                            echo '<td class="p-2">'.$item_price.'</td>';
                            echo '<td class="p-2">'.$item_stock.'</td>';
                            echo '<td class="p-2">'.$item_purchase.'</td>';
                            echo '<td class="p-2">'.$item_sale.'</td>';
                            echo '<td class="p-2">';
                                foreach($item_suppliers as $supplier_id){
                                    // Get supplier name, contact
                                    $query_supplier = "SELECT * FROM suppliers WHERE supplier_id='$supplier_id'";
                                    $result_supplier = mysqli_query($connect,$query_supplier);
                                    while($row_supplier = mysqli_fetch_assoc($result_supplier)){
                                        echo $row_supplier['supplier_name'].' ('.$row_supplier['supplier_contact'].')<br>';
                                    }
                                }
                            echo '</td>';
                            echo '<td class="p-2">';
                                echo '<a href="item-edit.php">Edit</a>';
                                echo '<a href="item-remove.php" class="pl-2">Remove</a>';
                            echo '</td>';

                        echo '</tr>';

                    }

                    // Add new item
                    echo '<tr>';
                        echo '<td class="p-2" colspan=8>';
                            echo '<a href="item-add.php">Add new item</a>';
                        echo '</td>';
                    echo '</tr>';



                ?>





            </table>


        </div>

    </div>






</body>
</html>