<?php  
include_once "../../../dbconexion/conexion.php";

if ( isset($_GET['accion']) == "insertar") {
    $nombre         = $_POST['nombre'];
    $descripcion    = $_POST['descripcion'];
    $estatus        = $_POST['estatus'];

    $sql    = "INSERT INTO cat_roles    (cve_rol, nombre_rol, descripcion_rol, estatus_rol, fecha_registro)
                                VALUES ('', :nombre, :descripcion, :estatus, NOW());";

    // $sql2       = "CALL insertrol(?, ?, ?)";
    $vquery    =    Conexion::conectar()->prepare($sql);
    

    // $vquery2 = Conexion::conectar()->prepare($sql2);

    // $vquery2->bindparam(1, $nombre);
    // $vquery2->bindparam(2, $descripcion);
    // $vquery2->bindparam(3, $estatus);
    $vquery->bindparam(':nombre', $nombre);
    $vquery->bindparam(':descripcion', $descripcion);
    $vquery->bindparam(':estatus', $estatus);
    
    // $vquery2->execute();
    $vquery->execute();

    exit();
    // $vquery->close();
}

 ?>