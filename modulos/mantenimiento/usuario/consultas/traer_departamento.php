<?php
require_once("../../../../clases/departamento/class_departamento.php");
require_once("../../../../clases/conexion.php");

$tra = new departamento();
$reg = $tra->get_departamento();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_departamento'];
    $id = $reg[$i]['id_departamento'];
    echo "<option value='$id'>$nom</option>	";
}

?>