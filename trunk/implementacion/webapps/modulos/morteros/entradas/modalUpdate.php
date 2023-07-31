<div id="modalMatPrimaUpdate" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_idu" name="comb_idu" required="" >
          <div class="form-group">
            <label for="recipient-name " class="col-form-label">Materia Prima:</label>
                            <select id="comb_mat_primau" name="comb_mat_primau" class="js-example-basic-single form-control" required ="" disabled>
                                <option selected="selected" disabled>[Selecciones una opción..]</option>
                                <?php   
                                    // $sql        = "SELECT * FROM cat_materia_prima";
                                    $sql        = "SELECT cve_materia_prima, nombre_materia_prima FROM cat_materia_prima
                                                  UNION
                                                  SELECT cve_quimico, nombre_quimico FROM cat_quimicos";
                                    $query      = $stmt -> prepare ($sql);
                                    $query      -> execute();
                                    $resultado  = $query -> fetchAll();

                                    foreach ($resultado as $resultado) {
                                        echo '<option>'.$resultado["nombre_materia_prima"].'</option>';
                                    }
                                 ?>
                            </select>
            <!-- <input type="text" class="form-control" id="recipient-name"> -->
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="text" class="form-control validanumericos" id="comb_cantidadu" name="comb_cantidadu" required="" >
          </div>
          <!-- <input type="submit" value="Guardar" class="btn btn-primary"></input> -->
        <!-- </form> -->
      </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
          <input type="button" value="Actualizar" onclick="editarEntradas()" class="btn btn-primary"></input>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
  </div>
</div>

<!-- MODAL DELETE MATERIA PRIMA -->
<div id="modalDeleteMP" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row form-group form-group-sm">
            <div class="col-lg-12 d-lg-flex">
              <div style="width: 100%;" class="form-floating mx-1">
                <input required type="text" class="form-control validanumericos" id="folio" name="folio" disabled>
                <label>Folio:</label>
              </div>
            </div>
          </div>
          <div class="row form-group form-group-sm">
            <div class="col-lg-12 d-lg-flex">
              <div style="width: 100%;" class="form-floating mx-1">
                <input required type="text" class="form-control validanumericos" id="nombre" name="nombe" disabled>
                <label>Nombre:</label>
              </div>
            </div>
          </div>
          <div class="row form-group form-group-sm">
            <div class="col-lg-12 d-lg-flex">
              <div style="width: 100%;" class="form-floating mx-1">
                <input required type="text" class="form-control validanumericos" id="cantidad" name="cantidad" disabled>
                <label>Cantidad:</label>
              </div>
            </div>
          </div>
          <div class="form-group form-group-sm">
              <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $id?></span>
          </div>
      </div>
        <div class="modal-footer">
          <input type="button" value="Eliminar" onclick="eliminarEntrada()" class="btn btn-danger">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
        </div>

    </div>
  </div>
</div>

