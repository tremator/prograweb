<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>
        Buy Details
    </h1>
    <?php
        require('functions.php');
        $orderId = $_REQUEST['id'];
        $date = $_REQUEST['fecha'];
        $total = $_REQUEST['total'];
        echo "<h2>Date:{$date}</h2>";
        echo "<h2>Total:{$total}</h2>";
        $result = getUserBuys($orderId);
        while($row = $result->fetch_assoc()) {
            $product = getProduct($row['id_producto']);
            echo "{$product['name']}...............{$product['description']}.............{$product['price']} <br>";
        }
    ?>
    
</body>
</html>