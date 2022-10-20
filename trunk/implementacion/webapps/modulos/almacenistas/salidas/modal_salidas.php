<head>
  <script src="vistas_salidas.js"></script>
</head>

<div id="modalEliminar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!--           <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">ID:</label>
            <input type="text" class="form-control" id="comb_idu" name="comb_idu" required="" >
          </div> -->
          <div class="form-group form-group">
            <label hidden for="recipient-name " class="col-form-label">ID: </label>
            <input hidden type="text" class="form-control" id="mcomb_idu" name="mcomb_idu" required="" disabled>
          </div>
          <div class="form-group form-group">
            <label for="recipient-name " class="col-form-label">Folio: </label>
            <input type="text" class="form-control" id="minputfolio" name="minputfolio" required="" disabled>
          </div>
          <div class="form-group form-group">
            <label for="recipient-name " class="col-form-label">Cantidad de salida: </label>
            <input type="text" class="form-control" id="minputcantsalida" name="minputcantsalida" required="" disabled>
          </div>
            <div class="form-group form-group-sm">
                <span hidden id="spanuser" name="spanuser" class="form-control" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
            </div>
      </div>
      <div class="modal-footer">
        <input type="button" value="Eliminar" onclick="eliminarSalida()" class="btn btn-danger">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>