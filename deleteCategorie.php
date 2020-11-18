<?php
    require('functions.php');
    if($_GET){
        $name = $_REQUEST['name'];
        deleteCategorie($name);

        header("Location: categories.php");
    }