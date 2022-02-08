<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/sede/class_sede.php");
require_once("../../../../clases/conexion.php");

$e_id_sede=$_POST["e_id_sede"];

$tra=new sede(); 
$tra->delete_sede($id_usuario_sesion, $e_id_sede)
?>