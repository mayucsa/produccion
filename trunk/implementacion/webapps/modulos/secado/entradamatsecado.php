<?php include_once "../superior.php" ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-2" align="center" >Entrada de Materia Prima</h2>
        

            <div class="card">
                <div class="card-header">
                    <div class="row form-group form-group-sm" style="margin-bottom: 0px !important">
                        <div class="col-sm-6" style="padding-top: 10px !important">
                          Captura de Entrada de Materia Prima
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" ></span> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-2 text-center">Veh&iacute;culo</div>
                        <div class="col-sm-2 text-left">
                            <!-- <input type="text" class="form-control" style="text-transform: uppercase"> -->
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option>Volquete #18</option>
                              <option>Volquete #19</option>
                              <option>Trascavo</option>
                            </select>
                        </div>

                        <div class="col-sm-2 text-center">Materia</div>
                        <div class="col-sm-2 text-left">
                            <!-- <input type="text" class="form-control" style="text-transform: uppercase"> -->
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option>Gravilla</option>
                              <option>G-06</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include_once "../inferior.php" ?>