<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloUsuario{
	function showRol(){
		$sql = "	SELECT  cve_rol,
							nombre_rol,
							estatus_rol
					FROM cat_roles
					WHERE estatus_rol = 'VIG';";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
    $usuario        = $_POST['usuario'];
    $contrasenia    = $_POST['contrasenia'];
    $nombre        	= $_POST['nombre'];
    $apellido       = $_POST['apellido'];
    $puesto        	= $_POST['puesto'];
    $cve_rol        = $_POST['cve_rol'];

    $sql    = "INSERT INTO cat_usuarios    	(cve_usuario, nombre_usuario, contrasenia, nombre, apellido, puesto, cve_rol, estatus_usuario, fecha_registro)
                                VALUES 		('', :usuario, md5(:contrasenia), :nombre, :apellido, :puesto, :cve_rol, 'VIG', NOW());";

    $vquery    =    Conexion::conectar()->prepare($sql);
    
    $vquery->bindparam(':usuario', 		$usuario);
    $vquery->bindparam(':contrasenia',	$contrasenia);
    $vquery->bindparam(':nombre', 		$nombre);
    $vquery->bindparam(':apellido', 	$apellido);
    $vquery->bindparam(':puesto', 		$puesto);
    $vquery->bindparam(':cve_rol',		$cve_rol);

    $vquery->execute();

    exit();

}

 ?>