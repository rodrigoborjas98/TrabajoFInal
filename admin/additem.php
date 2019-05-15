<?php
 require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
 if(!is_logged_in()){
   login_error_redirect();
 }
 if(!has_permission('admin')){
   permission_error_redirect('index.php');
 }
include 'includes/head.php';
include 'includes/navigation.php';
$sql= "SELECT * FROM cumbrescampweb.producto";
$result = $db->query($sql);
$errors= array();

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
   echo "El valor probado es: ";
   echo $nombre;
   echo $descripcion;
   echo $precio;
   echo $foto;
   echo $fabricante;
   echo $origen;
   echo $tipoProducto;
   echo $featured;
   echo $precioLista;
  if($_POST['nombre']==''){
    $errors[] .= 'Valor de Nombre Vacío';
  }
  $display= display_errors($errors);
}
  //Validar imprimir errores o hacer update
  if(!empty($errors)){
  //Runs display errors form
  }else{
      if(isset($_GET['edit'])&&isset($_POST['botonTocado'])){
         $sql3= "UPDATE cumbrescampweb.producto SET
         p_nombre ='$nombre',
         p_descripcion='$descripcion',
         p_precio ='$precio',
         p_foto = '$foto',
         p_fabricante= '$fabricante',
         p_origen='$origen',
         id_tipoproducto= '$tipoProducto',
         p_featured='$featured',
         p_precioLista='$precioLista'
         WHERE id_producto= '$get_id_producto' ";
         $result3 = $db->query($sql3);
         header('Location:additem.php');
      }}
?>
<hr>
<h2 class="text-center">Edita Un Item</h2><hr>
<div class="row">

  <!-- Form -->
  <div class="col-md-1"></div>
  <div class="col-md-4">
    <form class="form" action="additem.php<?=((isset($_GET['edit']))?'?edit='.$get_id_producto:'');?>" method="post">
      <legend>Edita un artículo</legend>
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
  <!-- Category table -->
  <div class="col-md-6">
    <table class="table table-bordered">
      <thead class="">
        <th>id_producto</th>
        <th>Nombre Producto</th>
        <th></th>
      </thead>
      <tbody>
        <?php
        $sql= "SELECT * FROM cumbrescampweb.producto";
        $result = $db->query($sql);
        while($parent = mysqli_fetch_assoc($result)):
          ?>
        <tr>
          <td><?=$parent['id_producto']?></td>
          <td><?=$parent['p_nombre']?></td>
          <td>
            <a href="additem.php?edit=<?=$parent['id_producto']?>" class="btn  btn-default">Editar</a>
              <!-- <span class="glyphicon glyphicon-pencil"></span></a> -->
           <a href="additem.php?delete=<?=$parent['id_producto']?>" class="btn  btn-default">Borrar</a>
              <!-- <span class="glyphicon glyphicon-remove-sign"></span></a> -->
          </td>
          </tr>
        <?php endwhile;
        ?>
      </tbody>
    </table>
  </div>
    <div class="col-md-1"></div>
</div>
<?php
include 'includes/footer.php';
?>
