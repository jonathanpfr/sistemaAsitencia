<?php
require_once("../../../../clases/usuario/class_usuario.php");
require_once("../../../../clases/conexion.php");
$tra = new usuario();
$reg = $tra->seleccion_usuario($_POST['id_usuario']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>