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
			if (($arreglo_datos = $objetoModelo->consulta_usuario_persona($usuario, $contrasenia)) == true) {
				foreach ($arreglo_datos as $d) {
				$objeto_datos_usuario = new Datos_usuario;
				$objeto_datos_usuario->set_clave_usuario($d["cve_usuario"]);
				$objeto_datos_usuario->set_nombre_usuario($d["nombre_usuario"]);
				$objeto_datos_usuario->set_nombre_persona($d["nombre"]);
				$objeto_datos_usuario->set_apellido_persona($d["apellido"]);
				$objeto_datos_usuario->set_puesto_persona($d["puesto"]);
				$objeto_datos_usuario->set_rol_persona($d["cve_rol"]);

				$objeto_datos_usuario->set_vista_dashboard($d["dashboard_vista"]);

				$objeto_datos_usuario->set_vista_inventario($d["inventario_vista"]);

				$objeto_datos_usuario->set_vista_laboratorio($d["laboratorio_vista"]);

				$objeto_datos_usuario->set_vista_besser($d["besser_vista"]);

				$objeto_datos_usuario->set_vista_vibro($d["vibro_vista"]);

				$objeto_datos_usuario->set_vista_almacenistas($d["almacenistas_vista"]);

				$objeto_datos_usuario->set_vista_reportes($d["reportes_vista"]);

				$objeto_datos_usuario->set_vista_usuarios($d["usuarios_vista"]);


				$objeto_datos_usuario->set_vista_morteros($d["morteros_vista"]);
				$objeto_datos_usuario->set_captura_morteros($d["morteros_captura"]);
				$objeto_datos_usuario->set_edit_morteros($d["morteros_edit"]);
				$objeto_datos_usuario->set_delete_morteros($d["morteros_delete"]);

				$_SESSION['usuario'] = serialize($objeto_datos_usuario);
				// $_SESSION['usuario'] = $objeto_datos_usuario;
				// $_SESSION['usuario'] = $usuario;
                $response['success'] = TRUE;
                $response['error'] = 0;
                $response['message'] = "Acceso permitido.";
				}
			}
			// if (($arreglo_datos = $objetoModelo->consulta_usuario_persona($usuario, $contrasenia)) == true){
			// foreach ($arreglo_datos as $d) { 
				// $objeto_datos_usuario = new Datos_usuario;
				// $objeto_datos_usuario->set_clave_usuario($d["cve_usuario"]);
				// $objeto_datos_usuario->set_nombre_usuario($d["nombre_usuario"]);
				// $objeto_datos_usuario->set_nombre_persona($d["nombre"]);

				// $objeto_datos_usuario->set_nombre_persona_lw($d["nl"]);
                // $objeto_datos_usuario->set_paterno_persona_lw($d["pl"]);
			
				// $_SESSION['usuario'] = $usuario;
				// $_SESSION['usuario'] = serialize($objeto_datos_usuario);
				// $response['success'] = TRUE;
            	// $response['error'] = 0;
            	// $response['message'] = "Acceso permitido.";
            	// }
            // }
		} else {
			$response['success'] = FALSE;
            $response['error'] = 3;
            $response['message'] = "<div style='color: red'><center>La contraseña no coincide, intente nuevamente.</center></div>";
            $_SESSION['usuario'] = null;
		}
	} else {
		$response['success'] = FALSE;
        $response['error'] = 4;
        $response['message'] = "<div style='color: red'><center>El nombre de usuario no existe, verifique con su administrador de sistema.</center></div>";
        $_SESSION['usuario'] = null;
	}
	header('Content-Type: application/json');
	print_r(json_encode($response));
	
 ?>