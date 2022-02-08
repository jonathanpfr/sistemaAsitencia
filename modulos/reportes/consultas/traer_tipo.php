<?php
require_once("../../../clases/tipo/class_tipo.php");
require_once("../../../clases/conexion.php");

$tra = new tipo();
$reg = $tra->get_tipo();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_tipo'];
    $id = $reg[$i]['id_tipo'];
    echo "<option value='$id'>$nom</option>	";
}

?>