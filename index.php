<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-4 bg-white border border-gray-200 rounded-md shadow-md text-center">
        <form action="inc/login.inc.php" method="post">
            <div class="text-2xl font-bold mb-4">
                Login
            </div>
            <?php
                if(isset($_GET['e'])){
                    if($_GET['e']==1){
                        echo '
                            <div class="mb-4 text-sm text-red-500">
                                *User does not existed.
                            </div>
                        ';
                    }
                    if($_GET['e']==2){
                        echo '
                            <div class="mb-4 text-sm text-red-500">
                                *Password does not match.
                            </div>
                        ';
                    }
                    if($_GET['e']==3){
                        echo '
                            <div class="mb-4 text-sm text-red-500">
                                *Please login first.
                            </div>
                        ';
                    }
                }
            ?>
            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2" type="name" name="name" placeholder="Username" required/><br>
            <input class="mb-4 border border-gray-200 rounded bg-gray-100 p-2" type="password" name="password" placeholder="Password" required/><br>
            <button class="bg-blue-500 text-white p-2 w-full rounded-md hover:bg-blue-400" type="submit" name="login">
                Login
            </button>
        </form>
    </div>

</body>
</html>