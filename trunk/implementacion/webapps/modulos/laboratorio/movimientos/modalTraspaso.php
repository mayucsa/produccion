<head>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="../../../includes/js/jquery351.min.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="vista_movimientos.js"></script>
</head>

<div id="modalTraspaso" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Traspaso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form novalidate id="" onsubmit="return false" autocomplete="off" method="POST">
          <div class="form-group">
            <label for="recipient-name " class="col-form-label">Concentrado:</label>
                            <select required id="comb_concentrado" name="comb_concentrado" class="js-example-basic-single form-control">
                                <option selected="selected" value="0">[Seleccione una opción..]</option>
                                <?php   
                                    $sql        = ModeloLaboratorio::showconcentrado();

                                    foreach ($sql as $key =>$value) {
                                        echo '<option value="'.$value["nombre_concentrado"].'">'.$value["nombre_concentrado"].'</option>';
                                    }
                                 ?>
                            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input required type="text" class="form-control validanumericos" id="comb_cantidadc" name="comb_cantidadc" >
          </div>

      </div>
        <div class="modal-footer">
          <input type="submit" value="Guardar" href="#" onclick="inserttraspaso()" class="btn btn-primary"></input>
          <button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>
