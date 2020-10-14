<?php
  if($_GET) {
    $name = $_REQUEST['name'];
    echo($name);
    $sql = "DELETE FROM categories WHERE name = '$name'";

    $connection = mysqli_connect('localhost:3306', 'root','','web2');
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header('Location: /index.php?status=success&message=User was created');
  } else {
    header('Location: /index.php?status=error&message=There was an error');
  } 