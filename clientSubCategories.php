<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Sub Categories</h1>
    <div></div>
    <button>
    <a href="clientCart.php">
    Cart
    </a>
    </button>
    <br>
    <?php  
    if($_GET){
        require('functions.php');
        $father = $_REQUEST['father'];

        $response = chargeSubCategories($father);

        while($row = $response->fetch_assoc()) {
            echo "<a href= 'clientSubCategories.php?father={$row['name']}'>{$row['name']}</a>...........................{$row['description']} <br>";
        }

        echo '<h1>Productos</h1>';
        
        
        $respons = chargeProductos($father);
        $haveProducts = false;
        while($row = $respons->fetch_assoc()) {
            echo "<button> <a href ='productForm.php?id={$row['id']}'> Agregar </a> </button>..............{$row['name']}.......{$row['description']}.........{$row['price']}............{$row['stock']}...........<image src = {$row['image']} width = '100' height = '100'> <br>";
            $haveProducts = true;

        }
    }
    ?>

   
</body>
</html>