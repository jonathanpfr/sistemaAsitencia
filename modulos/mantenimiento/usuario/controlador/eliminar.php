<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/usuario/class_usuario.php");
require_once("../../../../clases/conexion.php");

$e_id_usuario=$_POST["e_id_usuario"];

$tra=new usuario(); 
$tra->delete_usuario($id_usuario_sesion, $e_id_usuario);
?>