<div id="modalVerMP" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ng-controller="vistaSeguridad">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Materia prima por Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  ng-click="arrayMPrimaCat = []">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row form-group form-group-sm">
            <div class="col-lg-6 col-md-6 d-lg-flex">
              <label for="message-text" class="col-form-label">Producto:</label>
              <input type="hidden" id="cve_productoEdit">
              <input type="text" class="form-control" id="inputname" name="inputname" disabled>
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-3 offset-md-1" style="text-align: right;">
              <input class="form-control" ng-model="nuevaMPrima" ng-change="getmPrimaCat(nuevaMPrima)" id="dropDownSearch" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <ul class="dropdown-menu" aria-labelledby="dropDownSearch" style="min-width: 50%; display: block" ng-show="arrayMPrimaCat.length > 0">
                <li ng-repeat="(i, obj) in arrayMPrimaCat track by i">
                  <a class="dropdown-item" href="javascript:void(0)" ng-click="setmPrima(i)">
                    <span class="p-2">{{obj.nombre_materia_prima}}</span>
                  </a>
                </li>
            </ul>
            </div>
            <div class="col-lg-2 col-md-2" style="text-align: right;">
              <!-- <input type="button" class="btn btn-success" value="Agregar" ng-click="setmPrima()"> -->
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
        <button type="button" class="btn btn-danger" ng-click="arrayMPrimaCat = []" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>