<?php
include 'includes/head.php';
require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
item_add();
$item=$_GET['item'];
$sql= "INSERT INTO cumbrescampweb.historial_compra (id_usuario,id_producto,h_fecha) VALUES ('10', '$item', '2019-06-06' )";
$db->query($sql);
header('Location:index.php');
 ?>
