<?php 
include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertarq" ) {
	$nombre = $_POST['nombre'];
	$cantidad_entrada = $_POST['cantidad_entrada'];

    $sql2       = "CALL entradasquimicos(?, ?)";

   $vquery2 = Conexion::conectar()->prepare($sql2);

   $vquery2->bindparam(1, $nombre);
   $vquery2->bindparam(2, $cantidad_entrada);

   $vquery2->execute();

   exit();

}

if (isset($_GET["consultar"])) {
    $cve_entrada = $_GET["consultar"];

    $sql    = " SELECT * FROM seg_entradas WHERE cve_entrada =" .$cve_entrada;
    // $sql = " SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

    $vquery = Conexion::conectar()->prepare($sql);
    $vquery ->execute();
    $lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lista);
    exit();
}

if (isset($_GET['actualizar']) ) {
    $cve_entrada        = $_POST['cve_entrada'];
    // $cve_entrada = $_GET["consultar"];
    $nombre = $_POST['nombre'];
    $cantidad_entrada = $_POST['cantidad_entrada'];

   /*$sql   = " UPDATE  seg_entradas 
                SET     nombre = :nombre, cantidad_entrada=:cantidad_entrada 
                WHERE   cve_entrada = :cve_entrada";*/

    $sql        = "CALL updateentradas(?, ?, ?)";

   // $vquery = Conexion::conectar()->prepare($sql);
   $vquery = Conexion::conectar()->prepare($sql);

   // $vquery->bindparam(':cve_entrada', $cve_entrada);
   // $vquery->bindparam(':nombre', $nombre);
   // $vquery->bindparam(':cantidad_entrada', $cantidad_entrada);
   // $vquery->bindparam(':cve_entrada', $cve_entrada);

   $vquery->bindparam(1, $cve_entrada);
   $vquery->bindparam(2, $nombre);
   $vquery->bindparam(3, $cantidad_entrada);

   // $vquery->execute();
   $vquery->execute();

   echo json_encode(["success"=>1]);
   exit();

}

 ?>