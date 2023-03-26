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
    <title>Sales</title>
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
                Sales
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
                        Quantity
                    </th>
                    <th class="p-2">
                        Option
                    </th>
                </tr>

                <?php
                
                    // Connect to database
                    include 'inc/connect.inc.php';
                
                    // Query all items
                    $query = "SELECT * FROM sales";

                    // Result
                    $result = mysqli_query($connect,$query);

                    while($row = mysqli_fetch_assoc($result)){

                        $sale_id = $row['sale_id'];
                        $sale_date = $row['sale_date'];
                        $item_id = $row['item_id'];
                        $sale_quantity = $row['sale_quantity'];

                        echo '<tr class="border-b border-gray-200">';

                            echo '<td class="p-2">'.$sale_id.'</td>';
                            echo '<td class="p-2">'.$sale_date.'</td>';


                            echo '<td class="p-2">';
                                // Get item name, id
                                $query_item = "SELECT * FROM items WHERE item_id='$item_id'";
                                $result_item = mysqli_query($connect,$query_item);
                                while($row_item = mysqli_fetch_assoc($result_item)){
                                    echo $row_item['item_name'].' ('.$row_item['item_id'].')<br>';
                                }
                            echo '</td>';

                            echo '<td class="p-2">'.$sale_quantity.'</td>';

                            echo '<td class="p-2">';
                                echo '<a href="inc/sale-remove.inc.php?id='.$sale_id.'" class="pl-2">Remove</a>';
                            echo '</td>';



                        echo '</tr>';

                    }

                    // Add new purchase
                    echo '<tr>';
                        echo '<td class="p-2" colspan=5>';
                            echo '<a href="sale-add.php">Add new sale</a>';
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