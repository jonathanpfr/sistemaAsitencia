<?php
require_once '../../../../clases/horario/class_horario.php';
require_once '../../../../clases/conexion.php';
$i_usuario=$_POST["i_usuario"];
$id_horario=$_POST["m_id_horario"];
$clase=new horario();
$reg=$clase->verificar_horario_modificar($i_usuario, $id_horario);
echo $reg[0]["contar"];