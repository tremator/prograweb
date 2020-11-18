<?php require('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Categories</h1>
    
    <div></div>
    <a href="clientCart.php">
    Cart
    </a>
    <?php
        $response = chargeCategories();
        while($row = $response->fetch_assoc()) {
            echo "<a href= 'clientSubCategories.php?father={$row['name']}'>{$row['name']}</a>...........................{$row['description']} <br>";
        }
    ?>



</body>
</html>