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
    <title>Supplier Add</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 bg-white border border-gray-200 rounded-md shadow-md text-center">
        <form action="inc/supplier-add.inc.php" method="post">
            <div class="text-2xl font-bold mb-4">
                Add New Supplier
            </div>
            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2" type="name" name="name" placeholder="Name" required/><br>
            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2" type="number" name="phone" placeholder="Phone" required/><br>
            <button class="bg-blue-500 text-white p-2 w-full rounded-md hover:bg-blue-400" type="submit" name="add">
                Add
            </button>
        </form>
    </div>

</body>
</html>