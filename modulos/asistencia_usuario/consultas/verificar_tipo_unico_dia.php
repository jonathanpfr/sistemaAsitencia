<?php
require_once '../../../clases/asistencia/class_asistencia.php';
require_once '../../../clases/conexion.php';
$i_tipo=$_POST["i_tipo"];
$i_fecha=$_POST["i_fecha"];//
$i_id_usuario=$_POST["i_id_usuario"];//i_id_usuario
$clase=new asistencia();
$reg=$clase->verificar_tipo_dia($i_tipo,$i_fecha,$i_id_usuario);
echo $reg[0]["contar"];