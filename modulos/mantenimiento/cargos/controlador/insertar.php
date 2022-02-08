<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/cargo/class_cargo.php");
require_once("../../../../clases/conexion.php");

$nombre=$_POST["i_nombre"];
$id_estado=$_POST["i_estado"];

$tra=new cargo(); 
$tra->add_cargo($nombre, $id_estado, $id_usuario_sesion);
?>