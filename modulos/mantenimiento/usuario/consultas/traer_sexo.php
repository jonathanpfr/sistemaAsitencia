<?php
require_once("../../../../clases/sexo/class_sexo.php");
require_once("../../../../clases/conexion.php");

$tra = new sexo();
$reg = $tra->get_sexo();
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $nom = $reg[$i]['nombre_sexo'];
    $id = $reg[$i]['id_sexo'];
    echo "<option value='$id'>$nom</option>	";
}

?>