<?php 
include_once "../../../dbconexion/conexion.php";

class modeloSaqueria{
		function entradassalidas($fecha_inicio, $fecha_fin){
			$sql = "SELECT 	'S' AS tipo,
							seg_producto.codigo,
							cve_producto,
							captura_produccion.valor_presentacion,
							sacos_totales,
							captura_produccion.fecha_registro
					FROM `captura_produccion`
						INNER JOIN seg_producto ON seg_producto.nombre_producto = captura_produccion.cve_producto AND seg_producto.valor_presentacion = captura_produccion.valor_presentacion
					-- WHERE DATE(captura_produccion.fecha_registro) BETWEEN '2022-01-01' AND '2022-02-15'
					WHERE DATE(captura_produccion.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin
						UNION
					SELECT 'E',codigo, nombre, categoria, cantidad_entrada, seg_entradas.fecha_registro 
					FROM seg_entradas
						INNER JOIN seg_materia_prima ON seg_materia_prima.nombre_materia_prima = seg_entradas.nombre
					-- WHERE DATE(seg_entradas.fecha_registro) BETWEEN '2022-01-01' AND '2022-02-15' AND nombre LIKE '%Saco%'
					WHERE DATE(seg_entradas.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin AND nombre LIKE '%Saco%'
					ORDER BY fecha_registro desc";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
		}

		function reportepdf($fecha_inicio, $fecha_fin){
			$sql = "SELECT 	'S' AS tipo,
							seg_producto.codigo,
							cve_producto,
							captura_produccion.valor_presentacion,
							FORMAT(sacos_totales, 0) AS sacos_totales,
							DATE(captura_produccion.fecha_registro) AS fecha_registro
					FROM `captura_produccion`
						INNER JOIN seg_producto ON seg_producto.nombre_producto = captura_produccion.cve_producto AND seg_producto.valor_presentacion = captura_produccion.valor_presentacion
					WHERE DATE(captura_produccion.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin
						UNION
					SELECT 'E',codigo, nombre, 'N/A', FORMAT(cantidad_entrada, 0), DATE(seg_entradas.fecha_registro) AS fecha_registro
					FROM seg_entradas
						INNER JOIN seg_materia_prima ON seg_materia_prima.nombre_materia_prima = seg_entradas.nombre
					WHERE DATE(seg_entradas.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin AND nombre LIKE '%Saco%'
					ORDER BY fecha_registro desc";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
		}

	public function descargaExcel($fecha_inicio, $fecha_fin){
			$sql = "SELECT 	'S' AS tipo,
							seg_producto.codigo,
							cve_producto,
							captura_produccion.valor_presentacion,
							sacos_totales,
							captura_produccion.fecha_registro
					FROM `captura_produccion`
						INNER JOIN seg_producto ON seg_producto.nombre_producto = captura_produccion.cve_producto AND seg_producto.valor_presentacion = captura_produccion.valor_presentacion
					WHERE DATE(captura_produccion.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin
						UNION
					SELECT 'E',codigo, nombre, categoria, cantidad_entrada, seg_entradas.fecha_registro 
					FROM seg_entradas
						INNER JOIN seg_materia_prima ON seg_materia_prima.nombre_materia_prima = seg_entradas.nombre
					WHERE DATE(seg_entradas.fecha_registro) BETWEEN $fecha_inicio AND $fecha_fin AND nombre LIKE '%Saco%'
					ORDER BY fecha_registro desc";

			 $vquery = Conexion::conectar()->prepare($sql);
             $vquery->execute();
			 return $vquery->fetchAll();
			 $vquery->close();
			 $vquery = null;
	}

}
	
 ?>