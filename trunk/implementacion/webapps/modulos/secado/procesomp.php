<?php include_once "../superior.php" ?>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-2" align="center" >Proceso Materia Prima</h2>
        

            <div class="card">
                <div class="card-header">
                    <div class="row form-group form-group-sm" style="margin-bottom: 0px !important">
                        <div class="col-sm-6" style="padding-top: 10px !important">
                          Captura de Proceso de Materia Prima
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" ></span> Guardar</button>
                                <!-- <button type="button" class="btn btn-success" onclick="consultar()"><span class="glyphicon glyphicon-search" ></span> Buscar</button>
                                <button type="button" class="btn btn-primary" onclick="limpiar()"><span class="glyphicon glyphicon-erase" ></span> Limpiar</button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row form-group form-group-sm">
                        <div class="col-sm-3 text-center">Velocidad variador de banda</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>

                        <div class="col-sm-3 text-right">Horometro</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>

                    <div class="row form-group form-group-sm">
                        <div class="col-sm-3 text-center">Temperatura del termometro interior</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>

                        <div class="col-sm-3 text-right">Temperatura de muestra</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>

                    <div class="row form-group form-group-sm">
                        <div class="col-sm-3 text-center">Ajuste de la valvula de caucal (Vueltas)</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>

                        <div class="col-sm-3 text-right">Nivel de Gas (litros)</div>
                        <div class="col-sm-3 text-left">
                            <input type="text" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <table align="center" class="table table-striped table-bordered">
                        <thead>
                            <tr class="header">
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody class="table-contenido">
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<?php include_once "../inferior.php" ?>