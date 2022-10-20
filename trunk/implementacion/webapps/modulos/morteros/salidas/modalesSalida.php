<head>
  <script src="vistas_salida.js"></script>
</head>

<div id="modalPFUpdate" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form id="PFupdate" autocomplete="off" method="POST">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_idu" name="comb_idu" required="" >
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Producto:</label>
            <select id="comb_productou" name="comb_productou" class="js-example-basic-single form-control" required ="" disabled>
                <option selected="selected" value="0" disabled>[Selecciones una opción..]</option>
                <?php   
                    $sql        = " SELECT cve_segproducto, nombre_producto FROM seg_producto
                                    UNION
                                    SELECT cve_segmatprima, nombre_materia_prima FROM seg_materia_prima
                                   ";
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
            <label for="message-text" class="col-form-label">Presentacion:</label>
            <select class="form-control" id="comb_presentup"  name="comb_presentup" disabled>
                <option selected="selected" disabled>[Seleccione una opción..]</option>
                <?php   
                    $sql        = " SELECT cve_presentacion, valor_presentacion 
                                      FROM cat_presentacion";
                    $query      = $stmt -> prepare ($sql);
                    $query      -> execute();
                    $resultado  = $query -> fetchAll();
                    foreach ($resultado as $resultado) {
                        echo '<option>'.$resultado["valor_presentacion"].'</option>';
                    }
                 ?>
            </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="text" class="form-control validanumericos" id="comb_cantidadu" name="comb_cantidadu" required="" >
          </div>
      </div>

      <div class="modal-footer">
        <input type="button" value="Actualizar" onclick="editarSalidas()" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>



<div id="modalDevPF" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Devolución</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <form id="PFdevolucion" autocomplete="off" method="POST">
            <label hidden for="message-text" class="col-form-label">ID:</label>
            <input hidden type="text" class="form-control" id="comb_idd" name="comb_idd" required="" >
          <div class="form-group form-group-sm">
            <label for="recipient-name " class="col-form-label">Producto:</label>
            <select id="comb_productod" name="comb_productod" class="js-example-basic-single form-control" required ="" disabled>
                <option selected="selected" disabled>[Selecciones una opción..]</option>
                <?php   
                    $sql        = " SELECT cve_segproducto, nombre_producto FROM seg_producto
                                    UNION
                                    SELECT cve_segmatprima, nombre_materia_prima FROM seg_materia_prima
                                   ";
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
            <label for="message-text" class="col-form-label">Presentacion:</label>
            <select class="form-control" id="comb_presentd"  name="comb_presentd" disabled>
                <option selected="selected" disabled>[Seleccione una opción..]</option>
                <?php   
                    $sql        = " SELECT cve_presentacion, valor_presentacion 
                                      FROM cat_presentacion";
                    $query      = $stmt -> prepare ($sql);
                    $query      -> execute();
                    $resultado  = $query -> fetchAll();
                    foreach ($resultado as $resultado) {
                        echo '<option>'.$resultado["valor_presentacion"].'</option>';
                    }
                 ?>
            </select>
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input type="text" class="form-control validanumericos" id="comb_cantidadd" name="comb_cantidadd" required="" >
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Número de folio:</label>
            <input type="text" class="form-control UpperCase" id="comb_folio" name="comb_folio" required="" >
          </div>
          <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Motivo de devolución:</label>
            <textarea type="" class="form-control" id="comb_motivo" name="comb_motivo" required="" ></textarea>
          </div>
      </div>

      <div class="modal-footer">
        <input type="button" value="Actualizar" onclick="devolucionSalidas()" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
  </div>
</div>
