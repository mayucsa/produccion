<?php 

include_once "../../../dbconexion/conn.php";

class Modelo_login{
	function consulta_usuario_existencia($usuario){
		$resultado 	= false;
		try {
			$dbcon	= 	new MysqlConn;
			$con 	= 	$dbcon->conn();
			$sql 	= 	"SELECT nombre_usuario FROM cat_usuarios WHERE nombre_usuario = '".$usuario."'";
            $usuario = $dbcon->qBuilder($con, 'first', $sql);
            if ($usuario) {
                $resultado = true;
            }
		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
		return $resultado;
	}

	function consulta_contrasenia_correcta($usuario, $contrasenia){
		$resultado = false;
		try {
			$dbcon	= 	new MysqlConn;
			$con 	= 	$dbcon->conn();
			$sql	=	"SELECT nombre_usuario FROM cat_usuarios WHERE nombre_usuario = '".$usuario."' AND contrasenia = '".$contrasenia."'";
            $pass = $dbcon->qBuilder($con, 'first', $sql);
            if ($pass) {
                $resultado = true;
            }
		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
		return $resultado;
	}

    function consulta_vigencia_persona($usuario) {
        try {
            $dbcon = new MysqlConn;
            $con = $dbcon->conn();
            $sql = "SELECT  estatus_usuario
                    FROM    cat_usuarios
                    WHERE   nombre_usuario = '".$usuario."'";
            $vig = $dbcon->qBuilder($con, 'first', $sql);
            if ($vig) {
                $resultado = true;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $resultado;
    }

    function consulta_usuario_persona($usuario, $contrasenia) {
        try {
            $dbcon = new MysqlConn;
            $con = $dbcon->conn();
            $sql = "SELECT 	*
            		FROM 	cat_usuarios
            		WHERE 	nombre_usuario = '".$usuario."' AND contrasenia = '".$contrasenia."'";
            $persona = $dbcon->qBuilder($con, 'first', $sql);
            if ($persona) {
                return $persona;
            }else{
                return false;
            }
        } catch (excepcion $e) {
            echo $e->getMenssage();
            return false;
        }
    }
}
?>
