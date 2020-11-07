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
    <?php
    echo '<br>';
        require('functions.php');
        $respons = getClients();
        $haveProducts = false;
        while($row = $respons->fetch_assoc()) {
            echo "{$row['name']}.................{$row['seconName']} <br>";
            $haveProducts = true;

        }
    
    ?>
</body>
</html>