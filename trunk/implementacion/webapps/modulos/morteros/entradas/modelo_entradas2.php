<?php 
include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertarq" ) {
	$nombre = $_POST['nombre'];
	$cantidad_entrada = $_POST['cantidad_entrada'];
	// $quimico = 'Quimico';
	// $vig = 'VIG';
	// alert($quimico);
	// echo($quimico);

     // $sql 	= "	INSERT INTO 	seg_entradas (nombre, cantidad_entrada, categoria, estatus_entrada,  fecha_registro)
     //    						 VALUES 		( :nombre, :cantidad_entrada, :quimico, :vig, NOW());";

    $sql2       = "CALL entradasquimicos(?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery2 = Conexion::conectar()->prepare($sql2);

   // $vquery->bindparam(':nombre', $nombre);
   // $vquery->bindparam(':cantidad_entrada', $cantidad_entrada);
   // $vquery->bindparam(':quimico', $quimico);
   // $vquery->bindparam(':vig', $vig);

   $vquery2->bindparam(1, $nombre);
   $vquery2->bindparam(2, $cantidad_entrada);

   // $vquery->execute();
   $vquery2->execute();

   exit();

}

 ?>