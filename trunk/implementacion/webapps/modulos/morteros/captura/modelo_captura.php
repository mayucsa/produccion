<?php 
include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
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
					WHERE cve_producto = $cve_producto AND estatus_segpresentacion = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	public static function showTonelada($cve_producto){
		$sql = "	SELECT  tonelada_producto
					FROM cat_productos
					WHERE cve_producto = $cve_producto";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

class modeloMostrarCaptura extends Conexion{
		public function mostrarDatos(){
		$sql = "SELECT cve_producto, 
							valor_presentacion, 
							num_barcadas, 
							kg_real, 
							sacos_totales, 
							fecha_registro  
					FROM captura_produccion
					ORDER BY fecha_registro DESC";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}

}

if ( isset($_GET['accion']) && $_GET['accion'] == "insertar") {
	$cve_producto 			= $_POST['producto'];
	$cve_segtonelada 		= $_POST['tonelada'];
	$valor_presentacion 	= $_POST['presentacion'];
	$num_tarimas 			= $_POST['numtarima'];
	$num_barcadas 			= $_POST['numbarcada'];
	$kg_porformula 		= $_POST['kgformula'];
	$kg_real 				= $_POST['kgreal'];
	$diferencia 			= $_POST['diferencia'];
	$sacos_usados 			= $_POST['sacousado'];
	$sacos_rotos 			= $_POST['sacoroto'];
	$sacos_totales 		= $_POST['sacototal'];

	$user 	= $_POST['user'];
	
	// $materia = 'Materia Prima';
	// $vig = 'VIG';
	// // echo($materia);

 //    $sql 	= "	INSERT INTO 	seg_entradas (nombre, cantidad_entrada, categoria, estatus_entrada,  fecha_registro)
 //        						VALUES 		( :nombre, :cantidad_entrada, :materia, :vig, NOW());";

    $sql2		= "CALL capturaproduccion(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery2 = Conexion::conectar()->prepare($sql2);

   // $vquery->bindparam(':nombre', $nombre);
   // $vquery->bindparam(':cantidad_entrada', $cantidad_entrada);
   // $vquery->bindparam(':materia', $materia);
   // $vquery->bindparam(':vig', $vig);

   	$vquery2->bindparam(1, $cve_producto);
   	$vquery2->bindparam(2, $cve_segtonelada);
 		$vquery2->bindparam(3, $valor_presentacion);
   	$vquery2->bindparam(4, $num_tarimas);
   	$vquery2->bindparam(5, $num_barcadas);
 		$vquery2->bindparam(6, $kg_porformula);
   	$vquery2->bindparam(7, $kg_real);
 		$vquery2->bindparam(8, $diferencia);
   	$vquery2->bindparam(9, $sacos_usados);
 		$vquery2->bindparam(10, $sacos_rotos);
   	$vquery2->bindparam(11, $sacos_totales);
   	$vquery2->bindparam(12, $user);

   // $vquery->execute();
   $vquery2->execute();

   exit();

}

if (isset($_GET["accion"]) && $_GET['accion'] == "consultar") {
	// die (json_encode($_REQUEST));
	$tarimas = $_REQUEST["tarimas"];

	$sql	= "	SELECT cantidad_materia_prima 
					FROM seg_materia_prima 
					WHERE nombre_materia_prima = 'tarimas'";
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	// echo json_encode($lista);
	$stock = $lista[0]['cantidad_materia_prima'];
	if (intval($tarimas) <= intval($stock)) {
		echo "correcto";
	}else{
		echo "error";
	}
	exit();

}

if ( isset($_GET['accion']) && $_GET['accion'] == "eliminarCaptura") {
	$producto 	= $_POST['producto'];
	$user 			= $_POST['user'];
	
	// $materia = 'Materia Prima';
	// $vig = 'VIG';
	// // echo($materia);

 	//    $sql 	= "	INSERT INTO 	seg_entradas (nombre, cantidad_entrada, categoria, estatus_entrada,  fecha_registro)
 	//        						VALUES 		( :nombre, :cantidad_entrada, :materia, :vig, NOW());";

   $sql2		= "CALL deleteproduccionmorteros(?, ?)";

   $vquery2 = Conexion::conectar()->prepare($sql2);


   	$vquery2->bindparam(1, $producto);
   	$vquery2->bindparam(2, $user);

   // $vquery->execute();
   $vquery2->execute();

   exit();

}


if (isset($_GET["obtenerDatos"])) {
	$cve_captura = $_GET["obtenerDatos"];

	$sql	= "	SELECT * FROM captura_produccion WHERE cve_captura =" .$cve_captura;
	// $sql	= "	SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();

}

 ?>