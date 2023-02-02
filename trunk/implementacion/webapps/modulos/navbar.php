<?php
// session_start();
    include_once "../../../modulos/seguridad/login/datos_usuario.php";

    if (empty($_SESSION['usuario'])) {
        $type = "error";
        $detalle = "Sesi&oacute;n terminada.";
        $detalle .= "<ul><li>La sesi&oacute;n de usuario ha finalizado.</li>";
        $detalle .= "<li>Inicie sesi&oacute;n para acceder al sistema.</li></ul>";
        $url_continuar = "index.php";
        $br = "<br/><br/><br/><br/><br/><br/><br/><br/><br/>";
        include_once "../../../mensajes/message.php";
        exit();
    }else{
        $objeto = unserialize($_SESSION['usuario']);
        $nombre = $objeto->nombre_persona;
        $apellido = $objeto->apellido_persona;
        $puesto = $objeto->puesto_persona;
        $clave  = $objeto->rol_persona;
        $id  = $objeto->clave_usuario;

        // $vista_dashboard  = $objeto->vista_dashboard;

        // $vista_inventario  = $objeto->vista_inventario;

        // $vista_mortero  = $objeto->vista_morteros;
        // $captura_mortero  = $objeto->captura_morteros;
        // $edit_mortero  = $objeto->edit_morteros;
        // $delete_mortero  = $objeto->delete_morteros;

        // $vista_laboratorio  = $objeto->vista_vibro;

        // $vista_besser = $objeto->vista_besser;
        // $captura_besser  = $objeto->captura_besser;
        // $edit_besser  = $objeto->edit_besser;

        // $vista_vibro  = $objeto->vista_vibro;
        // $captura_vibro   = $objeto->captura_vibro;
        // $edit_vibro   = $objeto->edit_vibro;

        // $vista_almacenistas  = $objeto->vista_almacenistas;

        // $vista_reportes  = $objeto->vista_reportes;

        // $vista_usuarios  = $objeto->vista_usuarios;

 ?>
<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <!-- <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../../../includes/imagenes/team_users.png" alt="User Image"> -->
        <!-- <div class="pull-left image"> -->
                <!-- <img src="../../../includes/imagenes/team_users.png" class="img-circle"> -->
        <!-- </div> -->
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar">
        <div>
          <p class="app-sidebar__user-name"><?php echo $nombre." ".$apellido?></p>
          <p class="app-sidebar__user-designation"><?php echo $puesto?></p>
        </div>
      </div>
    <!-- </div> -->
      <?php
        /*$padre = '';
        $padre .= '<ul class="app-menu">';

        $hijo = '';
        $hijo .= '</ul>';

        $dashboard = '';
        $dashboard .= '
          <li>
              <a class="app-menu__item" href="../../dashboard/dashboard/dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
          </li>';

        $inventario = '';
        $inventario .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-people-carry"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fas fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../inventario/morteros/inventario_morteros.php"><i class="icon fa fa-circle-o"></i> Morteros</a></li>

              <li><a class="treeview-item" href="../../inventario/bloquera/inventario_bloquera.php"><i class="icon fa fa-circle-o"></i> Bloqueras</a></li>

            </ul>
          </li>';


        $morteros = '';
        $morteros .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-box"></i><span class="app-menu__label">Morteros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../morteros/inventario/vista_inventario.php"><i class="icon fa fa-circle-o"></i> Inventario</a></li>

              <li><a class="treeview-item" href="../../morteros/captura/vista_captura.php"><i class="icon fa fa-circle-o"></i> Producción</a></li>
            
              <li><a class="treeview-item" href="../../morteros/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a></li>
            
              <li><a class="treeview-item" href="../../morteros/salidas/vista_salidas.php"><i class="icon fa fa-circle-o"></i> Salidas</a></li>

              <li><a class="treeview-item" href="../../morteros/seguridad/vista_seguridad.php"><i class="icon fa fa-circle-o"></i> Seguridad</a></li>
            </ul>
          </li>';

        $laboratorio = '';
        $laboratorio .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-flask"></i><span class="app-menu__label">Laboratorio</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../laboratorio/captura/vista_laboratorio.php"><i class="icon fa fa-circle-o"></i> Captura</a></li>
            
              <li><a class="treeview-item" href="../../laboratorio/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a></li>
            
              <li><a class="treeview-item" href="../../laboratorio/movimientos/vista_movimientos.php"><i class="icon fa fa-circle-o"></i> Movimientos</a></li>
            
              <li><a class="treeview-item" href="../../laboratorio/produccion/vista_produccion.php"><i class="icon fa fa-circle-o"></i> Producción</a></li>
            </ul>
          </li>';

        $besser = '';
        $besser .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-cubes"></i><span class="app-menu__label">Besser</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
            <li><a class="treeview-item" href="../../besser/captura/vista_besser.php"><i class="icon fa fa-circle-o"></i> Producción</a></li>
            
              <li><a class="treeview-item" href="../../besser/curado/vista_curado.php""><i class="icon fa fa-circle-o"></i> Cuarto Curado</a></li>

              <li><a class="treeview-item" href="../../besser/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a></li>
            
              <li><a class="treeview-item" href="../../besser/desalojo/vista_desalojo.php"><i class="icon fa fa-circle-o"></i> Desalojos</a></li>

              <li><a class="treeview-item" href="../../besser/tiempoperdido/vista_tiempoperdido.php"><i class="icon fa fa-circle-o"></i> Tiempos pérdidos</a></li>
            </ul>
          </li>';

        $vibro = '';
        $vibro .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-cubes"></i><span class="app-menu__label">VibroBlock</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../vibro/captura/vista_vibro.php"><i class="icon fa fa-circle-o"></i> Producción</a></li>
            
              <li><a class="treeview-item" href="../../vibro/curado/vista_curado.php"><i class="icon fa fa-circle-o"></i> Cuartos Curado</a></li>

              <li><a class="treeview-item" href="../../vibro/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a></li>
            
              <li><a class="treeview-item" href="../../vibro/desalojo/vista_desalojo.php"><i class="icon fa fa-circle-o"></i> Desalojos</a></li>

              <li><a class="treeview-item" href="../../vibro/tiempoperdido/vista_tiempoperdido.php"><i class="icon fa fa-circle-o"></i> Tiempos pérdidos</a></li>
            </ul>
          </li>';

        $almacenistas = '';
        $almacenistas .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-user"></i><span class="app-menu__label">Almacenistas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../almacenistas/inventario/inventario_bloquera.php"><i class="icon fa fa-circle-o"></i> Inventario</a></li>

              <li><a class="treeview-item" href="../../almacenistas/confirmacion/vista_confirmacion.php"><i class="icon fa fa-circle-o"></i> Desalojos</a></li>

              <li><a class="treeview-item" href="../../almacenistas/salidas/vista_salidas.php"><i class="icon fa fa-circle-o"></i> Salidas</a></li>
            </ul>
          </li>';

        $reportes = '';
        $reportes .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-chart-pie"></i><span class="app-menu__label">Reportes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../reportes/saqueria/vista_saqueria.php"><i class="icon fa fa-circle-o"></i> Sacos usados</a></li>
            </ul>
          </li>';

        $usuarios = '';
        $usuarios .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../usuarios/usuarios/vista_usuario.php"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
            
              <li><a class="treeview-item" href="../../usuarios/roles/vista_rol.php"><i class="icon fa fa-circle-o"></i> Roles</a></li>
            
              <li><a class="treeview-item" href=""><i class="icon fa fa-circle-o"></i> Permisos</a></li>
            </ul>
          </li>';

        $misdatos = '';
        $misdatos .= '
          <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-user-cog"></i><span class="app-menu__label">Mis datos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="treeview-item" href="../../misdatos/cambiopassword/vista_password.php"><i class="icon fa fa-circle-o"></i> Cambio de contraseña</a></li>
            </ul>
          </li>';

        $cierresesion = '';
        $cierresesion .= '
          <li><a class="app-menu__item" href="../../../logout.php"><i class="app-menu__icon fas fa-sign-out-alt"></i><span class="app-menu__label">Cerrar sesi&oacute;n</span></a>
          </li>';

          echo $padre;*/
?>
          <ul class="app-menu">
            <!-- dashboard -->
            <li ng-show="perfilUsu.dashboard_principal == 1">
              <a class="app-menu__item" href="../../dashboard/dashboard/dashboard.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a>
            </li>
            <!-- Inventario -->
            <li class="treeview" ng-show="perfilUsu.inventario_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-people-carry"></i><span class="app-menu__label">Inventario</span><i class="treeview-indicator fas fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_morterosvista == 1">
                    <a class="treeview-item" href="../../inventario/morteros/inventario_morteros.php"><i class="icon fa fa-circle-o"></i> Morteros</a>
                  </li>
                  <li ng-show="perfilUsu.inventario_bloqueravista == 1">
                    <a class="treeview-item" href="../../inventario/bloquera/inventario_bloquera.php"><i class="icon fa fa-circle-o"></i> Bloqueras</a>
                  </li>
                </ul>
            </li>
            <!-- Morteros -->
            <li class="treeview" ng-show="perfilUsu.morteros_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-box"></i><span class="app-menu__label">Morteros</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/inventario/vista_inventario.php"><i class="icon fa fa-circle-o"></i> Inventario</a>
                  </li>
                  <li ng-show="perfilUsu.produccion_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/captura/vista_captura.php"><i class="icon fa fa-circle-o"></i> Producción</a>
                  </li>
                  <li ng-show="perfilUsu.entradas_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a>
                  </li>              
                  <li ng-show="perfilUsu.salidas_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/salidas/vista_salidas.php"><i class="icon fa fa-circle-o"></i> Salidas</a>
                  </li>
                  <li ng-show="perfilUsu.tperdido_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/tiempoperdido/vista_tiempoperdido.php"><i class="icon fa fa-circle-o"></i> Tiempo pérdido</a>
                  </li>
                  <li ng-show="perfilUsu.seguridad_morteros_vista == 1">
                    <a class="treeview-item" href="../../morteros/seguridad/vista_seguridad.php"><i class="icon fa fa-circle-o"></i> Seguridad</a>
                  </li>
                </ul>
            </li>
            <!-- Laboratorio -->
            <li class="treeview" ng-show="perfilUsu.laboratorio_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-flask"></i><span class="app-menu__label">Laboratorio</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_laboratorio_vista == 1">
                    <a class="treeview-item" href="../../laboratorio/produccion/vista_produccion.php"><i class="icon fa fa-circle-o"></i> Inventario</a>
                  </li>
                  <li ng-show="perfilUsu.produccion_laboratorio_vista == 1">
                    <a class="treeview-item" href="../../laboratorio/captura/vista_laboratorio.php"><i class="icon fa fa-circle-o"></i> Producción</a>
                  </li>
                  <li ng-show="perfilUsu.entradas_laboratorio_vista == 1">
                    <a class="treeview-item" href="../../laboratorio/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a>
                  </li>
                  <li ng-show="perfilUsu.movimientos_laboratorio_vista == 1">
                    <a class="treeview-item" href="../../laboratorio/movimientos/vista_movimientos.php"><i class="icon fa fa-circle-o"></i> Movimientos</a>
                  </li>
                </ul>
            </li>
            <!-- Besser -->
            <li class="treeview" ng-show="perfilUsu.besser_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-cubes"></i><span class="app-menu__label">Besser</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_besser_vista == 1">
                    <a class="treeview-item" href="../../besser/curado/vista_curado.php"><i class="icon fa fa-circle-o"></i> Inventario</a>
                  </li>
                  <li ng-show="perfilUsu.produccion_besser_vista == 1">
                    <a class="treeview-item" href="../../besser/captura/vista_besser.php"><i class="icon fa fa-circle-o"></i> Producción</a>
                  </li>
                  <li ng-show="perfilUsu.entradas_besser_vista == 1">
                    <a class="treeview-item" href="../../besser/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a>
                  </li>
                  <li ng-show="perfilUsu.desalojo_besser_vista == 1">
                    <a class="treeview-item" href="../../besser/desalojo/vista_desalojo.php"><i class="icon fa fa-circle-o"></i> Desalojos</a>
                  </li>
                  <li ng-show="perfilUsu.tperdido_besser_vista == 1">
                    <a class="treeview-item" href="../../besser/tiempoperdido/vista_tiempoperdido.php"><i class="icon fa fa-circle-o"></i> Tiempo pérdido</a>
                  </li>
                </ul>
            </li>
            <!-- Vibroblock -->
            <li class="treeview" ng-show="perfilUsu.vibroblock_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-cubes"></i><span class="app-menu__label">VibroBlock</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_vibro_vista == 1">
                    <a class="treeview-item" href="../../vibro/curado/vista_curado.php"><i class="icon fa fa-circle-o"></i> Inventario</a>
                  </li>
                  <li ng-show="perfilUsu.produccion_vibro_vista == 1">
                    <a class="treeview-item" href="../../vibro/captura/vista_vibro.php"><i class="icon fa fa-circle-o"></i> Producción</a>
                  </li>
                  <li ng-show="perfilUsu.entradas_vibro_vista == 1">
                    <a class="treeview-item" href="../../vibro/entradas/vista_entradas.php"><i class="icon fa fa-circle-o"></i> Entradas</a>
                  </li>
                  <li ng-show="perfilUsu.desalojos_vibro_vista == 1">
                    <a class="treeview-item" href="../../vibro/desalojo/vista_desalojo.php"><i class="icon fa fa-circle-o"></i> Desalojos</a>
                  </li>
                  <li ng-show="perfilUsu.tperdido_vibro_vista == 1">
                    <a class="treeview-item" href="../../vibro/tiempoperdido/vista_tiempoperdido.php"><i class="icon fa fa-circle-o"></i> Tiempos pérdidos</a>
                  </li>
                </ul>
            </li>
            <!-- Trituradora -->
            <li class="treeview" ng-show="perfilUsu.trituradora_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-industry"></i><span class="app-menu__label">Trituradora</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.produccion_trituradoral1_vista == 1">
                    <a class="treeview-item" href="../../trituradora/produccion/linea1_vista.php"><i class="icon fa fa-circle-o"></i> Producción Línea 1</a>
                  </li>
                  <li ng-show="perfilUsu.produccion_trituradoral2_vista == 1">
                    <a class="treeview-item" href="../../trituradora/produccion/linea2_vista.php"><i class="icon fa fa-circle-o"></i> Producción Línea 2</a>
                  </li>
                  <li ng-show="perfilUsu.tperdido_trituradoral1_vista == 1">
                    <a class="treeview-item" href="../../trituradora/tiempoperdido/tiempoperdidol1_vista.php"><i class="icon fa fa-circle-o"></i> Tiempo pérdido Línea 1</a>
                  </li>
                  <li ng-show="perfilUsu.tperdido_trituradoral2_vista == 1">
                    <a class="treeview-item" href="../../trituradora/tiempoperdido/tiempoperdidol2_vista.php"><i class="icon fa fa-circle-o"></i> Tiempo pérdido Línea 2</a>
                  </li>
                  <li ng-show="perfilUsu.salidas_trituradora_vista == 1">
                    <a class="treeview-item" href="../../trituradora/salidas/vista_salidas.php"><i class="icon fa fa-circle-o"></i> Salidas</a>
                  </li>
                </ul>
            </li>
            <!-- Almacenistas -->
            <li class="treeview" ng-show="perfilUsu.almacenista_principal == 1">
              <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-user"></i><span class="app-menu__label">Almacenistas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                  <li ng-show="perfilUsu.inventario_almacenistas_vista == 1">
                    <a class="treeview-item" href="../../almacenistas/inventario/inventario_bloquera.php"><i class="icon fa fa-circle-o"></i> Inventario</a>
                  </li>
                  <li ng-show="perfilUsu.desalojo_almacenistas_vista == 1">
                    <a class="treeview-item" href="../../almacenistas/confirmacion/vista_confirmacion.php"><i class="icon fa fa-circle-o"></i> Desalojos</a>
                  </li>
                  <li ng-show="perfilUsu.salidas_almacenistas_vista == 1">
                    <a class="treeview-item" href="../../almacenistas/salidas/vista_salidas.php"><i class="icon fa fa-circle-o"></i> Salidas</a>
                  </li>
                </ul>
            </li>
            <!-- Almacenistas -->
            <li class="treeview" ng-show="perfilUsu.porteria_vista == 1">
              <a class="app-menu__item" href="../../porteria/movimientos/vista_movimientos.php">
                <i class="app-menu__icon fas fa-list-ol"></i><span class="app-menu__label">Porteria</span>
              </a>
                <ul class="treeview-menu">

                </ul>
            </li>
            <!-- mis datos -->
            <li class="treeview">
              <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fas fa-user-cog"></i><span class="app-menu__label">Mis datos</span><i class="treeview-indicator fa fa-angle-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a class="treeview-item" href="../../misdatos/cambiopassword/vista_password.php"><i class="icon fa fa-circle-o"></i> Cambio de contraseña</a>
                </li>
              </ul>
            </li>
            <!-- cierre sesión -->
            <li>
              <a class="app-menu__item" href="">
                <i class="app-menu__icon fas fa-sign-out-alt"></i>
                <span class="app-menu__label" ng-click="cerrarsesion()">Cerrar sesi&oacute;n</span>
              </a>
            </li>
          </ul>
<?php 
          /*if ($vista_dashboard == 1) {
            echo $dashboard;
          }
          if ($vista_inventario == 1) {
            echo $inventario;
          }
          if ($vista_mortero == 1) {
            echo $morteros;
          }
          if ($vista_laboratorio == 1) {
            echo $laboratorio;
          }
          if ($vista_besser == 1) {
            echo $besser;
          }
          if ($vista_vibro == 1) {
            echo $vibro;
          }
          if ($vista_almacenistas == 1) {
            echo $almacenistas;
          }
          if ($vista_reportes == 1) {
            echo $reportes;
          }
          if ($vista_usuarios == 1) {
            echo $usuarios;
          }

          echo $misdatos.$cierresesion.$hijo;*/
      ?>

    </aside>
    <?php 
  }
     ?>