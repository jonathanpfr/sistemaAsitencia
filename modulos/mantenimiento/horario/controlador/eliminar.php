<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/horario/class_horario.php");
require_once("../../../../clases/conexion.php");

$e_id_horario=$_POST["e_id_horario"];

$tra=new horario(); 
$tra->delete_horario($id_usuario_sesion, $e_id_horario);
?>