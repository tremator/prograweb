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
        $response = getProduct($id);
        $product = $response->fetch_assoc();
    }else{

    }


?>

<h1>Update Product</h1>
    <form action="editProduct.php" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
    <div class="form-group">
        <label class="sr-only" for="">ID</label>
        <input type="text" class="form-control" id="" readonly name="id" placeholder="id" value =<?php echo $product['id'] ?>>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name of the product" value =<?php echo $product['name'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" id="" name="description" placeholder="Description" value =<?php echo $product['description'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">SKU</label>
        <input type="text" class="form-control" id="" name="SKU" placeholder="SKU" value =<?php echo $product['SKU'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Price</label>
        <input type="number" class="form-control" id="" name="price" placeholder="price" value =<?php echo $product['price'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Stock</label>
        <input type="number" class="form-control" id="" name="stock" placeholder="stock" value =<?php echo $product['stock'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Father Categorie</label>
        <input type="text" readonly class="form-control" id="" name="father"  value =<?php echo $product['categorie'] ?> required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Product Image</label>
        <input type="file" class="form-control" id="" name="image" required>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
    </div>
    </div>
    
    
</body>
</html>