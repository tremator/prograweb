<?php
  session_start();

  $user = $_SESSION['user'];
  if (!$user) {
    header('Location: index.php');
  }
  ?>
  <h1> Bienvenido <?php echo $user['name']," " ,$user['seconName']; ?> </h1>
  <a href="logout.php">Logout</a>

  <nav class="nav">
    <?php  if($user['role'] === 'Administrador') { ?>
        
        <form action="save.php" method="POST" class="form-inline" role="form">
      <div class="form-group">
        <label class="sr-only" for="">Username</label>
        <input type="text" class="form-control" id="" name="username" placeholder="Your username">
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Second name</label>
        <input type="text" class="form-control" id="" name="apellido" placeholder="Your second name">
      </div>
      <div class="form-group">
        <label class="sr-only" for="">Password</label>
        <input type="password" class="form-control" id="" name="password" placeholder="Your password">
      </div>

      <button type="submit" class="btn btn-primary">guardar</button>
    <?php 
    
    }else{
        session_reset();
    }
    
    
    ?>
    
  </nav>