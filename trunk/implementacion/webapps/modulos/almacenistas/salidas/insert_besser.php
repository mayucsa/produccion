<?php 

include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertar") {
	$producto 		= $_POST['producto'];
	$presentacion 	= $_POST['presentacion'];
	$celdas 		= $_POST['celdas'];
	$estiba 		= $_POST['estiba'];
	$cantidad 		= $_POST['cantidad'];
	$remision 		= $_POST['remision'];
	$placas 		= $_POST['placas'];
	$user 			= $_POST['user'];

    $sql		= "CALL salidasbesser(?, ?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $presentacion);
   	$vquery->bindparam(3,  $celdas);
 	$vquery->bindparam(4,  $estiba);
   	$vquery->bindparam(5,  $cantidad);
   	$vquery->bindparam(6,  $remision);
 	$vquery->bindparam(7,  $placas);
 	$vquery->bindparam(8,  $user);

   $vquery->execute();

   exit();

}


 ?>