<?php
require_once("../../../../clases/sede/class_sede.php");
require_once("../../../../clases/conexion.php");

$tra = new sede();
$reg = $tra->get_sede();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_sede'];
    $id = $reg[$i]['id_sede'];
    echo "<option value='$id'>$nom</option>	";
}

?>