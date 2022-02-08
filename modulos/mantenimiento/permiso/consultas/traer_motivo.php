<?php
require_once("../../../../clases/motivo/class_motivo.php");
require_once("../../../../clases/conexion.php");

$tra = new motivo();
$reg = $tra->get_motivo();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_motivo'];
    $id = $reg[$i]['id_motivo'];
    echo "<option value='$id'>$nom</option>	";
}

?>