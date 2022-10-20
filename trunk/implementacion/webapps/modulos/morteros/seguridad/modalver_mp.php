<div id="modalVerMP" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Materia prima por Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group form-group-sm">
            <div class="col-lg-12 d-lg-flex">
              <div style="width: 50%;">
                <label for="message-text" class="col-form-label">Producto:</label>
                <input type="text" class="form-control" id="inputname" name="inputname" disabled>
              </div>
            </div>
          </div>
<!--           <div class="form-group form-group-sm">
            <label for="message-text" class="col-form-label">Materia Prima:</label>
              <div class="col-lg-12 d-lg-flex">
                <div style="width: 50%;">
                  <label type="text" class="col-form-label" id="inputmp" name="inputmp" disabled> </label>
                  <input type="text" class="form-control validanumericos" id="inputcantidad" name="inputcantidad" disabled>
                </div>
              </div>
          </div> -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover w-100 shadow" id="tablaModal">
<!--                 <thead>
                    <tr>
                        <th class="text-center">Materia Prima</th>
                        <th class="text-center">Cantidad</th>
                    </tr>
                </thead>
                <tbody id="cuerpo">
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody> -->
            </table>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button> -->
        <!-- <input type="button" value="Actualizar" onclick="editarEntradas()" class="btn btn-primary"></input> -->
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>