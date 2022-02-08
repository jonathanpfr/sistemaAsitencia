<?php
require_once("../../../clases/asistencia/class_asistencia.php");
require_once("../../../clases/conexion.php");
$tra = new asistencia();
$reg = $tra->seleccion_asistencia($_POST['id_asistencia']);
for ($i = 0; $i < count($reg); $i++) {
    $data['data'] = $reg;
}
echo json_encode($reg);
?>