<?php
require('functions.php');
if($_POST){
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];

    createFatherCategorie($name,$description);
    
    header("Location: categories.php");

}
header('Location: index.php?status=error');