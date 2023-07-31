<?php 
include_once "../../../dbconexion/conexion.php";

class ModeloTiempoPerdido{
	function showMaquina(){
		$sql = "	SELECT  *
					FROM cat_maquinas
					WHERE estatus_maq = 'VIG' AND cve_depto = 3 AND tiempo_perdido = 1
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

if ( isset($_GET['accion']) && $_GET['accion'] == "insertar") {
	// die (json_encode($_REQUEST));
	$maquina 	= $_POST['maquina'];
	$fallo 		= $_POST['fallo'];
	$motivo 	= $_POST['motivo'];
	$horainicio 	= $_POST['horainicio'];
	$horafin 	= $_POST['horafin'];
	$usuario 	= $_POST['usuario'];

    $sql		= "INSERT INTO seg_tiempoperdido (cve_maq, cve_fallo, motivo_fallo, hora_inicio, hora_fin, area, capturado_por, eliminado_por, estatus_tp, fecha_registro, fecha_eliminado) VALUES (:maquina, :fallo, :motivo, :horainicio, :horafin, 'VibroBlock', :usuario, '', 'VIG', NOW(), 0);";

   $vquery = Conexion::conectar()->prepare($sql);

   $vquery->bindparam(':maquina', 		$maquina);
   $vquery->bindparam(':fallo', 		$fallo);
   $vquery->bindparam(':motivo', 	$motivo);
   $vquery->bindparam(':horainicio', 	$horainicio);
   $vquery->bindparam(':horafin', 	$horafin);
   $vquery->bindparam(':usuario', 		$usuario);

   $vquery->execute();

   exit();

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

if (isset($_GET['eliminar']) ) {
    $cve_tpe  = $_POST['cve_tpe'];
    $usuarioe       = $_POST['usuarioe'];


   $sql     = " UPDATE  seg_tiempoperdido 
                SET     estatus_tp = 'DELETE',
                        eliminado_por = :usuarioe,
                        fecha_eliminado = NOW()
                WHERE   cve_tp = :cve_tpe";

   $vquery = Conexion::conectar()->prepare($sql);

   $vquery->bindparam(':cve_tpe', $cve_tpe);
   $vquery->bindparam(':usuarioe', $usuarioe);


   $vquery->execute();

   echo json_encode(["success"=>1]);
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


 ?>