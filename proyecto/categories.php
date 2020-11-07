<?php require('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Categories</h1>
    
    <?php
        $response = chargeCategories();
        while($row = $response->fetch_assoc()) {
            echo "<a href= 'subCategorie.php?father={$row['name']}'>{$row['name']}</a>...........................{$row['description']} <br>";
        }
    ?>

<div class ="container">
    <div class = "row">
    <h1>Create Categorie</h1>
    <form action="saveFatherCategorie.php" method="POST" class="form-inline" role="form">
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name of the categorie">
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" id="" name="description" placeholder="Description">
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
    </div>
    </div>

</body>
</html>