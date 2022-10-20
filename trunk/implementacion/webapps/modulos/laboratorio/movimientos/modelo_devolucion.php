<?php
include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertar") {
	$concentrado = $_POST['concentrado'];
	$cantidad = $_POST['cantidad'];

    $sql		= "CALL movdevolucionconcentrado(?, ?)";

   $vquery = Conexion::conectar()->prepare($sql);


   $vquery->bindparam(1, $concentrado);
   $vquery->bindparam(2, $cantidad);

   $vquery->execute();

   exit();

}
 ?>