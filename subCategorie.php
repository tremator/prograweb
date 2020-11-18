<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sub Categories</h1>
    <?php  
    if($_GET){
        require('functions.php');
        $father = $_REQUEST['father'];

        $response = chargeSubCategories($father);

        while($row = $response->fetch_assoc()) {
            echo "<button> <a href='updateCategorie.php?id={$row['id']}'> Update</a> </button>...............<a href= 'subCategorie.php?father={$row['name']}'>{$row['name']}</a>...........................{$row['description']} <br>";
        }

        echo '<h1>Productos</h1>';
        
        
        $respons = chargeProductos($father);
        $haveProducts = false;
        while($row = $respons->fetch_assoc()) {
            echo "<button><a href = 'deleteProduct.php?id={$row['name']}'> delete </a></button> {$row['SKU']}......<a href = 'updateProduct.php?id={$row['id']}'>{$row['name']}</a>.......{$row['description']}.........{$row['price']}............{$row['stock']}...........<image src = {$row['image']} width = '100' height = '100'> <br>";
            $haveProducts = true;

        }
        if($haveProducts == false){
        echo "<button type='button'> <a href = deleteCategorie.php?name='{$father}'> delete </a></button>";
        }
        
    }
    ?>

    <div class ="container">
    <div class = "row">
    <h1>Create Categorie</h1>
    <form action="saveSubCategorie.php" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name of the categorie" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" id="" name="description" placeholder="Description" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Father Categorie</label>
        <input type="text" readonly class="form-control" id="" name="father"  value = <?php echo $father ?>>
      </div>
      
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
    </div>
    </div>
    <div class ="container">
    <div class = "row">
    <h1>Create Product</h1>
    <form action="createProduct.php" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
      <div class="form-group">
        <label class="sr-only" for="">Name</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Name of the product" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Descripcion</label>
        <input type="text" class="form-control" id="" name="description" placeholder="Description" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">SKU</label>
        <input type="text" class="form-control" id="" name="SKU" placeholder="SKU" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Price</label>
        <input type="number" class="form-control" id="" name="price" placeholder="price" min = "1" required>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Father Categorie</label>
        <input type="text" readonly class="form-control" id="" name="father"  value = <?php echo $father ?>>
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Product Image</label>
        <input type="file" class="form-control" id="" name="image" required>
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </form>
    
    </div>
    </div>
    
</body>
</html>