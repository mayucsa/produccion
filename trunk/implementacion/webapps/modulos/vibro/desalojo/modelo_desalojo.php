<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
	function showProductoVibro(){
		$sql = "	SELECT  cve_pbloquera,
							nombre_producto
					FROM cat_producto_bloquera
					WHERE area = 'VibroBlock' AND estatus = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPresentacionVibro($cve_pbloquera){
		$sql = "	SELECT  *
					FROM seg_presentacion_bloquera
					WHERE cve_pbloquera = $cve_pbloquera AND estatus_presentacion = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$producto 		= $_POST['producto'];
	$presentacion 	= $_POST['presentacion'];
	$total 			= $_POST['total'];
	$rotura 		= $_POST['rotura'];
	$despuntados 	= $_POST['despuntados'];
	$user			= $_POST['user'];

    $sql		= "CALL desalojobloquera(?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $presentacion);
 	$vquery->bindparam(3,  $total);
   	$vquery->bindparam(4,  $rotura);
   	$vquery->bindparam(5,  $despuntados);
   	$vquery->bindparam(6,  $user);

   // $vquery->execute();
   $vquery->execute();

   exit();

}


 ?>