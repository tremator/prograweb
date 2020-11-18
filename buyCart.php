<?php

    session_start();
    $user = $_SESSION['user'];
    require('functions.php');

    $result = getClientCart($user['id']);
    $totalPrice = 0;
    $today = getdate();
    $date = "{$today['year']}/{$today['month']}/{$today['mday']}";
    /*
    while($row = $result->fetch_assoc()) {
        $totalPrice += $row['precio'];
    }
    $newOrder = ['fecha' => $date, 'total' => $totalPrice,'id_user' => $user['id']];
    $order = createOrder($newOrder);
    var_dump($order);
    die;
    */
    while($row = $result->fetch_assoc()) {
        $buy = ['id' => $row['id_producto'], 'cantidad' => $row['cantidad'], 'total' => $row['precio'], 'id_user' => $row['id_user'],'fecha' => $date];
        $totalPrice += $row['precio'];
        buy($buy);
    }


    clearCart($user['id']);

    header('Location: index.php');
