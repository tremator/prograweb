<?php
    if($_POST){
        require('functions.php');
        $name = $_REQUEST['name'];
        $descrption = $_REQUEST['description'];
        $father = $_REQUEST['father'];  
        $id = $_REQUEST['id'];
        $categorie = ['id' => $id,'name' => $name, 'description' => $descrption, 'father' => $father];
        updateCategorie($categorie);
        header("Location: categories.php");

    }