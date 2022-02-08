<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/cargo/class_cargo.php");
require_once("../../../../clases/conexion.php");

$e_id_cargo=$_POST["e_id_cargo"];

$tra=new cargo(); 
$tra->delete_cargo($id_usuario_sesion, $e_id_cargo)
?>