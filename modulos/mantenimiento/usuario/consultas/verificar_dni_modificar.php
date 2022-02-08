<?php
require_once '../../../../clases/usuario/class_usuario.php';
require_once '../../../../clases/conexion.php';
$dni=$_POST["dni"];
$id_usuario=$_POST["m_id_usuario"];
$clase=new usuario();
$reg=$clase->verificar_dni_modificar($dni, $id_usuario);
echo $reg[0]["contar"];