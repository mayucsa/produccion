<?php 
include_once "../../../dbconexion/conexion.php";

if (isset($_GET["consultar"])) {
	$cve_desalojo = $_GET["consultar"];

	$sql	= "	SELECT * FROM seg_desalojo WHERE cve_desalojo =" .$cve_desalojo;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();

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
	
 ?>