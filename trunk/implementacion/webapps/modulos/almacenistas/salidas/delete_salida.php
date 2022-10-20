<?php 

include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertar") {
	$cve_spf 			= $_POST['cve_spf'];
	$num_remision 		= $_POST['num_remision'];
	$cantidad_salida 	= $_POST['cantidad_salida'];
	$user 				= $_POST['user'];

    $sql		= "CALL eliminarsalida(?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $cve_spf);
   	$vquery->bindparam(2,  $num_remision);
   	$vquery->bindparam(3,  $cantidad_salida);
 	$vquery->bindparam(4,  $user);

   $vquery->execute();

   exit();

}


 ?>