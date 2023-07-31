<?php 
include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
	function showProducto(){
		$sql = "	SELECT cve_bloquera, cod_producto, nombre_producto, presentacion, num_celdas
					FROM seg_producto_bloquera
					WHERE estatus_producto = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if (isset($_GET['actualizar']) ) {
	$cve_desalojo 		= $_POST['cve_desalojo'];
	$nombre_producto 	= $_POST['nombre_producto'];
	$area 				= $_POST['area'];
	$presentacion 		= $_POST['presentacion'];
	$celdas 			= $_POST['celdas'];
	$cantidad 			= $_POST['cantidad'];
	$despuntados 		= $_POST['despuntados'];
	$estiba 			= $_POST['estiba'];
	$user				= $_POST['user'];

   	$sql		= "CALL confirmacion(?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $vquery = Conexion::conectar()->prepare($sql);

    $vquery->bindparam(1, $cve_desalojo);
    $vquery->bindparam(2, $nombre_producto);
    $vquery->bindparam(3, $area);
    $vquery->bindparam(4, $presentacion);
    $vquery->bindparam(5, $celdas);
    $vquery->bindparam(6, $cantidad);
    $vquery->bindparam(7, $despuntados);
    $vquery->bindparam(8, $estiba);
    $vquery->bindparam(9, $user);

    $vquery->execute();

    echo json_encode(["success"=>1]);
    exit();

}

if (isset($_GET["consultar"])) {
	$cve_desalojo = $_GET["consultar"];

	$sql	= "	SELECT cve_desalojo, sd.cve_bloquera, nombre_producto, presentacion, num_celdas, cantidad_total, cantidad_despuntados, cantidad_rotura 
				FROM seg_desalojo sd
				INNER JOIN seg_producto_bloquera sb ON sb.cve_bloquera = sd.cve_bloquera
				WHERE cve_desalojo =" .$cve_desalojo;

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();
}
	
 ?>