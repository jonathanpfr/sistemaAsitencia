<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/permiso/class_permiso.php");
require_once("../../../../clases/conexion.php");

$e_id_permiso=$_POST["e_id_permiso"];

$tra=new permiso(); 
$tra->delete_permiso($id_usuario_sesion, $e_id_permiso);
?>