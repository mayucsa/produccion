<!-- Reporte ventas bloquera -->
<div id="modalBloqueras" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Ventas bloquera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group form-group-sm">
          <div class="col-lg-12 d-lg-flex">
            <div style="width: 100%;" class="form-floating mx-1">
              <input class="date-picker form-control" min="2022-11-27" ng-model="fechab" id="fechab" autocomplete="off">
              <label>Fecha</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="getPDF('bloquera')">Imprimir <i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Reporte ventas trituradora -->
<div id="modalTrituradora" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Ventas trituradora</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group form-group-sm">
          <div class="col-lg-12 d-lg-flex">
            <div style="width: 100%;" class="form-floating mx-1">
              <input class="date-picker form-control" min="2022-11-27" ng-model="fechat" id="fechat" autocomplete="off">
              <label>Fecha</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="getPDF('trituradora')">Imprimir <i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Reporte ventas morteros -->
<div id="modalMorteros" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Ventas mortero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group form-group-sm">
          <div class="col-lg-12 d-lg-flex">
            <div style="width: 100%;" class="form-floating mx-1">
              <input class="date-picker form-control" min="2022-11-27" ng-model="fecham" id="fecham" autocomplete="off">
              <label>Fecha</label>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" ng-click="getPDF('mortero')">Imprimir <i class="fas fa-print"></i></button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
