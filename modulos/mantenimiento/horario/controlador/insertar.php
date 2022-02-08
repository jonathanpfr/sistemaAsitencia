<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/horario/class_horario.php");
require_once("../../../../clases/conexion.php");

//$i_usuario=$_POST["i_usuario"];
$i_tipo_contrato=$_POST["i_tipo_contrato"];
$i_dias=$_POST["i_dias"];
$i_estado=$_POST["i_estado"];
$hora_entrada_com=$_POST["hora_entrada_com"];
$hora_salida_com=$_POST["hora_salida_com"];
$hora_entrada_com_re=$_POST["hora_entrada_com_re"];
$hora_salida_com_re=$_POST["hora_salida_com_re"];

$tra=new horario(); 
$tra->add_horario($i_tipo_contrato, $i_dias, $hora_entrada_com, $hora_salida_com,
        $hora_entrada_com_re, $hora_salida_com_re, $i_estado, $id_usuario_sesion);
?>