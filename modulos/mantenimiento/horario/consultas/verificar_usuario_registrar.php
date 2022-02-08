<?php
require_once '../../../../clases/horario/class_horario.php';
require_once '../../../../clases/conexion.php';
$i_usuario=$_POST["i_usuario"];
$clase=new horario();
$reg=$clase->verificar_horario_registrar($i_usuario);
echo $reg[0]["contar"];