<?php
require_once("../../../../clases/horario/class_horario.php");
require_once("../../../../clases/conexion.php");
$id_tipo_contrato = $_POST["i_tipo_contrato"];
$tra = new horario();
$reg = $tra->get_horario_tipo_contrato($id_tipo_contrato);
echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($reg); $i++) {
    $dias = $reg[$i]['nombre_dias'];
    $id = $reg[$i]['id_horario'];
    $hora_entrada = $reg[$i]['hora_entrada'];
    $hora_salida = $reg[$i]['hora_salida'];
    $hora_re_entrada = $reg[$i]['hora_re_entrada'];
    $hora_re_salida = $reg[$i]['hora_re_salida'];
    if ($id_tipo_contrato == 1) {//tiempo completo
        echo "<option value='$id'>" . $dias . " " . $hora_entrada . "-" . $hora_re_entrada . " , " . $hora_re_salida . "-" . $hora_salida . "</option>";
    }
    if ($id_tipo_contrato == 2) {//medio tiempo 
        echo "<option value='$id'>" . $dias . " " . $hora_entrada . "-" . $hora_salida . "</option>";
        //echo "<option value='$id'>".$dias." ".$hora_entrada."-".$hora_re_entrada.",".$hora_re_salida."-".$hora_salida."</option>";
    }
}
?>