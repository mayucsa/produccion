<?php 
	include_once "modelo_login.php";
	include_once "datos_usuario.php";
	// require_once ("modelo_login.php");
	session_start();

	$objetoModelo	= new Modelo_login;
	set_time_limit(0);
	$usuario 		= 	$_POST["usuario"];
	$contrasenia	= 	md5($_POST["contrasenia"]);

	$response	= array();
	if ($objetoModelo->consulta_usuario_existencia($usuario) == true) {
		if ($objetoModelo->consulta_contrasenia_correcta($usuario, $contrasenia) == true) {
			if ($objetoModelo->consulta_vigencia_persona($usuario) == true) {
				if (($d = $objetoModelo->consulta_usuario_persona($usuario, $contrasenia)) == true) {
					// foreach ($arreglo_datos as $d) {
					$objeto_datos_usuario = new Datos_usuario;
					$objeto_datos_usuario->set_clave_usuario($d->cve_usuario);
					$objeto_datos_usuario->set_nombre_usuario($d->nombre_usuario);
					$objeto_datos_usuario->set_nombre_persona($d->nombre);
					$objeto_datos_usuario->set_apellido_persona($d->apellido);
					$objeto_datos_usuario->set_puesto_persona($d->puesto);
					$objeto_datos_usuario->set_rol_persona($d->cve_rol);

					$_SESSION['loggedin'] = true;
					$_SESSION['id'] = $d->cve_usuario;
					$_SESSION['produccion_morteros_edit'] = $d->produccion_morteros_edit;
					$_SESSION['entradas_morteros_edit'] = $d->entradas_morteros_edit;
					$_SESSION['tperdido_besser_edit'] = $d->tperdido_besser_edit;
					$_SESSION['tperdido_vibro_edit'] = $d->tperdido_vibro_edit;
					$_SESSION['tperdido_morteros_edit'] = $d->tperdido_morteros_edit;
					$_SESSION['produccion_besser_edit'] = $d->produccion_besser_edit;
					$_SESSION['entradas_besser_edit'] = $d->entradas_besser_edit;

					$_SESSION['usuario'] = serialize($objeto_datos_usuario);
					$_SESSION['start'] = time();
					$_SESSION['expire'] = $_SESSION['start'] + (2 * 3600);//expira en 2 horas
					// $_SESSION['usuario'] = $objeto_datos_usuario;
					// $_SESSION['usuario'] = $usuario;
	                $response['success'] = TRUE;
	                $response['error'] = 0;
	                $response['message'] = "Acceso permitido.";
				}
		}else{
			$response['success'] = FALSE;
            $response['error'] = 1;
            $response['message'] = "<div style='color: red'><center>Usuario sin privilegios, contacte al administrador del sistema.</center></div>";
            $_SESSION['usuario'] = null;
			}
		} else {
			$response['success'] = FALSE;
            $response['error'] = 3;
            $response['message'] = "<div style='color: red'><center>La contraseña no coincide, intente nuevamente.</center></div>";
            $_SESSION['usuario'] = null;
		}
	} else {
		$response['success'] = FALSE;
        $response['error'] = 4;
        $response['message'] = "<div style='color: red'><center>El número de empleado no existe, verifique con su administrador de sistema.</center></div>";
        $_SESSION['usuario'] = null;
	}
	die(json_encode($response));
	
 ?>