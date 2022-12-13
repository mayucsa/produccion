<?php
include_once "../../../dbconexion/conexion.php";
include_once "../../../dbconexion/conn.php";
class ModeloProducto{
	function showPresentacion(){
		$sql = "	SELECT valor_presentacion 
					FROM cat_presentacion 
					WHERE estatus_presentacion = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showTonelada(){
		$sql = "	SELECT tonelada_producto 
					FROM `cat_productos` 
					GROUP BY tonelada_producto";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showSaco(){
		$sql = "	SELECT cve_segmatprima, CONCAT(codigo, ' - ', nombre_materia_prima) AS codsaco
					FROM seg_materia_prima 
					WHERE estatus_segmatprima = 'VIG' AND nombre_materia_prima LIKE '%saco%'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$cve_producto 			= $_POST['producto'];
	$presentacion 			= $_POST['presentacion'];
	$tonelada 				= $_POST['tonelada'];
	$sacousado 				= $_POST['sacos'];
	$user 					= $_POST['user'];

    $sql		= "CALL productonuevomorteros(?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $cve_producto);
   	$vquery->bindparam(2, $presentacion);
   	$vquery->bindparam(3, $tonelada);
 	$vquery->bindparam(4, $sacousado);
 	$vquery->bindparam(5, $user);

   	$vquery->execute();

   exit();

}

if (isset($_GET["consultar"])) {
	$cve_producto = $_GET["consultar"];

	$sql	= "	SELECT P.nombre_producto AS Producto, M.nombre_materia_prima AS MateriaPrima, C.cantidad AS Cantidad, M.cve_materia_prima 
				FROM `seg_mprimapor_producto` C 
				INNER JOIN cat_productos P ON P.cve_producto = C.cve_producto 
				INNER JOIN cat_materia_prima M ON M.cve_materia_prima = C.cve_materia_prima 
				WHERE C.cve_producto =" .$cve_producto;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();

}

if (isset($_GET["accion"]) && $_GET['accion'] == "consultarProducto") {
	// die (json_encode($_REQUEST));
	$producto = $_REQUEST["producto"];

	$sql	= "	SELECT nombre_producto 
				FROM cat_productos 
				WHERE nombre_producto = " .$producto;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	// echo json_encode($lista);
	$stock = $lista[0]['nombre_producto'];
	if ($producto == $stock) {
		echo "correcto";
	}else{
		echo "error";
	}
	exit();

}
if (isset($_GET['editarMPrima']) && $_GET['editarMPrima'] == 'update') {
	$cantidad = $_REQUEST['cantidad'];
	$cve_materia_prima = $_REQUEST['cve_materia_prima'];
	$cve_producto = $_REQUEST['cve_producto'];
	$dbcon	= 	new MysqlConn;
	$sql = "UPDATE seg_mprimapor_producto SET cantidad = ".$cantidad." WHERE cve_producto = ".$cve_producto." AND cve_materia_prima = ".$cve_materia_prima;
	// echo $cantidad;
	echo json_encode($dbcon->qBuilder($dbcon->conn(), 'do', $sql));
}
if (isset($_GET['eliminamPrima']) && $_GET['eliminamPrima'] == 'delete') {
	$cve_materia_prima = $_REQUEST['cve_materia_prima'];
	$cve_producto = $_REQUEST['cve_producto'];
	$dbcon	= 	new MysqlConn;
	$sql = "DELETE FROM seg_mprimapor_producto WHERE cve_producto = ".$cve_producto." AND cve_materia_prima = ".$cve_materia_prima;
	// echo $cantidad;
	if ($dbcon->qBuilder($dbcon->conn(), 'do', $sql)) {
		echo true;
	}else{
		echo $sql;
	}
}
?>