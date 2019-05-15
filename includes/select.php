<?php
 if(isset($_POST["product_id"]))
 {
      $output = '';
      $connect = mysqli_connect("localhost", "root", "Rodrigo2012", "cumbrescampweb");
      $query = "SELECT * FROM cumbrescampweb.producto WHERE id_producto = '".$_POST["product_id"]."'";
      $result = mysqli_query($connect, $query);
      while($row = mysqli_fetch_assoc($result))
      {
          $output.= '
          <div class="modal fade details-1" id="dataModal" tabindex="-1"
            role="dialog" aria-labelledby="details-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal"
                   aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="modal-body" id="product_detail">
                  <div class="container-fluid">
                  <h4 class="modal-title text-center">'.$row["p_nombre"].'</h4>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="center-block">
                          <img src="image/productos/'.$row["p_foto"].'.png" alt="franela"
                           class="details img-responsive">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <h4>Detalles</h4>
                        <p>'.$row["p_descripcion"].'</p>
                        <hr>
                        <p>Precio: '.$row["p_precio"].'</p>
                        <p>Marca: '.$row["p_fabricante"].'</p>
                        <form  action="index.php" method="post">
                          <div class="form-group">
                            <div class="col-xs-3">
                              <label for="quantity">Quantity:</label>
                              <input type="text" class="form-control"
                               id="quantity" name="quantity">
                            </div>
                            <div class="col-xs-9">
                            </div>
                            <p>Disponible: 78</p><br><br>
                            <div class="form-group">
                              <label for="size">Size:</label>
                              <select class="form-control" name="size" id="size">
                                <option value=""></option>
                                <option value="1">XS</option>
                                <option value="2">S</option>
                                <option value="3">M</option>
                                <option value="4">L</option>
                                <option value="5">XL</option>
                              </select>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                    <div class="modal-footer">
                      <button class="btn btn-default" data-dismiss="modal">Close</button>
                      <a href="../trabajofinal/addtocart.php?item=0" class="btn btn-success">Agrega al Carrito</a>
                      </button>
                    </div>
                 </div>
              </div>
          </div>';
      }
      echo $output;
 }
 ?>
