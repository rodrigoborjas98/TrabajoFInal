<?php include 'includes/head.php' ?>
<?php require_once 'core/init.php' ?>
<?php
if(isset($_GET['finalizar'])){
  session_destroy();
}
 ?>
<?php include 'includes/navigationBar.php' ?>
<?php include 'includes/header.php' ?>
<hr>
<div class="row">
  <div class="col-2"></div>
  <div class="col-8">
      <h2 class="text-center">Productos Destacados</h2>
      <div class="row">
      <?php
      if(isset($_GET['tipo'])){
        $get_id_padre= $_GET['tipo'];
        $sql= "SELECT * FROM cumbrescampweb.producto WHERE id_tipoproducto= '$get_id_padre'";
      }else{
        $sql= "SELECT * FROM cumbrescampweb.producto WHERE p_featured= 1";
      }
      $pquery = $db->query($sql);
      while ($parent = mysqli_fetch_assoc($pquery)):
      ?>
        <div class="col-md-offset-1 col-md-4 col-sm-6 col-xs-4 text-center">
        <p class="TituloProducto"><?php echo $parent['p_nombre']?></p>
        <img src="image/productos/<?php echo $parent['p_foto']?>.png" alt="<?php echo $parent['p_nombre']?>" class="img-thumb"/>
        <p class="list-price text-danger">Precio de Lista <s>$<?php echo $parent['p_precioLista'] ?>.00</s></p>
        <p class="price"  >Nuestro Precio:$ <?php echo $parent['p_precio'] ?>.00</p>
        <button type="button"  name="view" value="view" id="<?=$parent['id_producto']?>"
          class="btn btn-success btn-sm view_data ">Detalles</button>
        </div>
    <?php endwhile; ?>
    </div>
     </div>
  <div class="col"></div>
</div>

<div id="General">
</div>
<?php include 'includes/select.php' ?>
<?php include 'includes/footer.php' ?>

<div id="General">
</div>

</html>
<script>
$(document).ready(function(){
     $('.view_data').click(function(){
                    var product_id = $(this).attr("id");
                    $.ajax({
                      url:"/trabajofinal/includes/select.php",
                      method:"post",
                      data:{product_id:product_id},
                       success:function(data){
                         $('#General').html(data);
                         $('#dataModal').modal("show");
                       }
                    });
               });
             });
</script>
