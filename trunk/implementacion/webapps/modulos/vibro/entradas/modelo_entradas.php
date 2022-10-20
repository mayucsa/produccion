<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloMateriaPrima{
	function showMPoVibro(){
		$sql = "	SELECT  cve_mp,
							nombre_materia_prima
					FROM seg_mp_bloquera
					WHERE area = 'VibroBlock' AND estatus_mp = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$producto 		= $_POST['producto'];
	$cantidad		= $_POST['cantidad'];
	$chofer			= $_POST['chofer'];
	$odc			= $_POST['odc'];
	$sellos			= $_POST['sellos'];
	$tarjeta		= $_POST['tarjeta'];
	$pipa			= $_POST['pipa'];
	$user			= $_POST['user'];
	// $unidad_medida 		= $_POST['unidad_medida'];
	// $estatus_emp 		= $_POST['estatus_emp'];
	// $vig 				= $_POST['vig'];
	
	// $materia = 'Materia Prima';
	// $vig = 'VIG';
	// // echo($materia);

    // $sql 	= "	INSERT INTO 	seg_entradas_bloquera (nombre_emp, cantidad_emp, estatus_emp, fecha_registro)
    //     						VALUES 				( :producto, :cantidad, 'VIG',NOW());";

    $sql		= "CALL entradampbloquera(?, ?, ?, ?, ?, ?, ?, ?)";

   $vquery = Conexion::conectar()->prepare($sql);
   // $vquery2 = Conexion::conectar()->prepare($sql2);

   $vquery->bindparam(1, $producto);
   $vquery->bindparam(2, $cantidad);
   $vquery->bindparam(3, $chofer);
   $vquery->bindparam(4, $odc);
   $vquery->bindparam(5, $sellos);
   $vquery->bindparam(6, $tarjeta);
   $vquery->bindparam(7, $pipa);
   $vquery->bindparam(8, $user);
   // $vquery->bindparam(':unidad_medida', $unidad_medida);
   // $vquery->bindparam(':estatus_emp', $estatus_emp);
   // $vquery->bindparam(':vig', $vig);

  //  	$vquery2->bindparam(1, $cve_producto);
  //  	$vquery2->bindparam(2, $cantidad_entrada);
 	// $vquery2->bindparam(3, $valor_presentacion);
  //  	$vquery2->bindparam(4, $num_tarimas);
  //  	$vquery2->bindparam(5, $num_barcadas);
 	// $vquery2->bindparam(6, $kg_porformula);
  //  	$vquery2->bindparam(7, $kg_real);
 	// $vquery2->bindparam(8, $diferencia);
  //  	$vquery2->bindparam(9, $sacos_usados);
 	// $vquery2->bindparam(10, $sacos_rotos);
  //  	$vquery2->bindparam(11, $sacos_totales);

   $vquery->execute();
   // $vquery2->execute();

   exit();

}


 ?>