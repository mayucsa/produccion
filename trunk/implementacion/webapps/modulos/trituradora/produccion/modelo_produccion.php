<?php 
include_once "../../../dbconexion/conexion.php";

if (isset($_GET["consultar"])) {
	$cve_pt = $_GET["consultar"];

	$sql	= "	SELECT * FROM captura_producciontrituradora WHERE cve_pt =" .$cve_pt;

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();
}

 ?>