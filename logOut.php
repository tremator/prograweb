<?php
    session_start();
    require('functions.php');

    $user = $_SESSION['user'];
    $result =  getClientCart($user['id']);
    $amountItems = 0;
    while($row = $result->fetch_assoc()) {
        $amountItems +=1;
        break;
    }

    if($amountItems > 0){
        while($row = $result->fetch_assoc()) {
            $buy = ['id' => $row['id_producto'], 'cantidad' => $row['cantidad'], 'total' => $row['precio'], 'id_user' => $row['id_user'],'fecha' => $date];
            $totalPrice += $row['precio'];
            buy($buy);
        }
    }
    $_SESSION['user'] =[] ;
    header('Location: index.php');