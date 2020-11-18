<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ADMIN</h1>
    <a href="categories.php">
        Categories
    </a>
    <button>
        <a href="logOut.php">
            LogOut
        </a>
    </button>
    <?php
    echo '<br>';
        require('functions.php');
        $respons = getClients();
        $haveProducts = false;
        while($row = $respons->fetch_assoc()) {
            echo "{$row['name']}.................{$row['seconName']} <br>";
            $haveProducts = true;

        }
        $sales = getsales();
        $totalSales = 0;
        $totalProductSales = 0;
        while($row = $sales->fetch_assoc()) {
            $totalSales += $row['total'];
            $totalProductSales += $row['cantidad'];
        }
    ?>
    <div>
        <h3>
            total sales:
        </h3>
        <p>
            <?php
                echo $totalSales
            ?>
        </p>
    </div>
    <div>
        <h3>
            total products sale:
        </h3>
        <p>
            <?php
                echo $totalProductSales
            ?>
        </p>
    </div>
</body>
</html>