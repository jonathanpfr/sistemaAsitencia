<?php
require_once("../../../../clases/horario/class_horario.php");
require_once("../../../../clases/conexion.php");
$tra = new horario();
$reg = $tra->seleccion_horario($_POST['id_horario']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>