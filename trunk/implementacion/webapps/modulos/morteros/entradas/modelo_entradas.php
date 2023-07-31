<?php 
include_once "../../../dbconexion/conexion.php";
// include_once "modelo_insert_entrada.php";

class ModeloEntradas{
	function showProducto(){
		$sql = "	SELECT  	*
					FROM seg_materia_prima
					WHERE estatus_segmatprima = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
          $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}

}

class modeloCapturaEntrada extends Conexion{
		public function mostrarDatos(){
			$sql = "SELECT  cve_entrada,
							nombre,
							cantidad_entrada,
							categoria,
							fecha_registro
					FROM seg_entradas
					WHERE estatus_entrada = 'VIG'
					ORDER BY fecha_registro DESC";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
             // $vquery->close();
			 return $vquery->fetchAll();
			 $vquery->close();
		}
}



if (isset($_GET["accion"]) && $_GET['accion'] == "eliminar") {
	$folio 	= $_POST['folio'];
	$user 	= $_POST['user'];

	$sql = "CALL eliminarEntradamorteros(?, ?)";

	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $folio);
   	$vquery->bindparam(2, $user);

   	$vquery->execute();

   exit();
}


if (isset($_GET["accion"]) && $_GET['accion'] == "insertar") {
	$nombre = $_POST['nombre'];
	$cantidad_entrada = $_POST['cantidad_entrada'];
	$user = $_POST['user'];
	// $materia = 'Materia Prima';
	// $vig = 'VIG';
	// echo($materia);

    // $sql 	= "	INSERT INTO 	seg_entradas (nombre, cantidad_entrada, categoria, estatus_entrada,  fecha_registro)
    //     						VALUES 		( :nombre, :cantidad_entrada, :materia, :vig, NOW());";
    // $sql2 	= "SELECT cantidad_materia_prima FROM seg_materia_prima WHERE nombre_materia_prima = :nombre"
    $sql2		= "CALL entradasmateriaprima(?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery2 = Conexion::conectar()->prepare($sql2);

   // $vquery->bindparam(':nombre', $nombre);
   // $vquery->bindparam(':cantidad_entrada', $cantidad_entrada);
   // $vquery->bindparam(':materia', $materia);
   // $vquery->bindparam(':vig', $vig);

   $vquery2->bindparam(1, $nombre);
   $vquery2->bindparam(2, $cantidad_entrada);
   $vquery2->bindparam(3, $user);

   // $vquery->execute();
   $vquery2->execute();

   exit();
   // $vquery->close();
}

if (isset($_GET["consultar"])) {
	$cve_entrada = $_GET["consultar"];

	$sql	= "	SELECT * FROM seg_entradas WHERE cve_entrada =" .$cve_entrada;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();

}

if (isset($_GET['actualizar']) ) {
	$cve_entrada 		= $_POST['cve_entrada'];
	$nombre 			= $_POST['nombre'];
	$cantidad_entrada 	= $_POST['cantidad_entrada'];

	$sql 	= "CALL updateentradas(?, ?, ?)";

  	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $cve_entrada);
   	$vquery->bindparam(2, $nombre);
   	$vquery->bindparam(3, $cantidad_entrada);

  	$vquery->execute();

   	echo json_encode(["success"=>1]);
  	exit();

}
	
 ?>