<?php

@session_start();
$id_usuario_sesion = $_SESSION['id_user'];
require_once("../../../../clases/permiso/class_permiso.php");
require_once("../../../../clases/conexion.php");


$i_usuario = $_POST["i_usuario"];
$m_id_permiso = $_POST["m_id_permiso"];
$m_motivo = $_POST["m_motivo"];
$m_descripcion = $_POST["m_descripcion"];
$i_estado = $_POST["i_estado"];
$hora_entrada_com = $_POST["hora_entrada_com"];
$hora_salida_com = $_POST["hora_salida_com"];
$fecha =$_POST["m_fecha_permiso"];

$tra = new permiso();
$tra->update_permiso($m_motivo, $fecha, $hora_entrada_com, $hora_salida_com, $m_descripcion, $i_estado, $id_usuario_sesion, $m_id_permiso);
?>