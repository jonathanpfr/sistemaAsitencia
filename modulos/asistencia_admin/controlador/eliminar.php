<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../clases/asistencia/class_asistencia.php");
require_once("../../../clases/conexion.php");

$e_id_asistencia=$_POST["e_id_asistencia"];

$tra=new asistencia(); 
$tra->delete_asistencia($id_usuario_sesion, $e_id_asistencia);
?>