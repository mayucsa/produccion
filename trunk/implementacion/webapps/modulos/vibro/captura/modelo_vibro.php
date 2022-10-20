<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
	function showProductoVibro(){
		$sql = "	SELECT  cve_pbloquera,
							nombre_producto
					FROM cat_producto_bloquera
					WHERE area = 'VibroBlock' AND estatus = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPresentacionVibro($cve_pbloquera){
		$sql = "	SELECT  *
					FROM seg_presentacion_bloquera
					WHERE cve_pbloquera = $cve_pbloquera AND estatus_presentacion = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showCeldasVibro($cve_presentacionb){
		$sql = "	SELECT  *
					FROM seg_celdas_bloquera
					WHERE cve_presentacionb = $cve_presentacionb AND estatus_celda = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPiezasVibro($cve_presentacionb){
		$sql = "	SELECT  *
					FROM seg_presentacion_bloquera
					WHERE cve_presentacionb = $cve_presentacionb AND estatus_presentacion = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$producto 		= $_POST['producto'];
	$present 		= $_POST['present'];
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

	$piezastotales	= $_POST['piezastotales'];
	$consumototal 	= $_POST['consumototal'];
	$cementopieza 	= $_POST['cementopieza'];

	$user 	= $_POST['user'];

    $sql		= "CALL capturaproduccionbloquera(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $present);
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
   	$vquery->bindparam(19, $piezastotales);
   	$vquery->bindparam(20, $consumototal);
   	$vquery->bindparam(21, $cementopieza);
   	$vquery->bindparam(22, $user);

   // $vquery->execute();
   $vquery->execute();

   exit();

}

 ?>