<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/sede/class_sede.php");
require_once("../../../../clases/conexion.php");

$nombre=$_POST["i_nombre"];
$id_estado=$_POST["i_estado"];

$tra=new sede(); 
$tra->add_sede($nombre, $id_estado, $id_usuario_sesion);
?>