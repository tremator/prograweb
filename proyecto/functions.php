
<?php

function getConnection() {
  $connection = new mysqli('localhost:3306', 'root', '', 'web2');
  if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    die;
  }
  return $connection;
}


function saveUser($user) {
    $conn = getConnection();
    $sql = "INSERT INTO users( `name`,`seconName` ,`password`, `role`) VALUES ('{$user['name']}', '{$user['secondName']}' ,'{$user['password']}', 'Cliente')";
    $conn->query($sql);
  
    if ($conn->connect_errno) {
      $conn->close();
      return false;
    }
    $conn->close();
    return true;
  }

  
  function authenticate($username, $password){
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE `name` = '$username' AND `password` = '$password'";
    $result = $conn->query($sql);
  
    if ($conn->connect_errno) {
      $conn->close();
      return false;
    }
    $conn->close();
    return $result->fetch_array();
  }

  function chargeCategories(){
    $conn = getConnection();
    $sql = "SELECT * FROM `categories` WHERE father = 'father'";
    $result = $conn ->query($sql);
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
  function chargeSubCategories($father){
    $conn = getConnection();
    $sql = "SELECT * FROM `categories` WHERE father = '{$father}'";
    $result = $conn ->query($sql);
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
  function createFatherCategorie($name, $description){
    $conn = getConnection();
    $sql = "INSERT INTO `categories`(`name`, `description`, `father`) VALUES ('{$name}','{$description}','father')";
    $conn->query($sql);
  
    if ($conn->connect_errno) {
      $conn->close();
      return false;
    }
    $conn->close();
    return true;
  }
  function createSubCategorie($name, $description, $father){
    $conn = getConnection();
    $sql = "INSERT INTO `categories`(`name`, `description`, `father`) VALUES ('{$name}','$description','{$father}')";
    $conn->query($sql);
  
    if ($conn->connect_errno) {
      $conn->close();
      return false;
    }
    $conn->close();
    return true;
  }
  function chargeProductos($categorie){
    $conn = getConnection();
    $sql = "SELECT * FROM `productos` WHERE categorie = '{$categorie}'";
    $result = $conn ->query($sql);
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
  function updateCategorie($categorie){
    $conn = getConnection();
    $sql = "UPDATE `categories` SET `name`='{$categorie['name']}',`description`='name' WHERE id = '{$categorie['id']}'";
    $result = $conn ->query($sql);
    
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
  function deleteCategorie($categorie){
    $conn = getConnection();
    $sql = "DELETE FROM `categories` WHERE name = $categorie";
    $result = $conn ->query($sql);
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
  function uploadPicture(){
    $fileObject = $_FILES['image'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($fileObject["name"]);
    $uploadOk = 0;
    if (move_uploaded_file($fileObject["tmp_name"], $target_file)) {
      return $target_file;
    } else {
      return '';
    }
  }
    function createProduct($product){

      $savefile = uploadPicture();
      if($savefile != ''){
        $conn = getConnection();
        $sql = "INSERT INTO `productos`(`name`, `description`, `categorie`, `price`, `stock`, `image`, `SKU`) VALUES ('{$product['name']}', '{$product['description']}','{$product['father']}',{$product['price']},0, '$savefile', '{$product['SKU']}')";
        $result = $conn ->query($sql);
        if($conn->connect_errno){
          $conn->close();
          return false;
        }
        $conn->close();
        return  $result;
      }else{
        return false;
      }
    }
    function deleteProduct($product){
      $conn = getConnection();
      $sql = "DELETE FROM `productos` WHERE name = '$product'";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
    }
    function updateProduct($product){
      $conn = getConnection();
      $savefile = uploadPicture();
      if($savefile != ''){
        $sql = "UPDATE `productos` SET `name`= '{$product['name']}',`description`='{$product['description']}',`price`='{$product['price']}',`stock`='{$product['stock']}',`image`= '$savefile',`SKU`='{$product['SKU']}' WHERE id = '{$product['id']}'";
        $result = $conn ->query($sql);
        if($conn->connect_errno){
          $conn->close();
          return false;
        }
        $conn->close();
        return  $result;
      }else{
        $sql = "UPDATE `productos` SET `name`= '{$product['name']}',`description`='{$product['description']}',`price`='{$product['price']}',`stock`='{$product['stock']}',`SKU`='{$product['SKU']}' WHERE id = '{$product['id']}'";
        $result = $conn ->query($sql);
        if($conn->connect_errno){
          $conn->close();
          return false;
        }
        $conn->close();
        return  $result;
      }
    }

    function getProduct($id){
      $conn = getConnection();
      $sql = "SELECT * FROM `productos` WHERE id = '{$id}'";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
    }

    function getCategorie($id){
      $conn = getConnection();
      $sql = "SELECT * FROM `categories` WHERE id = '{$id}'";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
    }
    
    function getClients(){
      $conn = getConnection();
      $sql = "SELECT * FROM users WHERE role = 'Cliente'";
      $result = $conn->query($sql);
    
      if ($conn->connect_errno) {
        $conn->close();
        return false;
      }
      $conn->close();
      return $result;
    }
  

