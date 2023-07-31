<?php 
include_once "../../../dbconexion/conexion.php";

class ModeloTiempoPerdido{
	function showMaquinaL1(){
		$sql = "	SELECT  *
					FROM cat_maquinas
					WHERE estatus_maq = 'VIG' AND cve_depto = 2 AND tiempo_perdido = 1
					ORDER BY cve_alterna asc";

			 $vquery = Conexion::conectar()->prepare($sql);
          $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showMaquinaL2(){
		$sql = "	SELECT  *
					FROM cat_maquinas
					WHERE estatus_maq = 'VIG' AND cve_depto = 2 AND tiempo_perdido = 1
					ORDER BY cve_alterna asc";

			 $vquery = Conexion::conectar()->prepare($sql);
          $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showFallo(){
		$sql = "	SELECT  *
					FROM cat_fallos
					WHERE estatus_fallo = 'VIG'
					ORDER BY cve_alterna asc";

			 $vquery = Conexion::conectar()->prepare($sql);
          $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}

if (isset($_GET["consultar"])) {
	$cve_tp = $_GET["consultar"];

	$sql	= "	SELECT * FROM seg_tiempoperdido WHERE cve_tp =" .$cve_tp;

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();
}

if (isset($_GET['actualizar']) ) {
	$cve_tp 	= $_POST['cve_tp'];
	$maquina 	= $_POST['maquina'];
	$fallo 		= $_POST['fallo'];
	$motivo 	= $_POST['motivo'];
	$horainicio	= $_POST['horainicio'];
	$horafin 	= $_POST['horafin'];
	$usuario 	= $_POST['usuario'];

   	$sql		= "CALL editarTP(?, ?, ?, ?, ?, ?, ?)";

   	$vquery = Conexion::conectar()->prepare($sql);

   	$vquery->bindparam(1, $cve_tp);
   	$vquery->bindparam(2, $maquina);
   	$vquery->bindparam(3, $fallo);
   	$vquery->bindparam(4, $motivo);
   	$vquery->bindparam(5, $horainicio);
   	$vquery->bindparam(6, $horafin);
   	$vquery->bindparam(7, $usuario);

   	$vquery->execute();

   	echo json_encode(["success"=>1]);
   	exit();

}
if (isset($_GET["consultarDelete"])) {
	$cve_tp = $_GET["consultarDelete"];

	$sql	= "	SELECT cve_tp AS cve, M.nombre_maq AS maquina, F.nombre_fallo AS fallo
				FROM seg_tiempoperdido TP
				INNER JOIN cat_fallos F ON F.cve_fallo = TP.cve_fallo
				INNER JOIN cat_maquinas M ON M.cve_maq = TP.cve_maq
				WHERE TP.cve_tp =" .$cve_tp;

	$vquery = Conexion::conectar()->prepare($sql);
	$vquery ->execute();
	$lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($lista);
	exit();
}

 ?>