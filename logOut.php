<?php
    session_start();

    $user = $_SESSION['user'];
    $_SESSION['user'] =[] ;
    header('Location: index.php');