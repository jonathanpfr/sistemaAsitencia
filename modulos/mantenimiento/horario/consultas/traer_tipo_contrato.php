<?php
require_once("../../../../clases/tipo_contrato/class_tipo_contrato.php");
require_once("../../../../clases/conexion.php");

$tra = new tipo_contrato();
$reg = $tra->get_tipo_contrato();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_tipo_contrato'];
    $id = $reg[$i]['id_tipo_contrato'];
    echo "<option value='$id'>$nom</option>	";
}

?>