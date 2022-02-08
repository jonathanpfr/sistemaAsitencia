<?php
require_once("../../../../clases/permiso/class_permiso.php");
require_once("../../../../clases/conexion.php");
$tra = new permiso();
$reg = $tra->seleccion_permiso($_POST['id_permiso']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>