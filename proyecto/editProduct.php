
<?php
    if($_POST){
        require('functions.php');
        $name = $_REQUEST['name'];
        $descrption = $_REQUEST['description'];
        $father = $_REQUEST['father'];
        $price = $_REQUEST['price'];
        $sku = $_REQUEST['SKU'];
        $id = $_REQUEST['id'];
        $stock = $_REQUEST['stock'];
        $product = ['id' => $id,'name' => $name, 'description' => $descrption, 'father' => $father, 'price' => $price, 'SKU' => $sku, 'stock' => $stock];
        
        updateProduct($product);

        header("Location: categories.php");

    }