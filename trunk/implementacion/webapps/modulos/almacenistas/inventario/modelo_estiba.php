<?php
include_once "../../../dbconexion/conexion.php";

class modeloInventario extends Conexion{
    public function mostrarExcel(){
        $sql = "SELECT  area,
                        nombre_producto,
                        presentacion,
                        num_celdas,
                        numero_estiba,
                        cantidad_estiba 
                FROM seg_inventario_estibas
                WHERE cantidad_estiba > 0 AND estatus_estiba = 'VIG'
                ORDER BY area ASC, numero_estiba ASC";
        $vquery = Conexion::conectar()->prepare($sql);
        $vquery->execute();
        return $vquery->fetchAll();
        $vquery->close();
    }
}

if ( isset($_GET['accion']) == "insertar") {
    $cve_estiba         = $_POST['cve_estiba'];
    $area               = $_POST['area'];
    $nombre_producto    = $_POST['nombre_producto'];
    $presentacion       = $_POST['presentacion'];
    $celdas             = $_POST['celdas'];
    $estiba             = $_POST['estiba'];
    $cantidad           = $_POST['cantidad'];
    $rotura             = $_POST['rotura'];
    $user               = $_POST['user'];

    $sql        = "CALL roturadiaria(?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $vquery = Conexion::conectar()->prepare($sql);

    $vquery->bindparam(1,  $cve_estiba);
    $vquery->bindparam(2,  $area);
    $vquery->bindparam(3,  $nombre_producto);
    $vquery->bindparam(4,  $presentacion);
    $vquery->bindparam(5,  $celdas);
    $vquery->bindparam(6,  $estiba);
    $vquery->bindparam(7,  $cantidad);
    $vquery->bindparam(8,  $rotura);
    $vquery->bindparam(9,  $user);

   $vquery->execute();

   exit();

}

if (isset($_GET["consultar"])) {
    $cve_estiba = $_GET["consultar"];

    $sql    = " SELECT * FROM seg_inventario_estibas WHERE cve_estiba =" .$cve_estiba;
    // $sql = " SELECT * FROM seg_entradas ORDER BY fecha_registro DESC";

    $vquery = Conexion::conectar()->prepare($sql);
    $vquery ->execute();
    $lista = $vquery->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($lista);
    exit();

}

 ?>