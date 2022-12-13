<?php

	
	// $conex = new mysqli("localhost", "root", "", "produccion");

	// Class Conexion{
	// 	private $host			='localhost';
	// 	private $usuario		='root';
	// 	private $contrasenia	='';
	// 	private $dbname			='produccion';
	// 	private $conect;

	// 	public function __construct(){
	// 		$connectionString = "mysql:hos=".$this->host.";dbname=".$this->dbname.";charset=utf8";
	// 		try {
	// 			$this->conect = new PDO($connectionString, $this->usuario, $this->contrasenia);
	// 			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 			echo "Conexion Exitosa";
	// 		} catch (Exception $e) {
	// 			$this->conect = 'Error de Conexión';
	// 			echo "ERROR: ". $e->getMessage();
	// 		}
	// 	}

	// }

	// $conect = new Conexion();


	class Conexion{
		public static function conectar(){
		// public function conectar(){
		 	// $host			='mysql:dbname=produccionmayucsa;host=localhost';
			// $usuario		='root';
			// $contrasenia	='';
		 	// $host			='mysql:dbname=mayucsac_produccionmayucsa;host=162.241.62.122';
			// $usuario		='mayucsac_root';
			// $contrasenia	='$oportemys#1';
			// $host			='mysql:dbname=produccionmayucsa;host=192.168.1.6';
			$host			='mysql:dbname=produccionmayucsa;host=mayucsa.synology.me';
			$usuario		='alfredochaan';
			$contrasenia	='$oporteMys#1';
			// $dbname			='produccionmayucsa';
			try {
				$database =  new PDO($host, $usuario, $contrasenia);
				// echo "Conexion Exitosa <br>";
				return $database;
			} catch (PDOException $e) {
				echo "Falló de Conexion". $e->getMessage();
			}
		}
	}
	$stmt = Conexion::conectar();

?>