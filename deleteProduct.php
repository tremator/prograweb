<?php
    require('functions.php');
    if($_GET){
        $name = $_REQUEST['name'];
        deleteProduct($name);

        header("Location: categories.php");
    }