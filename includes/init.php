<?php
  $db=mysqli_connect("localhost","root","Rodrigo2012","cumbrescampweb");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
  }
  define('BASEURL','/TrabajoFinal/');
  ?>
