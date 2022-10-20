<?php 
include_once "../../../dbconexion/conexion.php";
// include_once "modelo_insert_entrada.php";

class modeloCapturaSalida extends Conexion{
	function showProducto(){
		$sql = "	SELECT  cve_producto,
							nombre_producto,
							tonelada_producto
					FROM cat_productos
					WHERE estatus_producto = 'VIG'
					ORDER BY nombre_producto asc";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPresentacion($cve_producto){
		$sql = "	SELECT  *
					FROM seg_presentacion
					WHERE cve_producto = $cve_producto";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	public function mostrarDatos(){
		$sql = "SELECT 	nombre_salida, 
						presentacion_salida, 
						cantidad_salida, 
						motivo_salida, 
						fecha_registro
				FROM seg_salidas
				WHERE estatus_salida = 'VIG'
				ORDER BY fecha_registro DESC";
		$vquery = Conexion::conectar()->prepare($sql);
        $vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
	function showMP(){
		$sql = "	SELECT  cve_segmatprima,
							nombre_materia_prima,
							estatus_segmatprima
					FROM seg_materia_prima
					WHERE estatus_segmatprima = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$cve_producto 			= $_POST['producto'];
	$presentacion 			= $_POST['presentacion'];
	$cantidad_salida 		= $_POST['cantidad'];
	$motivo_salida 			= $_POST['motivo'];	

    $sql		= "CALL salidaproducto(?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $cve_producto);
   	$vquery->bindparam(2, $presentacion);
   	$vquery->bindparam(3, $cantidad_salida);
 	$vquery->bindparam(4, $motivo_salida);

   	$vquery->execute();

   exit();

}

if (isset($_GET["consultar"])) {
	$cve_salida = $_GET["consultar"];

	$sql	= "	SELECT * FROM seg_salidas WHERE cve_salida =" .$cve_salida;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();

}

if (isset($_GET['actualizar']) ) {
	$cve_salida 			= $_POST['cve_salida'];
	$nombre_salida 			= $_POST['nombre_salida'];
	$presentacion_salida	= $_POST['presentacion_salida'];
	$cantidad_salida		= $_POST['cantidad_salida'];

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

   $vquery->bindparam(1, $cve_salida);
   $vquery->bindparam(2, $nombre_salida);
   $vquery->bindparam(3, $presentacion_salida);
   $vquery->bindparam(4, $cantidad_salida);

   // $vquery->execute();
   $vquery->execute();

   echo json_encode(["success"=>1]);
   exit();

}
	
 ?>