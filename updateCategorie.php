<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if($_GET){
        require('functions.php');
        $id = $_REQUEST['id'];
        $response = getCategorie($id);
        $Categorie = $response->fetch_assoc();
    }else{

    }

?>
<div class ="container">
    <div class = "row">
    <h1>Update Categorie</h1>
    <form action="editCategorie.php" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
        <div class="form-group">
        <label class="sr-only" for="">Id</label>
        <input type="text" readonly class="form-control" id="" name="name" placeholder="Name of the categorie" value=<?php echo $Categorie['id']?>>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name of the categorie" value=<?php echo $Categorie['name']?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" id="" name="description" placeholder="Description" value=<?php echo $Categorie['description']?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Father Categorie</label>
        <input type="text" readonly class="form-control" id="" name="father" value=<?php echo $Categorie['father']?>>
      </div>
      
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
    </div>
</body>
</html>