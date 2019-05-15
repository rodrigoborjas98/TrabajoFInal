<?php
  $db=mysqli_connect("localhost","root","Rodrigo2012","cumbrescampweb");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
  };
  session_start();

  require_once $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/config.php';
  require_once BASEURL.'helpers/helpers.php';

  if(isset($_SESSION['SBUser'])){
    $user_id= $_SESSION['SBUser'];
    $query= $db->query("SELECT * FROM cumbrescampweb.users WHERE id_usuario= '$user_id'");
    $user_data= mysqli_fetch_assoc($query);
    $fn= explode(' ', $user_data['u_nombreCompleto']);
    $user_data['first']= $fn[0];
    $user_data['last']= $fn[1];
  }

  if(isset($_SESSION['success_flash'])){
    ?>
    <div class="bg-success">
      <p class=" text-center text-light"><?=$_SESSION['success_flash']?></p>
    </div>
    <?php
    unset($_SESSION['success_flash']);
  }

  if(isset($_SESSION['error_flash'])){
    ?>
    <div class="bg-danger"><p class="text-light
      text-center"><?=$_SESSION['error_flash']?></p>
    </div>
    <?php
    unset($_SESSION['error_flash']);
  }

  ?>
