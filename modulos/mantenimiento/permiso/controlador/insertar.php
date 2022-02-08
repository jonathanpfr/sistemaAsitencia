<?php
@session_start();
$id_usuario_sesion = $_SESSION['id_user'];
require_once("../../../../clases/permiso/class_permiso.php");
require_once("../../../../clases/conexion.php");

$i_usuario = $_POST["i_usuario"];
$i_motivo = $_POST["i_motivo"];
$i_estado = $_POST["i_estado"];
$i_fecha_permiso = $_POST["i_fecha_permiso"];
$hora_entrada_com = $_POST["hora_entrada_com"];
$hora_salida_com = $_POST["hora_salida_com"];
$i_descripcion = $_POST["i_descripcion"];

$tra = new permiso();
$tra->add_permiso($i_usuario, $i_motivo, $i_fecha_permiso, $hora_entrada_com, $hora_salida_com, $i_descripcion, $i_estado, $id_usuario_sesion);
?>