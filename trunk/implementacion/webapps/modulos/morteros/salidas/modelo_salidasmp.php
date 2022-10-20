<?php 
include_once "../../../dbconexion/conexion.php";
// include_once "modelo_insert_entrada.php";

if ( isset($_GET['accion']) == "insertar") {
	$nombre_materia_prima 			= $_POST['materiaprima'];
	$motivo_salida 			= $_POST['motivo'];	
	$cantidad_salida 		= $_POST['cantidad'];

    $sql		= "CALL salidamateriaprima(?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $nombre_materia_prima);
 	$vquery->bindparam(2, $motivo_salida);
   	$vquery->bindparam(3, $cantidad_salida);

   	$vquery->execute();

   exit();

}
	
 ?>