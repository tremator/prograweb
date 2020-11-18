<?php

    session_start();
    require('functions.php');
    if($_POST){
        $user = $_SESSION['user'];
        $idProduct = $_REQUEST['id'];
        $uniPrice = $_REQUEST['price'];
        $amount = $_REQUEST['amount'];
        $totalPrice = $uniPrice * $amount;

        $product = ['id_user' => $user['id'], 'id_product' => $idProduct, 'cantidad' => $amount, 'price' => $totalPrice];

        $result = addCartProduct($product);
        if($result == true){
            header('Location: clientCategories.php');
        }
    }

?>