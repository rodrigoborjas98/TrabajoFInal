<?php
 require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
$errors= array();
if(!is_logged_in()){
  login_error_redirect();
}
if(!has_permission('admin')){
  permission_error_redirect('index.php');
}
if ((isset($_GET['edit'])&&!empty($_GET['edit']))) {
  $get_id_producto = $_GET['edit'];
  $get_sql= "SELECT * FROM cumbrescampweb.producto WHERE id_producto= '$get_id_producto'";
  $get_result = $db->query($get_sql);
  $get_object = mysqli_fetch_assoc($get_result);
}

//Borrar Registro Seleccionado
if(isset($_GET['delete'])&&!empty($_GET['delete'])){
    $delete_id=(int)$_GET['delete'];
    $delete_id=sanitize($delete_id);
    $sql= "DELETE FROM cumbrescampweb.producto WHERE id_producto='$delete_id'";
    $result = $db->query($sql);
    header('Location:additem.php');
}
//Vamos a validar la entrada
if(isset($_POST['botonTocado'])){
  $nombre = sanitize($_POST['nombre']);
  $descripcion = sanitize($_POST['descripcion']);
  $precio = sanitize($_POST['precio']);
  $foto = sanitize($_POST['foto']);
  $fabricante = sanitize($_POST['fabricante']);
  $origen = sanitize($_POST['origen']);
  $tipoProducto = sanitize($_POST['tipoproducto']);
  $featured = sanitize($_POST['featured']);
  $precioLista = sanitize($_POST['preciolista']);
  if($_POST['nombre']==''){
    $errors[] .= 'Valor de Nombre Vacío';
  }
  $display= display_errors($errors);
}
  //Validar imprimir errores o hacer update
  if(!empty($errors)){
  //Runs display errors form
  }else{
      if(isset($_POST['botonTocado'])){
         $sql3= "INSERT INTO cumbrescampweb.producto
         (p_nombre, p_descripcion, p_precio,
          p_foto, p_origen, id_tipoproducto, p_featured,p_precioLista,p_fabricante)
          VALUES ('$nombre', '$descripcion', '$precio',
            '$foto', '$origen', '$tipoProducto', '$featured',
            '$precioLista','$fabricante')";
         $result3 = $db->query($sql3);
      }}
?>
<hr>
<h2 class="text-center">Agrega Un Producto</h2><hr>
<div class="row">
  <!-- Form -->
  <div class="col-md-3">
  </div>
  <div class="col-md-6">
    <form class="form" action="insertitem.php<?=((isset($_GET['edit']))?'?edit='.$get_id_producto:'');?>" method="post">
      <div id= "errors">
        <?php if(isset($_POST)&&!empty($_POST)&&!empty($display)){
          echo $display;
        }
        ?>
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Nombre Producto </label>
        <input type="text" name="nombre" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_nombre']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Descripción </label>
        <input type="text" name="descripcion" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_descripcion']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Precio </label>
        <input type="text" name="precio" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_precio']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Nombre Foto (Sin extension) </label>
        <input type="text" name="foto" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_foto']:'');?>">
      </div>
      <div class="form-group">
        <label for="category"class="font-weight-bold">Fabricante </label>
        <input type="text" name="fabricante" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_fabricante']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Origen </label>
        <input type="text" name="origen" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_origen']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Tipo de Producto </label>
        <input type="text" name="tipoproducto" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['id_tipoproducto']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Featured Flag [1=Si 0=No] </label>
        <input type="text" name="featured" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_featured']:'');?>">
      </div>
      <div class="form-group">
        <label for="category" class="font-weight-bold">Precio Lista</label>
        <input type="text" name="preciolista" id="nombre" class="form-control"
        value="<?=((isset($_GET['edit']))?$get_object['p_precioLista']:'');?>">
      </div>
      <div class="form-group">
        <input type="submit" name="botonTocado" value="Editar Producto" class="btn btn-success">
      </div>
    </form>
  </div>
  <div class="col-md-3">
  </div>

</div>
<?php
include 'includes/footer.php';
?>
