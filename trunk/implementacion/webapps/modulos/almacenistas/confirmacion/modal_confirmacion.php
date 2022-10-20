<!-- MODAL CONFIRMACION -->

<div id="modalConfirmacion" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tableConfirmacion" autocomplete="off" method="POST">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_idc" name="comb_idc" required="" >
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Área:</label>
              <select id="comb_areac" name="comb_areac" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_desalojo, area FROM seg_desalojo";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["area"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Producto:</label>
              <select id="comb_productoc" name="comb_productoc" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_desalojo, nombre_producto FROM seg_desalojo";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["nombre_producto"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Presentación:</label>
              <select id="comb_presentc" name="comb_presentc" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_desalojo, presentacion FROM seg_desalojo";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["presentacion"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Celdas:</label>
            <input type="text" class="form-control validanumericos" id="comb_celdasc" name="comb_celdasc" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad total:</label>
            <input type="text" class="form-control validanumericos" id="input_canttotalc" name="input_canttotalc" required="" disabled>
          </div>
          <!-- <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad rotura:</label>
            <input type="text" class="form-control validanumericos" id="input_cantroturac" name="input_cantroturac" required="" disabled>
          </div> -->
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad despuntados:</label>
            <input type="text" class="form-control validanumericos" id="input_cantdespuntadosc" name="input_cantdespuntadosc" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad rotos:</label>
            <input type="text" class="form-control validanumericos" id="input_cantrotos" name="input_cantrotos" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Número de estiba:</label>
            <input type="text" class="form-control validanumericos" id="input_estiba" name="input_estiba" required="">
          </div>
            <div class="form-group form-group-sm">
                <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
            </div>
      </div>
        <div class="modal-footer">
          <input type="button" value="Confirmar" onclick="confirmacionDesalojo()" class="btn btn-primary">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL ESTIBA -->
<div id="modalEstiba" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="tableConfirmacion" autocomplete="off" method="POST">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_ide" name="comb_ide" required="" >
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Área:</label>
              <select id="comb_areae" name="comb_areae" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, area FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["area"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Producto:</label>
              <select id="comb_productoe" name="comb_productoe" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, nombre_producto FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["nombre_producto"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Presentación:</label>
              <select id="comb_presente" name="comb_presente" class="js-example-basic-single form-control" required ="" disabled>
                  <option selected="selected" disabled>[Selecciones una opción..]</option>
                      <?php   
                          $sql        = "SELECT cve_estiba, presentacion FROM seg_inventario_estibas";
                          $query      = $stmt -> prepare ($sql);
                          $query      -> execute();
                          $resultado  = $query -> fetchAll();

                        foreach ($resultado as $resultado) {
                            echo '<option>'.$resultado["presentacion"].'</option>';
                        }
                      ?>
              </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Celdas:</label>
            <input type="text" class="form-control validanumericos" id="input_celdase" name="input_celdase" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Numero de estiba:</label>
            <input type="text" class="form-control validanumericos" id="input_estibae" name="input_estibae" required="" disabled>
          </div>
          <!-- <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad rotura:</label>
            <input type="text" class="form-control validanumericos" id="input_cantroturac" name="input_cantroturac" required="" disabled>
          </div> -->
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="text" class="form-control validanumericos" id="input_cantidade" name="input_cantidade" required="" disabled>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Rotura del día:</label>
            <input type="text" class="form-control validanumericos" id="input_roturae" name="input_roturae" required="">
          </div>
            <div class="form-group form-group-sm">
                <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
            </div>
      </div>
        <div class="modal-footer">
          <input type="button" value="Confirmar" onclick="RoturaDiaria()" class="btn btn-primary">
          <!-- <button type="button" class="btn btn-danger" onclick="cerrarModal()">Cerrar</button> -->
          <button type="button" id="cerrarmodalconfirmacion" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>