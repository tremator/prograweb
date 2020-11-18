
<?php
    
    require('functions.php');
    $cantidad = $argv[1];
    $result = getProductsByStock($cantidad);
    $message ='Productos con bajor Stock';

    while($row = $result->fetch_assoc()) {
        $message = "$message, {$row['SKU']}";
    }
    mail('dmsolisa@gmail.com', 'LOW STOCK', $message);