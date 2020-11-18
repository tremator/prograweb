

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>BUY CART</h1>
    <?php

        require('functions.php');
        session_start();
        $user = $_SESSION['user'];
        $result = getClientCart($user['id']);
        $totalPrice = 0;

        while($row = $result->fetch_assoc()) {
            $product = getProduct($row['id_producto'])->fetch_assoc();
            echo " {$product['name']}..................{$row['cantidad']}.................{$row['precio']}................<image src = {$product['image']} width = '100' height = '100'> <br>";
            $totalPrice += $row['precio'];
        }

    ?>

    <button> <a href="buyCart.php"> BUY </a> </button>
</body>
</html>

