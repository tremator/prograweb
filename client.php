<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button>
        <a href="logOut.php">
            LogOut
        </a>
    </button>
    </button>
    <div height = '100'>
     </div>
    <button>
        <a href="clientCart.php">
    Cart
    </a>
    </button>
    </button>
        <div height = '100'>
        </div>
        <button>
        <a href="clientBuy.php">
        View Buys
    </a>
    </button>
    <h2>Categories</h2>
    <?php
    echo '<br>';
        require('functions.php');
        $respons = chargeCategories();
        $haveProducts = false;
        while($row = $respons->fetch_assoc()) {
            echo "<a href ='clientSubCategories.php?father={$row['name']}'>{$row['name']}</a>.................{$row['description']} <br>";
            $haveProducts = true;
        }
    ?>
</body>
</html>