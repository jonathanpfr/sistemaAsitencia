<?php
require_once '../../../../clases/usuario/class_usuario.php';
require_once '../../../../clases/conexion.php';
$dni=$_POST["dni"];
$clase=new usuario();
$reg=$clase->verificar_dni_registrar($dni);
echo $reg[0]["contar"];