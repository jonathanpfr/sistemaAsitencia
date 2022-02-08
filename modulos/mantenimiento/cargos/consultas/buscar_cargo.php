<?php
require_once("../../../../clases/cargo/class_cargo.php");
require_once("../../../../clases/conexion.php");
$tra = new cargo();
$reg = $tra->get_cargo_seleccion($_POST['id_cargo']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>