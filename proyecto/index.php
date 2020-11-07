
<?php
  session_start();
  if ($_SESSION && $_SESSION['user']){
    //user already logged in
    $user = $_SESSION['user'];
    if($user['role'] === 'Administrador'){
        header('Location: admin.php');
    }else{
        header('Location: client.php');
    }
  }

  $message = "";
  if(!empty($_REQUEST['status'])) {
    switch($_REQUEST['status']) {
      case 'login':
        $message = 'User does not exists';
      break;
      case 'error':
        $message = 'There was a problem inserting the user';
      break;
    }
  }

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
    <div class ="container">
    <div class = "row">
    <h1>Welcome to E-Shop</h1>
    <form action="login.php" method="POST" class="form-inline" role="form">
      <div class="form-group">
        <label class="sr-only" for="">Username</label>
        <input type="text" class="form-control" id="" name="username" placeholder="Your username">
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Password</label>
        <input type="password" class="form-control" id="" name="password" placeholder="Your password">
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div>
        <p>if you are not register, click <a href = "registerform.php">Here</a></p>
    
        </div>
    </div>
    </div>
</body>
</html>