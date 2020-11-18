<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
    
</div>
    </div>
    <div class ="container">
    <div class = "row">
    <h1>Create Product</h1>
    <form action="addToCart.php" method="POST" class="form-inline" role="form">
    <div class="form-group">
        <label class="sr-only" for="">id</label>
        <input type="text" class="form-control" readonly id="" name="id" placeholder="id" value = <?php echo $product['id']?>>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" readonly id="" name="name" placeholder="Name of the product" value = <?php echo $product['name'] ?>>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" readonly id="" name="description" placeholder="Description" value = <?php echo $product['description'] ?>>
      </div>
      
        <label class="sr-only" for="">Price</label>
        <input type="number" class="form-control" readonly id="" name="price" placeholder="price" value = <?php echo $product['price'] ?>>
      </div>
      <div>
        <label class="sr-only" for="">Amount</label>
        <input type="number" class="form-control" id="" name="amount" placeholder="amount" required>
      </div>
      
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
    </div>
</div>

</body>
</html>