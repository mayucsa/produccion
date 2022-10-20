<head>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../../../includes/js/jquery351.min.js"></script>
    <script src="../../../includes/js/jquery351.min.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="vista_entradas.js"></script>
</head>

<div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top:10%; overflow-y:visible;" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-danger">
        <h5 class="modal-title" id="encabezadoModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cuerpoModal"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div id="modalquimicos" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form novalidate id="tablaQuimicos" onsubmit="return false" autocomplete="off" method="POST">
          <div class="form-group">
            <label for="recipient-name " class="col-form-label">Quimico:</label>
                            <select required id="comb_quimico" name="comb_quimico" class="js-example-basic-single form-control">
                                <option selected="selected" value="0">[Selecciones una opción..]</option>
                                <?php   
                                    $sql        = "SELECT * FROM cat_quimicos";
                                    $query      = $stmt -> prepare ($sql);
                                    $query      -> execute();
                                    $resultado  = $query -> fetchAll();

                                    foreach ($resultado as $resultado) {
                                        echo '<option>'.$resultado["nombre_quimico"].'</option>';
                                    }
                                 ?>
                            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Cantidad:</label>
            <input required type="text" class="form-control validanumericos" id="comb_cantidadq" name="comb_cantidadq" >
          </div>
      </div>
        <div class="modal-footer">
          <input type="submit" value="Guardar" href="#" onclick="insertEntradasQ()" class="btn btn-primary"></input>
          <button type="button" class="btn btn-danger"  data-dismiss="modal">Cerrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('#btnAgregar').click(function(e){
    // alert("Hola Chan soy Tu CRUD ")
    // validaEntrada();
    insertEntradasQ();
  });
</script>