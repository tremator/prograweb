<?php
    require('functions.php');

    if($_POST){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $secondName = $_REQUEST['apellido'];
        $user = ['name' => $username, 'password' => $password, 'secondName' => $secondName];

        saveUser($user);
        
        header('Location: workShops/dashboard.php');

    }
    header('Location: dashboard.php');
?>