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
    <title>Purchases</title>
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
                Purchases
            </div>

            <table class="border border-gray-200 w-full table-auto text-center rounded-md overflow-hidden shadow-md">
                <tr class="bg-blue-500 text-white">
                    <th class="p-2">
                        Id
                    </th>
                    <th class="p-2">
                        Date
                    </th>
                    <th class="p-2">
                        Items
                    </th>
                    <th class="p-2">
                        Suppliers
                    </th>
                    <th class="p-2">
                        Status
                    </th>
                    <th class="p-2">
                        Option
                    </th>
                </tr>

                <?php
                
                    // Connect to database
                    include 'inc/connect.inc.php';
                
                    // Query all items
                    $query = "SELECT * FROM purchases";

                    // Result
                    $result = mysqli_query($connect,$query);

                    while($row = mysqli_fetch_assoc($result)){

                        $purchase_id = $row['purchase_id'];
                        $purchase_date = $row['purchase_date'];
                        $item_id = $row['item_id'];
                        $supplier_id = $row['supplier_id'];
                        $purchase_status = $row['purchase_status'];

                        echo '<tr class="border-b border-gray-200">';

                            echo '<td class="p-2">'.$purchase_id.'</td>';
                            echo '<td class="p-2">'.$purchase_date.'</td>';


                            echo '<td class="p-2">';
                                // Get item name, id
                                $query_item = "SELECT * FROM items WHERE item_id='$item_id'";
                                $result_item = mysqli_query($connect,$query_item);
                                while($row_item = mysqli_fetch_assoc($result_item)){
                                    echo $row_item['item_name'].' ('.$row_item['item_id'].')<br>';
                                }
                            echo '</td>';

                            echo '<td class="p-2">';
                                // Get supplier name, contact
                                $query_supplier = "SELECT * FROM suppliers WHERE supplier_id='$supplier_id'";
                                $result_supplier = mysqli_query($connect,$query_supplier);
                                while($row_supplier = mysqli_fetch_assoc($result_supplier)){
                                    echo $row_supplier['supplier_name'].' ('.$row_supplier['supplier_contact'].')<br>';
                                }
                            echo '</td>';

                            echo '<td class="p-2">';
                                if($purchase_status!='1'){
                                    echo '<span class="p-1 px-2 rounded-md bg-yellow-500 text-white">Pending</span>';
                                }else{
                                    echo '<span class="p-1 px-2 rounded-md bg-green-500 text-white">Completed</span>';
                                }
                                
                            echo '</td>';

                            echo '<td class="p-2">';
                                if($purchase_status!='1'){
                                    echo '<a href="purchase-complete.php?id='.$purchase_id.'">Complete</a>';
                                    echo '<a href="purchase-edit.php?id='.$purchase_id.'" class="pl-2">Edit</a>';
                                    echo '<a href="purchase-remove.php?id='.$purchase_id.'" class="pl-2">Remove</a>';
                                }else{
                                    echo '-';
                                }
                                
                            echo '</td>';



                        echo '</tr>';

                    }

                    // Add new purchase
                    echo '<tr>';
                        echo '<td class="p-2" colspan=6>';
                            echo '<a href="purchase-add.php">Add new purchase</a>';
                        echo '</td>';
                    echo '</tr>';



                ?>





            </table>


        </div>

    </div>






</body>
</html>