<?php 
include_once "../../../dbconexion/conexion.php";
// include_once "modelo_insert_entrada.php";

if (isset($_GET['actualizar']) ) {
	$cve_salida 			= $_POST['cve_salida'];
	$nombre_salida 			= $_POST['nombre_salida'];
	$presentacion_salida	= $_POST['presentacion_salida'];
	$cantidad_salida		= $_POST['cantidad_salida'];
	$folio					= $_POST['folio'];
	$motivo_devolucion		= $_POST['motivo_devolucion'];

   // $sql 	= "	UPDATE 	seg_salidas 
   // 				SET 	cantidad_salida = :cantidad_salida
   // 				WHERE 	cve_salida = :cve_salida AND presentacion_salida = :presentacion_salida";

   	$sql		= "CALL devoluciones(?, ?, ?, ?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery = Conexion::conectar()->prepare($sql);

   // $vquery->bindparam(':cve_salida', 			$cve_salida);
   // $vquery->bindparam(':nombre_salida', 		$nombre_salida);
   // $vquery->bindparam(':presentacion_salida',	$presentacion_salida);
   // $vquery->bindparam(':cantidad_salida', 		$cantidad_salida);

   $vquery->bindparam(1, $cve_salida);
   $vquery->bindparam(2, $nombre_salida);
   $vquery->bindparam(3, $presentacion_salida);
   $vquery->bindparam(4, $cantidad_salida);
   $vquery->bindparam(5, $folio);
   $vquery->bindparam(6, $motivo_devolucion);

   // $vquery->execute();
   $vquery->execute();

   echo json_encode(["success"=>1]);
   exit();

}
	
 ?>