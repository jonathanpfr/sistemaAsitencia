<?php
@session_start();
$id_usuario_sesion=$_SESSION['id_user'];
require_once("../../../../clases/usuario/class_usuario.php");
require_once("../../../../clases/conexion.php");

$nombre=$_POST["i_nombre"];
$i_apellidos=$_POST["i_apellidos"];
$i_sexo=$_POST["i_sexo"];
$i_fecha_naci=$_POST["i_fecha_naci"];
$i_departamento=$_POST["i_departamento"];
$i_telefono=$_POST["i_telefono"];
$i_dni=$_POST["i_dni"];
$i_clave=$_POST["i_clave"];
$i_perfil=$_POST["i_perfil"];
$i_cargo=$_POST["i_cargo"];
$i_sede=$_POST["i_sede"];
$i_ini_contrato=$_POST["i_ini_contrato"];
$i_fin_contrato=$_POST["i_fin_contrato"];
$i_estado=$_POST["i_estado"];
$m_id_usuario=$_POST["m_id_usuario"];

$m_tipo_contrato=$_POST["m_tipo_contrato"];
$m_horario=$_POST["m_horario"];


$tra=new usuario(); 
$tra->update_usuario($i_perfil, $i_dni, $nombre, $i_apellidos, $i_sexo, $i_fecha_naci, $i_departamento, $i_telefono,
        $i_clave, $i_cargo, $i_sede, $i_ini_contrato, $i_fin_contrato, $id_usuario_sesion, $i_estado, $m_id_usuario,
        $m_tipo_contrato,$m_horario);
?>