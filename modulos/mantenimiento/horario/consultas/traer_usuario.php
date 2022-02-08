<?php
require_once("../../../../clases/usuario/class_usuario.php");
require_once("../../../../clases/conexion.php");

$tra = new usuario();
$reg = $tra->get_usuario_no_admin();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nombre = $reg[$i]['nombre'];
    $apellidos = $reg[$i]['apellidos'];
    $nombre_perfil = $reg[$i]['nombre_perfil'];
    $id = $reg[$i]['id_usuario'];
    echo "<option value='$id'>$nombre $apellidos - $nombre_perfil</option>";
}

?>