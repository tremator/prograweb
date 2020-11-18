<?php
require('functions.php');
if($_POST){
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];
    $father = $_REQUEST['father'];

    createSubCategorie($name,$description,$father);
    
    header("Location: /proyecto/subCategorie.php?father='{$father}'");

}else{
    header('Location: index.php?status=error');
}