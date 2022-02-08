<?php
require_once("../../../../clases/cargo/class_cargo.php");
require_once("../../../../clases/conexion.php");

$tra = new cargo();
$reg = $tra->get_cargos();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_cargo'];
    $id = $reg[$i]['id_cargo'];
    echo "<option value='$id'>$nom</option>	";
}

?>