<?php
require_once("../../../../clases/dias/class_dias.php");
require_once("../../../../clases/conexion.php");

$tra = new dias();
$reg = $tra->get_dias();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_dias'];
    $id = $reg[$i]['id_dias'];
    echo "<option value='$id'>$nom</option>	";
}

?>