<head>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="../../../includes/js/jquery351.min.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.js"></script>
    <script src="../../../includes/bootstrap/js/bootstrap.min.js"></script>
    <script src="vista_captura.js"></script>
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
<div class="modal fade" id="myLoading" tabindex="-3" data-backdrop="static" data-keyboard="false" style="padding-top:20%; overflow-y:visible;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div align="center"><img src="../../../includes/imagenes/loading_gral.gif" width="140px"></div>
  <div id="divtextloading" align="center" style="font-weight:bold; font-size:20px; color:#FFFFFF">Espere un momento...</div>
</div>

<div id="modalDeleteProduccion" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form novalidate id="tablaMatPrima" onsubmit="return false" autocomplete="off" method="POST">
          <div class="form-group">
            <label hidden for="recipient-name " class="col-form-label">ID:</label>
            <!-- <input required type="text" class="form-control validanumericos" id="comb_id" name="comb_id"> -->
            <input hidden type="text" class="form-control validanumericos" id="comb_id" name="comb_id" required="" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Nombre:</label>
            <input required type="text" class="form-control validanumericos" id="comb_nombre" name="comb_nombre" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Presentación:</label>
            <input required type="text" class="form-control validanumericos" id="comb_presentacion" name="comb_presentacion" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">KG ingresado:</label>
            <input required type="text" class="form-control validanumericos" id="comb_kg" name="comb_kg" disabled>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Sacos Utilizados:</label>
            <input required type="text" class="form-control validanumericos" id="comb_sacos" name="comb_sacos" disabled>
          </div>
          <div class="form-group form-group-sm">
              <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
          </div>
          <!-- <input type="submit" value="Guardar" class="btn btn-primary"></input> -->
        <!-- </form> -->
      </div>
        <div class="modal-footer">
          <input type="button" value="Eliminar" onclick="eliminarCaptura()" class="btn btn-danger">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $('#btnAgregar').click(function(e){
    // alert("Hola Chan soy Tu CRUD ")
    // validaEntrada();
    insertEntradas();
  });
</script>