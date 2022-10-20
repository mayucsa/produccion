<?php 
	include_once "modelo_entradas.php";

	$objEntrada = new modeloCapturaEntrada();
	// $objEntrada = new modeloCapturaEntrada();
	// $cve_personal   	= !empty($_POST['cve_personal'])?$_POST['cve_personal']:"";
	$nombre_mat_prima 	= !empty($_POST['comb_mat_prima'])?$_POST['comb_mat_prima']:"";
	$cantidad 			= !empty($_POST['comb_cantidad'])?$_POST['comb_cantidad']:"";

	// $datos = array(
	// 				'nombre_mat_prima' 	=> $nombre_mat_prima,
	// 				'cantidad'			=> $cantidad
	// 			);
	// $datos = array(
					// $nombre_mat_prima 	= $_POST['comb_mat_prima'];
					// $cantidad			= $_POST['comb_cantidad'];
	// );

	var_dump($nombre_mat_prima, $cantidad);
	// var_dump($cantidad);
	// var_dump($cantidad);
	echo modeloCapturaEntrada::insertarDatos($nombre_mat_prima, $cantidad);
	// $valmsg = $objEntrada->insertarDatos($datos);
 ?>