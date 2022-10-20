<?php
class Datos_usuario{
	// var $usuario;
	var $clave_usuario;
	var $nombre_usuario;
	var $nombre_persona;
	var $apellido_persona;
	var $puesto_persona;
	var $rol_persona;

	var $vista_dashboard;

	var $vista_inventario;

	var $vista_laboratorio;

	var $vista_besser;

	var $vista_vibro;

	var $vista_almacenistas;

	var $vista_reportes;

	var $vista_usuarios;

	var $vista_morteros;
	var $captura_morteros;
	var $edit_morteros;
	var $delete_morteros;
	// var $puesto;

	function set_clave_usuario($clave_usuario){
            $this->clave_usuario = $clave_usuario;
	}
	function get_clave_usuario(){
            return $this->clave_usuario;
	}

	function set_nombre_usuario($nombre_usuario){
            $this->nombre_usuario = $nombre_usuario;
	}
	function get_nombre_usuario(){
            return $this->nombre_usuario;
	}

	function set_nombre_persona($nombre_persona){
            $this->nombre_persona = $nombre_persona;
	}
	function get_nombre_persona(){
            return $this->nombre_persona;
	}
	function set_apellido_persona($apellido_persona){
            $this->apellido_persona = $apellido_persona;
	}
	function get_apellido_persona(){
            return $this->apellido_persona;
	}

	function set_puesto_persona($puesto_persona){
            $this->puesto_persona = $puesto_persona;
	}
	function get_puesto_persona(){
            return $this->puesto_persona;
	}

	function set_rol_persona($rol_persona){
            $this->rol_persona = $rol_persona;
	}
	function get_rol_persona(){
            return $this->rol_persona;
	}


	/*Permisos Dashboard*/
	function set_vista_dashboard($vista_dashboard){
            $this->vista_dashboard = $vista_dashboard;
	}
	function get_vista_dashboard(){
            return $this->vista_dashboard;
	}

	/*Permisos Inventario*/
	function set_vista_inventario($vista_inventario){
            $this->vista_inventario = $vista_inventario;
	}
	function get_vista_inventario(){
            return $this->vista_inventario;
	}

	/*Permisos Laboratorio*/
	function set_vista_laboratorio($vista_laboratorio){
            $this->vista_laboratorio = $vista_laboratorio;
	}
	function get_vista_laboratorio(){
            return $this->vista_laboratorio;
	}

	/*Permisos Besser*/
	function set_vista_besser($vista_besser){
            $this->vista_besser = $vista_besser;
	}
	function get_vista_besser(){
            return $this->vista_besser;
	}

	/*Permisos Vibro*/
	function set_vista_vibro($vista_vibro){
            $this->vista_vibro = $vista_vibro;
	}
	function get_vista_vibro(){
            return $this->vista_vibro;
	}

	/*Permisos Almacenistas*/
	function set_vista_almacenistas($vista_almacenistas){
            $this->vista_almacenistas = $vista_almacenistas;
	}
	function get_vista_almacenistas(){
            return $this->vista_almacenistas;
	}

	/*Permisos Reportes*/
	function set_vista_reportes($vista_reportes){
            $this->vista_reportes = $vista_reportes;
	}
	function get_vista_reportes(){
            return $this->vista_reportes;
	}

	/*Permisos Usuarios*/
	function set_vista_usuarios($vista_usuarios){
            $this->vista_usuarios = $vista_usuarios;
	}
	function get_vista_usuarios(){
            return $this->vista_usuarios;
	}

	/*Permisos Morteroes*/
	function set_vista_morteros($vista_morteros){
            $this->vista_morteros = $vista_morteros;
	}
	function get_vista_morteros(){
            return $this->vista_morteros;
	}
	function set_captura_morteros($captura_morteros){
            $this->captura_morteros = $captura_morteros;
	}
	function get_captura_morteros(){
            return $this->captura_morteros;
	}
	function set_edit_morteros($edit_morteros){
            $this->edit_morteros = $edit_morteros;
	}
	function get_edit_morteros(){
            return $this->edit_morteros;
	}
	function set_delete_morteros($delete_morteros){
            $this->delete_morteros = $delete_morteros;
	}
	function get_delete_morteros(){
            return $this->delete_morteros;
	}
	

}
?>