<?php
  // get all users from the database
  $sql = 'SELECT * FROM categories';
  $connection = new mysqli('localhost:3306', 'root','', 'web2');
  $result = $connection->query($sql);
  $categories = $result->fetch_all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <title>Document</title>
</head>
<body>
<div class="container">
  <?php require ('header.php') ?>
  <h1>List of Users</h1>
    <table class="table table-light">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
      <tbody>
        <?php
          // loop users
            foreach($categories as $categorie) {
              echo "<tr><td>".$categorie[0]."</td><td>".$categorie[1]."</td><td><a href=\"edit.php?id=".$categorie[0]."\">Edit</a> | <a href=\"delete.php?name=".$categorie[0]."\">Delete</a>";
            }
        ?>
      </tbody>
    </table>
    <?php

  $connection->close();
?>
</div>
</body>
</html>