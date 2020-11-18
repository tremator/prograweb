
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

  /*
    CONECTIONS FOR THE CATEGORIES
  */

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
  /*
    CONECTIONS FOR THE PRODUCTS
  */
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
      return  $result->fetch_assoc();
    }
    function getProductsByStock($stock){
      $conn = getConnection();
        $sql = "SELECT * FROM `productos` WHERE stock <= $stock ";
        $result = $conn ->query($sql);
        if($conn->connect_errno){
          $conn->close();
          return false;
        }
        $conn->close();
        return  $result;
    }

    
    
    /*
      ACTIONS FOR THE USER
    */

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
  
    function getClientOrders($id){
      $conn = getConnection();
      $sql = "SELECT * FROM `userbuy` WHERE user_id = '{$id}'";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
    }

    function addCartProduct($product){
      $conn = getConnection();
      $sql = "INSERT INTO `usercart`(`id_user`, `id_producto`, `cantidad`, `precio`) VALUES ('{$product['id_user']}','{$product['id_product']}','{$product['cantidad']}','{$product['price']}')";
 
      $conn->query($sql);
    
      if ($conn->connect_errno) {
        $conn->close();
        return false;
      }
      $conn->close();
      return true;
    }
    function getClientCart($id){
      $conn = getConnection();
      $sql = "SELECT * FROM `usercart` WHERE id_user = '{$id}'";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
    }
    function buy($product){
      $conn = getConnection();

      $sql = "INSERT INTO `ventas`(`id_producto`, `cantidad`, `total`, `id_user`, `fecha`, `order_id`) VALUES ('{$product['id']}','{$product['cantidad']}','{$product['total']}','{$product['id_user']}','{$product['fecha']}','{$product['order_id']}')";

      $conn->query($sql);
      if ($conn->connect_errno) {
        $conn->close();
        return false;
      }
      updateStock($product['id'],$product['cantidad']);
      $conn->close();
      return true;
    }
    function createOrder($order){
      $conn = getConnection();
      $sql = "INSERT INTO `userbuy`(`fecha`, `total`,`user_id`) VALUES ('{$order['fecha']}', '{$order['total']}', '{$order['id_user']}')";
      $result = $conn->query($sql);
      
      if ($conn->connect_errno) {
        $conn->close();
        return false;
      }
      $id = $conn->insert_id;
      $conn->close();
      return $id;
    }
    function clearCart($id){
      $conn = getConnection();
      $sql = "DELETE FROM `usercart` WHERE id_user = $id";
      $conn->query($sql);
    
      if ($conn->connect_errno) {
        $conn->close();
        return false;
      }
      $conn->close();
      return true;
    }
  function getsales(){
    $conn = getConnection();
      $sql = "SELECT * FROM `ventas`";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
  }
  function getUserBuys($id){
    $conn = getConnection();
      $sql = "SELECT * FROM `ventas` WHERE order_id = $id";
      $result = $conn ->query($sql);
      if($conn->connect_errno){
        $conn->close();
        return false;
      }
      $conn->close();
      return  $result;
  }

  function updateStock($idProduct, $cantidad){
    $conn = getConnection();
    $product = getProduct($idProduct)->fetch_assoc();
    $newStock = $product['stock'] - $cantidad;
    $sql = "UPDATE `productos` SET`stock`= $newStock WHERE id = $idProduct";
    $result = $conn ->query($sql);
    if($conn->connect_errno){
      $conn->close();
      return false;
    }
    $conn->close();
    return  $result;
  }
 

