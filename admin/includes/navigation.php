<?php

if(isset($_SESSION['SBUser'])){
  $id_current_session=$_SESSION['SBUser'];
  $query = $db->query("SELECT * FROM cumbrescampweb.users WHERE
    id_usuario = '$id_current_session'");
  $current_user=  mysqli_fetch_assoc($query);
  global $current_user;
  $userCount = mysqli_num_rows($query);
} ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">Admin Cumbres Camp Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php"> Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="brands.php"> Marca <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="categories.php"> Categorias <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="insertitem.php"> Agregar Item <span class="sr-only">(current)</span></a>
      </li>
    <li class="nav-item active">
      <a class="nav-link" href="additem.php"> Editar Items <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item ">
      <a class="nav-link" href="historialAdmin.php"> Historial de Compra <span class="sr-only">(current)</span></a>
    </li>
  </ul>
  <ul class="navbar-nav">
    <li class="nav-item ">
      <a class="nav-link disabled text-light
       bg-secondary"  href="index.php"> Bienvenido <?=$current_user['u_nombreCompleto']; ?> <span class="sr-only">(current)</span></a>
    </li>
    <?php
      if(isset($_SESSION['SBUser'])){
     ?>
     <a class="nav-link text-primary bg-light"  href="index.php?finalizar=1"> LOG OUT <span class="sr-only">(current)</span></a>

   <?php } ?>
    </ul>
<p class="right"></p>
  </div>
</nav>
