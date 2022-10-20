<?php 
include_once "../../../dbconexion/conexion.php";

class ModeloLaboratorio{
	function showProducto(){
		$sql = "	SELECT  cve_concentrado,
							nombre_concentrado,
							cantidad_concentrado
					FROM seg_concentrado
					WHERE estatus_concentrado = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
	function showconcentrado(){
		$sql = "	SELECT  cve_concentrado,
							nombre_concentrado,
							cantidad_concentrado
					FROM seg_concentrado
					WHERE estatus_concentrado = 'VIG'";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}
}
class modeloConcentrado extends Conexion{
		public function mostrarDatos(){
			$sql = "SELECT  cve_concentrado,
							nombre_concentrado,
							cantidad_concentrado,
							fecha_registro
					FROM seg_concentrado
					WHERE estatus_concentrado = 'VIG'
					ORDER BY cve_concentrado ASC";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
		}

}

class modeloinventario extends Conexion{
	public function mostrarQuimicos(){
		$sql = "SELECT	cve_segquimico,
						nombre_quimico,
						cantidad_quimico
				FROM 	seg_quimico
				WHERE 	estatus_segquimico = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
}

class modeloCaptura extends Conexion{
	public function mostrarCaptura(){
		$sql = "SELECT	cve_concentrado,
						nombre_concentrado,
						cantidad_captura,
						fecha_registro
				FROM 	captura_concentradoq
				WHERE 	estatus_captura = 'VIG'
				ORDER BY fecha_registro DESC";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}

	public function mostrarExcel(){
		$sql = "SELECT nombre_quimico, cantidad_quimico FROM seg_quimico
				UNION
				SELECT nombre_concentrado, cantidad_concentrado FROM seg_concentrado";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
}

if ( isset($_GET['accion']) == "insertar") {
	$concentrado = $_POST['concentrado'];
	$cantidad = $_POST['cantidad'];

    $sql		= "CALL concentradoquimicos(?, ?)";


   $vquery = Conexion::conectar()->prepare($sql);



   $vquery->bindparam(1, $concentrado);
   $vquery->bindparam(2, $cantidad);

   $vquery->execute();

   exit();

}
?>