<?php 
include_once "../../../dbconexion/conexion.php";


if ( isset($_GET['accion']) == "insertar") {
	$cve_producto 			= $_POST['productor'];
	// $cve_segtonelada 		= $_POST['tonelada'];
	$valor_presentacion 	= $_POST['presentacionr'];
	// $num_tarimas 			= $_POST['numtarima'];
	// $num_barcadas 			= $_POST['numbarcada'];
	$kg_ingrer 				= $_POST['kgingrer'];
	$kg_real 				= $_POST['kgrealr'];
	$diferencia 			= $_POST['diferenciar'];
	$sacos_usados 			= $_POST['sacousador'];
	$sacos_rotos 			= $_POST['sacorotor'];
	$sacos_totales 		= $_POST['sacototalr'];
	

   $sql2		= "CALL capturareproceso(?, ?, ?, ?, ?, ?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery2 = Conexion::conectar()->prepare($sql2);


   	$vquery2->bindparam(1, $cve_producto);
   	// $vquery2->bindparam(2, $cve_segtonelada);
 		$vquery2->bindparam(2, $valor_presentacion);
   	// $vquery2->bindparam(4, $num_tarimas);
   	// $vquery2->bindparam(5, $num_barcadas);
 		$vquery2->bindparam(3, $kg_ingrer);
   	$vquery2->bindparam(4, $kg_real);
 		$vquery2->bindparam(5, $diferencia);
   	$vquery2->bindparam(6, $sacos_usados);
 		$vquery2->bindparam(7, $sacos_rotos);
   	$vquery2->bindparam(8, $sacos_totales);

   // $vquery->execute();
   $vquery2->execute();

   exit();

}
	// $sql = "SELECT cve_producto, valor_presentacion, num_barcadas, kg_real, sacos_totales, fecha_registro  FROM captura_produccion";

	// $sentencia = Conexion::conectar()->prepare($sql);
	// $sentencia->execute();
	// $listaCaptura=$sentencia->fetchAll(PDO::FETCH_ASSOC);
	// echo json_encode($listaCaptura);

 ?>