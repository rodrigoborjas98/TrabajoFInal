<?php
if(isset($_GET['finalizar'])){
}else{
  if(isset($_SESSION['SBUser'])){
    $id_current_session=$_SESSION['SBUser'];
    $query = $db->query("SELECT * FROM cumbrescampweb.users WHERE
      id_usuario = '$id_current_session'");
    $current_user=  mysqli_fetch_assoc($query);
    global $current_user;
    $userCount = mysqli_num_rows($query);
  }
}
$sql= "SELECT * FROM cumbrescampweb.tipo_producto WHERE id_padre =0";
$pquery = $db->query($sql);
 ?>
 <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="index.php">Cumbres Camp Store</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
       <li class="nav-item active">
         <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
       </li>

  <?php while ($parent = mysqli_fetch_assoc($pquery)) :
        $parent_id = $parent['id_tipoProducto'];
        $sql2= "SELECT * FROM cumbrescampweb.tipo_producto WHERE id_padre ='$parent_id' ";
        $cquery = $db->query($sql2);
  ?>
       <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo $parent['tp_nombre']; ?>
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <?php
            while ($child = mysqli_fetch_assoc($cquery)) :
         ?>

           <a class="dropdown-item" href="index.php?tipo=<?php echo $child['id_padre'] ?>"><?php echo $child['tp_nombre'] ?></a>
       <?php endwhile; ?>
       </div>
       </li>
     <?php
   endwhile;?>
   </ul>

   <ul class="navbar-nav">
   <?php if(!isset($_GET['finalizar'])&&isset($_SESSION['SBUser'])){ ?>
     <li class="nav-item active">
       <a class="nav-link disabled text-light bg-secondary"  href="index.php"> Bienvenido <?=$current_user['u_nombreCompleto']; ?> <span class="sr-only">(current)</span></a>
     </li>
   <?php}else{
   }

 //Print Sign-in OR log-out
     if(!isset($_GET['finalizar'])){
    ?>
    <li class="nav-item active">
      <a class="nav-link text-primary bg-light"  href="index.php?finalizar=1"> LOG OUT <span class="sr-only">(current)</span></a>
    </li>
  <?php }else{?>
    <li class="nav-item active">
      <a class="nav-link text-primary bg-light"  href="log/login.php"> SIGN IN <span class="sr-only">(current)</span></a>
    </li>
  <?php }?>
    </ul>
   </div>
 </nav>
