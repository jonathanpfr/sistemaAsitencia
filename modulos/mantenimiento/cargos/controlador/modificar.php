<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/cargo/class_cargo.php");
require_once("../../../../clases/conexion.php");

$nombre=$_POST["m_nombre"];
$id_estado=$_POST["m_estado"];
$m_id_cargo=$_POST["m_id_cargo"];

$tra=new cargo(); 
$tra->update_cargo($nombre, $id_estado, $id_usuario_sesion, $m_id_cargo);
?>