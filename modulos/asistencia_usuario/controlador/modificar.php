<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../clases/asistencia/class_asistencia.php");
require_once("../../../clases/conexion.php");

$i_id_usuario=$_POST["i_id_usuario"];
$i_fecha=$_POST["i_fecha"];
$hora_com=$_POST["hora_com"];
$i_tipo=$_POST["i_tipo"];
$i_estado=$_POST["i_estado"];
$m_id_asistencia=$_POST["m_id_asistencia"];

//$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); echo $hostname;  

$ip_publica= $_SERVER['REMOTE_ADDR'];//ip publica, funciona subiendolo a la nube recien
$localIP = getHostByName(php_uname('n'));
//otra forma $localIP = getHostByName(getHostName());

$ip_publica_ip_local=$ip_publica.",".$localIP;

$tra=new asistencia(); 
$tra->update_asistencia_admin($i_id_usuario, $hora_com, $i_fecha, $i_tipo, $ip_publica_ip_local, $id_usuario_sesion, $i_estado, $m_id_asistencia);
?>