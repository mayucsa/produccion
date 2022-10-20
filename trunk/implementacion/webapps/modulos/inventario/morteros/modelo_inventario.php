<?php 
include_once "../../../dbconexion/conexion.php";

class modeloInventario extends Conexion{
	public function mostrarProducto(){
		$sql = "SELECT	cve_segproducto,
						nombre_producto,
						valor_presentacion,
						cantidad
				FROM 	seg_producto 
				WHERE 	estatus_segproducto = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
	
	public function mostrarMatPrima(){
		$sql = "SELECT	cve_segmatprima,
						nombre_materia_prima,
						cantidad_materia_prima,
						unidad_medida
				FROM 	seg_materia_prima
				WHERE 	estatus_segmatprima = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}

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

	public function mostrarExcel(){
		$sql = "SELECT	nombre_producto ,
						valor_presentacion,
						cantidad,
						cantidad / 100 AS tonelada,
						cantidad / valor_presentacion AS sacos
				FROM 	seg_producto 
				WHERE 	estatus_segproducto = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
	
	public function mostrarExcelMatPrima(){
		$sql = "SELECT	nombre_materia_prima,
						cantidad_materia_prima
				FROM 	seg_materia_prima
				WHERE 	estatus_segmatprima = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}

	public function mostrarExcelQuimico(){
		$sql = "SELECT	nombre_quimico,
						cantidad_quimico
				FROM 	seg_quimico
				WHERE 	estatus_segquimico = 'VIG'";
		$vquery = Conexion::conectar()->prepare($sql);
		$vquery->execute();
		return $vquery->fetchAll();
		$vquery->close();
	}
}

 ?>