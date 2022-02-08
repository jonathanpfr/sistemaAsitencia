<?php
require_once("../../../../clases/perfil/class_perfil.php");
require_once("../../../../clases/conexion.php");

$tra = new perfil();
$reg = $tra->obtener_perfil();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_perfil'];
    $id = $reg[$i]['id_perfil'];
    echo "<option value='$id'>$nom</option>	";
}

?>