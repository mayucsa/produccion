<?php 

include_once "../../../dbconexion/conexion.php";

class ModeloProducto{
	function showProductoBesser(){
		$sql = "	SELECT  cve_pbloquera,
							nombre_producto
					FROM cat_producto_bloquera
					WHERE area = 'Besser' AND estatus = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPresentacionBesser($cve_pbloquera){
		$sql = "	SELECT *
					FROM seg_presentacion_bloquera
					WHERE cve_pbloquera = $cve_pbloquera AND estatus_presentacion = 'VIG'
					GROUP BY nombre";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showCeldasBesser($cve_presentacionb){
		$sql = "	SELECT  *
					FROM seg_celdas_bloquera
					WHERE cve_presentacionb = $cve_presentacionb AND estatus_celda = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showPiezasBesser($cve_presentacionb){
		$sql = "	SELECT  *
					FROM seg_presentacion_bloquera
					WHERE cve_presentacionb = $cve_presentacionb AND estatus_presentacion = 'VIG'";

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
	$celdas 		= $_POST['celdas'];
	$total 			= $_POST['total'];
	$rotura 		= $_POST['rotura'];
	$despuntados 	= $_POST['despuntados'];
	$user			= $_POST['user'];

    $sql		= "CALL desalojobesser(?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1,  $producto);
   	$vquery->bindparam(2,  $presentacion);
   	$vquery->bindparam(3,  $celdas);
 	$vquery->bindparam(4,  $total);
   	$vquery->bindparam(5,  $rotura);
   	$vquery->bindparam(6,  $despuntados);
   	$vquery->bindparam(7,  $user);

   // $vquery->execute();
   $vquery->execute();

   exit();

}
 ?>