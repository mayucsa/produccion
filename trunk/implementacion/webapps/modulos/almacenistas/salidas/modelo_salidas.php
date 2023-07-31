<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloSalidas{
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
	// function showEstiba($cve_pbloquera, $cve_presentacionb){
	// 	$select = "		SELECT nombre_producto
	// 					FROM cat_producto_bloquera
	// 					WHERE cve_pbloquera = $cve_pbloquera";


	// 	$select2 = "	SELECT nombre
	// 					FROM seg_presentacion_bloquera
	// 					WHERE cve_presentacionb = $cve_presentacionb";

	// 	$sql = "		SELECT  numero_estiba
	// 					FROM seg_inventario_estibas
	// 					WHERE nombre_producto = $select AND presentacion = $select2";

	// 		 $vquerys = Conexion::conectar()->prepare($select);
	// 		 $vquerys2 = Conexion::conectar()->prepare($select2);
	// 		 $vquery = Conexion::conectar()->prepare($sql);

 //             $vquerys->execute();
 //             $vquerys2->execute();
 //             $vquery->execute();

	// 		 return $vquery->fetchAll();
	// 		 $vquery->close();
	// 		 $vquery = null;
	// }
	function showEstibaVibro(){
		// $select = "		SELECT nombre_producto
		// 				FROM cat_producto_bloquera
		// 				WHERE cve_pbloquera = $cve_pbloquera";
						

		// $select2 = "	SELECT nombre
		// 				FROM seg_presentacion_bloquera
		// 				WHERE cve_presentacionb = $cve_presentacionb";

		$sql = "		SELECT  numero_estiba
						FROM seg_inventario_estibas
						WHERE estatus_estiba = 'VIG' AND area = 'VibroBlock' AND cantidad_estiba > 0";

			 // $vquerys = Conexion::conectar()->prepare($select);
			 // $vquerys2 = Conexion::conectar()->prepare($select2);
			 $vquery = Conexion::conectar()->prepare($sql);

             // $vquerys->execute();
             // $vquerys2->execute();
             $vquery->execute();

			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}

		function showEstibaVibroCase($cve_pbloquera, $cve_presentacionb){
		$select = "		SELECT numero_estiba
						FROM seg_inventario_estibas 
						WHERE area = 'VibroBlock' AND estatus_estiba = 'VIG' AND cantidad_estiba > 0 
								AND nombre_producto IN 
									(	SELECT nombre_producto
		 								FROM cat_producto_bloquera
										WHERE cve_pbloquera = $cve_pbloquera) 
								AND presentacion IN
									(	SELECT nombre
		 								FROM seg_presentacion_bloquera
										WHERE cve_presentacionb = $cve_presentacionb) ";

			 $vqueryselect = Conexion::conectar()->prepare($select);

			 $vqueryselect->execute();

			 return $vqueryselect->fetchAll();
			 $vqueryselect->close();
				 $vqueryselect = null;
		}

		function showEstibaBesserCase($cve_presentacionb, $num_celdas){
		$sql = "		SELECT numero_estiba
						FROM seg_inventario_estibas 
						WHERE area = 'Besser' AND estatus_estiba = 'VIG' AND cantidad_estiba > 0 
								AND presentacion IN
									(	SELECT nombre
		 								FROM seg_presentacion_bloquera
										WHERE cve_presentacionb = $cve_presentacionb)
								AND num_celdas = $num_celdas";

			 $vquery = Conexion::conectar()->prepare($sql);

             $vquery->execute();

			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}

		function showEstibaBesser(){
		$sql = "		SELECT  numero_estiba
						FROM seg_inventario_estibas
						WHERE estatus_estiba = 'VIG' AND area = 'Besser' AND cantidad_estiba > 0 ";

			 $vquery = Conexion::conectar()->prepare($sql);

             $vquery->execute();

			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}
class ModeloProducto{
	function showProductoBesser(){
		$sql = "	SELECT  cve_pbloquera,
							nombre_producto
					FROM cat_producto_bloquera
					WHERE area = 'Besser' AND estatus = 'VIG'";

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
	function showPiezasBesser($cve_presentacionb){
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
	$presentacion 	= $_POST['presentacion'];
	$estiba 		= $_POST['estiba'];
	$cantidad 		= $_POST['cantidad'];
	$remision 		= $_POST['remision'];
	$placas 		= $_POST['placas'];
	$user 			= $_POST['user'];

    $sql		= "CALL salidasbloquera(?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $presentacion);
 	$vquery->bindparam(3,  $estiba);
   	$vquery->bindparam(4,  $cantidad);
   	$vquery->bindparam(5,  $remision);
 	$vquery->bindparam(6,  $placas);
 	$vquery->bindparam(7,  $user);

   $vquery->execute();

   exit();

}

if (isset($_GET["consultar"])) {
	$CFOLIO = $_GET["consultar"];

	$sql	= "	SELECT * 
				FROM seg_salidas_bloquera ssb
				INNER JOIN seg_producto_bloquera spb ON spb.cod_producto = ssb.cod_producto  
				WHERE CFOLIO =" .$CFOLIO;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();
}


if (isset($_GET['actualizar']) ) {
	$cve_spf 			= $_POST['cve_spf'];
	// $nombre_salida 			= $_POST['nombre_salida'];
	// $presentacion_salida	= $_POST['presentacion_salida'];
	// $cantidad_salida		= $_POST['cantidad_salida'];

   // $sql 	= "	UPDATE 	seg_salidas 
   // 				SET 	cantidad_salida = :cantidad_salida
   // 				WHERE 	cve_salida = :cve_salida AND presentacion_salida = :presentacion_salida";

   	$sql		= "CALL updatesalidas(?, ?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery = Conexion::conectar()->prepare($sql);

   // $vquery->bindparam(':cve_salida', 			$cve_salida);
   // $vquery->bindparam(':nombre_salida', 		$nombre_salida);
   // $vquery->bindparam(':presentacion_salida',	$presentacion_salida);
   // $vquery->bindparam(':cantidad_salida', 		$cantidad_salida);

   $vquery->bindparam(1, $cve_spf);
   // $vquery->bindparam(2, $nombre_salida);
   // $vquery->bindparam(3, $presentacion_salida);
   // $vquery->bindparam(4, $cantidad_salida);

   // $vquery->execute();
   $vquery->execute();

   echo json_encode(["success"=>1]);
   exit();

}


 ?>