<?php
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
if(!is_logged_in()){
  login_error_redirect();
}
if(!has_permission('admin')){
  permission_error_redirect('index.php');
}
//get brands from db
$sql= "SELECT * FROM cumbrescampweb.marcas ORDER BY m_nombre";
$result = $db->query($sql);
$errors= array();

//Delete brands
if(isset($_GET['delete'])&&!empty($_GET['delete'])){
  $delete_id=(int)$_GET['delete'];
  $delete_id=sanitize($delete_id);
  $sql= "DELETE FROM cumbrescampweb.marcas WHERE idMarcas= '$delete_id' ";
  $result = $db->query($sql);
  header('Location:brands.php');
}
//Edit Brand
if( isset($_GET['edit'])&&!empty($_GET['edit'])){
  $edit_id=(int)$_GET['edit'];
  $edit_id=sanitize($edit_id);
  $sql2= "SELECT * FROM cumbrescampweb.marcas WHERE idMarcas= '$edit_id' ";
  $edit_result = $db->query($sql2);
  $ebrand= mysqli_fetch_assoc($edit_result);
}
//if add form is submitted
if(isset($_POST['add_submit'])){
  if($_POST['brand']==''){
    $errors[] .= 'SE DEBE INGRESAR UNA MARCA';
  }
  // Check if brand exists in db
  $brand=sanitize($_POST['brand']);

  $sql= "SELECT * FROM cumbrescampweb.marcas WHERE m_nombre = '$brand'";
  if(isset($_GET['edit'])){
    $sql= "SELECT * FROM cumbrescampweb.marcas WHERE m_nombre = '$brand' AND idMarcas!='$edit_id'";
  }
  $result2 = $db->query($sql);
  $count = mysqli_num_rows($result2);
  if($count>0){
    $errors[] .= 'La marca '.$brand.' ya existe. Por favor, escoja otra.';
  }
  if(!empty($errors)){
    //Runs display errors form
    echo display_errors($errors);
  }else{
    //Add Brand to DataBase
    $sql3= "INSERT INTO cumbrescampweb.marcas (m_nombre) VALUES ('$brand')";
    if(isset($_GET['edit'])){
       $sql3= "UPDATE cumbrescampweb.marcas SET m_nombre = '$brand' WHERE idMarcas= '$edit_id' ";
    }
    $result3 = $db->query($sql3);
    header('Location:brands.php');
  }
}
?>
<hr>
<h2 class="text-center">Marcas</h2>
<!-- Brand Forms -->
<div class="text-center">
  <form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>"
    method="post">
    <div class="form-group" id="claseChevere">
      <?php
      $brand_value= '';
      if((isset($_GET['edit']))) {
        $brand_value = $ebrand['m_nombre'];
      }else{
        if (isset($_POST['brand'])) {
          $brand_value = sanitize($_POST['brand']);
        }
      }?>
      <label for="brand"><?=((isset($_GET['edit']))?'Edita la':'Agrega una');?> marca: </label>
      <input type="text" name="brand" id="brand" class="form-control" value="<?=$brand_value?>">
      <?php  if(isset($_GET['edit'])): ?>
        <a href="brands.php" class="btn btn-default">Cancel</a>
      <?php endif;?>
      <input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Brand" class="btn btn-success">
    </div>
  </form>
</div><hr>
<table class="table table-bordered table-striped table-auto">
  <thead>
    <th></th>
    <th>Marca</th>
    <th></th>
  </thead>
  <tbody>
  <?php while($brand = mysqli_fetch_assoc($result)):?>
    <tr>
      <td><a href="brands.php?edit=<?=$brand['idMarcas']?>" class="btn btn-xs btn-default">
        <!-- <span class="glyphicon glyphicon-pencil"></span>  -->
        Editar</td>
      <td><?=$brand['m_nombre']?></td>
      <td><a href="brands.php?delete=<?=$brand['idMarcas']?>" class="btn btn-xs btn-default">
        <!-- <span class="glyphicon glyphicon-remove-sign"></span> -->
        Borrar
      </td>
    </tr>
  <?php endwhile;?>
  </tbody>
</table>
<?php
 include 'includes/footer.php';?>
