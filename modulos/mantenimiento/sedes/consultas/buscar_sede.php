<?php
require_once("../../../../clases/sede/class_sede.php");
require_once("../../../../clases/conexion.php");
$tra = new sede();
$reg = $tra->get_sede_seleccion($_POST['id_sede']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>