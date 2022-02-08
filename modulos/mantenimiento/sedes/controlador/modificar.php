<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/sede/class_sede.php");
require_once("../../../../clases/conexion.php");

$nombre=$_POST["m_nombre"];
$id_estado=$_POST["m_estado"];
$m_id_sede=$_POST["m_id_sede"];

$tra=new sede(); 
$tra->update_sede($nombre, $id_estado, $id_usuario_sesion, $m_id_sede);
?>