<!-- MODAL EDITAR GRUPO -->
<div id="modalEditar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <input hidden type="text" class="form-control" id="inputidedit" name="inputidedit" required="" disabled >
          <div class="row form-group form-group-sm">
              <div class="col-lg-12 d-lg-flex">
                  <div style="width: 50%;" class="form-floating mx-1">
                      <select class="form-control form-group-md" id="selectmaquinaedit" name="selectmaquinaedit">
                          <option selected="selected" value="0">[Seleccione una opción..]</option>
                          <option ng-repeat="(i, obj) in Maquinas" value="{{obj.cve_maq}}">{{obj.cve_alterna}} - {{obj.nombre_maq}}</option>
                      </select>
                      <label>Máquina</label>
                  </div>
                  <div style="width: 50%;" class="form-floating mx-1">
                      <select class="form-control form-group-md" id="selectfalloedit" name="selectfalloedit">
                          <option selected="selected" value="0">[Seleccione una opción..]</option>
                          <option ng-repeat="(i, obj) in Fallos" value="{{obj.cve_fallo}}">{{obj.cve_alterna}} - {{obj.nombre_fallo}} - {{obj.motivo_fallo}}</option>
                      </select>
                      <label>Fallo</label>
                  </div>
              </div>
          </div>

          <div class="row form-group form-group-sm">
              <div class="col-lg-12 d-lg-flex">
                 <div style="width: 50%;" class="form-floating mx-1">
                      <input type="text" id="inputmotivoedit" name="inputmotivoedit" class="form-control form-control-md UpperCase">
                      <label>Motivo de fallo</label>
                  </div>
                  <div style="width: 25%;" class="form-floating mx-1">
                      <input type="text" id="inputhorainicioedit" ng-keyup="checkTime('inputhorainicioedit');" name="inputhorainicioedit" class="form-control form-control-md">
                      <label>Hora de inicio</label>
                  </div>
                  <div style="width: 25%;" class="form-floating mx-1">
                      <input type="text" id="inputhorafinedit" ng-keyup="checkTime('inputhorafinedit');" name="inputhorafinedit" class="form-control form-control-md">
                      <label>Hora de fin</label>
                  </div>
<!--                   <div style="width: 25%;" class="form-floating mx-1"> 
                      <div class="input-group clockpicker" id="datetimepicker3" data-autoclose="true">
                          <input type="text" class="form-control datetimepicker-input validanumericos" placeholder="Hora de inicio" id="inputhorainicioedit" name="inputhorainicioedit" onkeydown="noPuntoComa( event )">
                          <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                          </div>
                      </div>
                  </div>
                  <div style="width: 25%;" class="form-floating mx-1">
                      <div class="input-group clockpicker" data-autoclose="true">
                          <input type="text" class="form-control datetimepicker-input validanumericos" placeholder="Hora Fin" id="inputhorafinedit" name="inputhorafinedit" onkeydown="noPuntoComa( event )">
                          <div class="input-group-append">
                              <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                          </div>
                      </div>
                  </div> -->
              <div class="col-sm-2 text-left">
                  <span hidden id="spanusuario" name="spanusuario" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
              </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <input type="button" value="Actualizar" onclick="editarTP()" class="btn btn-primary">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL ELIMINAR GRUPO -->
<div id="modalEliminar" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input hidden type="text" class="form-control" id="inputide" name="inputide" required="" disabled >
                    <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                           <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" id="inputmaqe" name="inputmaqe" class="form-control form-control-md UpperCase" disabled>
                                <label>Máquina</label>
                            </div>
                        </div>
                      </div>
                      <div class="row form-group form-group-sm">
                        <div class="col-lg-12 d-lg-flex">
                           <div style="width: 100%;" class="form-floating mx-1">
                                <input type="text" id="inputfalloe" name="inputfalloe" class="form-control form-control-md UpperCase" disabled>
                                <label>Fallo</label>
                            </div>
                        </div>
                      </div>
          <span hidden id="spanusuarioe" name="spanusuarioe" class="form-control form-control-sm" style="background-color: #E9ECEF;"><?php echo $nombre." ".$apellido?></span>
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <input type="button" value="Eliminar" onclick="eliminarTP()" class="btn btn-danger">
        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>