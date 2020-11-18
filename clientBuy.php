<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>BUYS</h1>
    <?php
        require('functions.php');
        session_start();
        $user = $_SESSION['user'];
        $result = getUserBuys($user['id']);
        while($row = $result->fetch_assoc()) {
            echo "<a href='buyDetails.php>id={$row['id']}'>{$row['fecha']}</a>............................{$row['total']} <br>";
        }
    ?>
    
</body>
</html>