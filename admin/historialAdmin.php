<?php
include 'includes/head.php';
require $_SERVER['DOCUMENT_ROOT'].'/TrabajoFinal/core/init.php';
include 'includes/navigation.php';
if(!is_logged_in()){
  login_error_redirect();
}
if(!has_permission('admin')){
  permission_error_redirect('index.php');
}
$sql= "SELECT * FROM cumbrescampweb.tipo_producto WHERE id_padre = 0;";
$result = $db->query($sql);
$errors = array();
$category= '';
$post_parent= '';
//Edit Category
if (isset($_GET['edit'])&&!empty($_GET['edit'])){
  $edit_id=(int)$_GET['edit'];
  $edit_id=sanitize($edit_id);
  $edit_sql= "SELECT * FROM cumbrescampweb.tipo_producto WHERE id_tipoProducto= '$edit_id' ";
  $edit_result = $db->query($edit_sql);
  $edit_category= mysqli_fetch_assoc($edit_result);
};

//Delete category
if (isset($_GET['delete'])&&!empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $delete_id=sanitize($delete_id);
  $sql= "SELECT * FROM cumbrescampweb.tipo_producto WHERE id_tipoProducto= '$delete_id'";
  $result = $db->query($sql);
  $category = mysqli_fetch_assoc($result);
  if($category['id_padre']==0){
    $sql= "DELETE FROM cumbrescampweb.tipo_producto WHERE id_padre=".$category['id_tipoProducto'];
    $result = $db->query($sql);
  }
   $dsql= "DELETE FROM cumbrescampweb.tipo_producto WHERE id_tipoProducto= '$delete_id' ";
   $dresult = $db->query($dsql);
   header('Location:categories.php');
}


// Process Form
if (isset($_POST)&&!empty($_POST)){
  $post_parent = sanitize($_POST['parent']);
  $category = sanitize($_POST ['category'] );
  $sqlform = "SELECT * FROM cumbrescampweb.tipo_producto WHERE tp_nombre = '$category' AND id_padre = '$post_parent'";
  $resultform = $db->query($sqlform);
  $count=mysqli_num_rows($resultform);
  // If category is blank
  if($category==''){
    $errors[].="La categoria no puede quedar en blanco.";
  }
  //if exists in database
  if($count> 0){
    $errors[].="La categoria ".$category." ya está ingresada debajo del padre seleccionado.";
  }
  //display errors
  if(!empty($errors)){
  //Runs display errors form
    $display = display_errors($errors);
    ?>
  <?php
  }else{
    $updatesql="INSERT INTO cumbrescampweb.tipo_producto  (tp_nombre,id_padre) VALUES ('$category','$post_parent')";
    echo $updatesql;
    $db->query($updatesql);
    header('Location:categories.php');
  }}

$category_value= '';
$parent_value=0;
if (isset($_GET['edit'])){
  $category_value= $edit_category['tp_nombre'];
  $parent_value=$edit_category['id_padre'];
}else{
  if(isset($_POST)){
    $category_value=$category;
    $parent_value=$post_parent;
  }
}

?>
<hr>
<h2 class="text-center">Historial de Compras</h2><hr>
<div class="row">
  <!-- Form -->
  <div class="col-md-2">
  </div>

  <!-- Category table -->
  <div class="col-md-8">
    <table class="table table-bordered">
      <thead>
        <th>Usuario</th>
        <th>Compra</th>
        <th>Fecha</th>
      </thead>
      <tbody>
        <?php
          $sql= "SELECT * FROM cumbrescampweb.historial_compra";
          $result = $db->query($sql);
          ?>
          <?php while($parent = mysqli_fetch_assoc($result)):
            $sql2 = "SELECT * FROM cumbrescampweb.users WHERE id_usuario=".$parent['id_usuario'];
            $result2 = $db->query($sql2);
            $child = mysqli_fetch_assoc($result2);
            ?>
        <tr>
            <td><?=$child['u_correo']?></td>
            <td><?=$parent['id_producto']?></td>
            <td><?=$parent['h_fecha']?></td>
        </tr>
        <?php endwhile;
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php
include 'includes/footer.php';
?>
