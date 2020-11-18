<?php
    require('functions.php');
    if($_POST){
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $user = authenticate($username, $password);

        if($user) {
            session_start();
            $_SESSION['user'] = $user;

            if($user['role'] === 'Administrador'){
                header('Location: admin.php');
            }else{
                header('Location: client.php');
            }
        } else {
            header('Location: index.php?status=login');
        }
    }
    
