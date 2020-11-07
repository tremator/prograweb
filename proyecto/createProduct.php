<?php
    require('functions.php');

    if($_POST){
        $name = $_REQUEST['name'];
        $descrption = $_REQUEST['description'];
        $father = $_REQUEST['father'];
        $price = $_REQUEST['price'];
        $sku = $_REQUEST['SKU'];
        $product = ['name' => $name, 'description' => $descrption, 'father' => $father, 'price' => $price, 'SKU' => $sku];
        
        createProduct($product);

    }