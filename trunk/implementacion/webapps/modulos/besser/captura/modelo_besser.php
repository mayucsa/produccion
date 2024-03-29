<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
	function showProductoBesser(){
		$sql = "	SELECT cve_bloquera, cod_producto, nombre_producto, presentacion, num_celdas
					FROM seg_producto_bloquera
					WHERE area = 'Besser' AND estatus_producto = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPresentacionBesser($cve_pbloquera){
		$sql = "	SELECT *
					FROM seg_presentacion_bloquera
					WHERE cve_pbloquera = $cve_pbloquera AND estatus_presentacion = 'VIG'
					GROUP BY nombre";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showCeldasBesser($cve_presentacionb){
		$sql = "	SELECT  *
					FROM seg_celdas_bloquera
					WHERE cve_presentacionb = $cve_presentacionb AND estatus_celda = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	static function showPiezasBesser($cve_bloquera){
		$sql = "	SELECT  *
					FROM seg_producto_bloquera
					WHERE cve_bloquera = $cve_bloquera";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}

}

if ( isset($_GET['accion']) == "insertar") {
	$producto 		= $_POST['producto'];
	$presentacion 	= $_POST['presentacion'];
	$celdas 		= $_POST['celdas'];
	$piezas 		= $_POST['piezas'];

	$barcadas 		= $_POST['barcadas'];
	$bandejas 		= $_POST['bandejas'];
	$cemento 		= $_POST['cemento'];

	$aditivo 		= $_POST['aditivo'];
	$pesadas 		= $_POST['pesadas'];

	$llenado 		= $_POST['llenado'];
	$humedad 		= $_POST['humedad'];
	$pesopromedio 	= $_POST['pesopromedio'];

	$polvo 			= $_POST['polvo'];
	$polvoseg 		= $_POST['polvoseg'];
	$polvoporc 		= $_POST['polvoporc'];

	$gravilla 		= $_POST['gravilla'];
	$gravillaseg 	= $_POST['gravillaseg'];
	$gravillaporc 	= $_POST['gravillaporc'];

	$gravillados 		= $_POST['gravillados'];
	$gravillasegdos		= $_POST['gravillasegdos'];
	$gravillaporcdos	= $_POST['gravillaporcdos'];

	$piezastotales	= $_POST['piezastotales'];
	$consumototal 	= $_POST['consumototal'];
	$cementopieza 	= $_POST['cementopieza'];

	$user 	= $_POST['user'];

    $sql		= "CALL cpbloquerabesser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $presentacion);
 	$vquery->bindparam(3,  $celdas);
   	$vquery->bindparam(4,  $piezas);
   	$vquery->bindparam(5,  $barcadas);
 	$vquery->bindparam(6,  $bandejas);
   	$vquery->bindparam(7,  $cemento);
 	$vquery->bindparam(8,  $aditivo);
   	$vquery->bindparam(9,  $pesadas);
   	$vquery->bindparam(10, $llenado);
 	$vquery->bindparam(11, $humedad);
   	$vquery->bindparam(12, $pesopromedio);
   	$vquery->bindparam(13, $polvo);
   	$vquery->bindparam(14, $polvoseg);
   	$vquery->bindparam(15, $polvoporc);
   	$vquery->bindparam(16, $gravilla);
   	$vquery->bindparam(17, $gravillaseg);
   	$vquery->bindparam(18, $gravillaporc);
   	$vquery->bindparam(19, $gravillados);
   	$vquery->bindparam(20, $gravillasegdos);
   	$vquery->bindparam(21, $gravillaporcdos);
   	$vquery->bindparam(22, $piezastotales);
   	$vquery->bindparam(23, $consumototal);
   	$vquery->bindparam(24, $cementopieza);
   	$vquery->bindparam(25, $user);

   // $vquery->execute();
   $vquery->execute();

   exit();

}

if (isset($_GET["accion"]) == "consultarC") {
	// die (json_encode($_REQUEST));
	$cemento = $_REQUEST["cemento"];

	$sql	= "	SELECT cantidad_materia_prima 
					FROM seg_mp_bloquera 
					WHERE area = 'Besser' AND nombre_materia_prima = 'Cemento'";
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	// echo json_encode($lista);
	$stock = $lista[0]['cantidad_materia_prima'];
	if (intval($cemento) <= intval($stock)) {
		echo "correcto";
	}else{
		echo "error";
	}
	exit();

}

if (isset($_GET["accion"]) && $_GET['accion'] == "consultarA") {
	// die (json_encode($_REQUEST));
	$aditivo = $_REQUEST["aditivo"];

	$sql	= "	SELECT cantidad_materia_prima 
					FROM seg_mp_bloquera 
					WHERE area = 'Besser' AND nombre_materia_prima = 'aditivo'";
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	// echo json_encode($lista);
	$stock = $lista[0]['cantidad_materia_prima'];
	if (intval($aditivo) <= intval($stock)) {
		echo "correcto";
	}else{
		echo "error";
	}
	exit();

}

 ?>