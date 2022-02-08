<?php

session_start();
$id_usuario_sesion = $_SESSION["id_user"];
date_default_timezone_set('America/Lima');
$hoy = date("Y-m-d");

require_once("../../../clases/tipo/class_tipo.php");
require_once("../../../clases/conexion.php");
$id_tipo_contrato = $_POST["id_tipo_contrato"]; //1 completo, 2 medio tiempo

$trae = new tipo();
$rege = $trae->get_tipo();

$tra = new tipo();
@$rega = $tra->obtener_tipo($hoy, $id_usuario_sesion);
@$maximo = $rega[0]["maximo"];

if ($id_tipo_contrato == 1) {
    if (@$maximo == null || @$maximo == "") {
        @$maximo = 1;
    } else if (@$maximo == 1) {
        @$maximo = 3;
    } else if (@$maximo == 3) {
        @$maximo = 4;
    } else if (@$maximo == 4) {
        @$maximo = 2;
    }
} else {
    if (@$maximo == null || @$maximo == "") {
        @$maximo = 1;
    } else if (@$maximo == 1) {
        @$maximo = 2;
    }
}
//echo $maximo;

echo "<option value='0'>--Selecione--</option>";
for ($i = 0; $i < count($rege); $i++) {
    $nom = $rege[$i]['nombre_tipo'];
    $id = $rege[$i]['id_tipo'];
    if ($id_tipo_contrato == 1) {

        if ($id == $maximo) {
            echo "<option selected='selected' value='$id'>$nom</option>";
        } else {
            echo "<option value='$id'>$nom</option>";
        }
    }
    if ($id_tipo_contrato == 2) {
        if ($id == 1 || $id == 2) {
            if ($id == $maximo) {
                echo "<option selected='selected' value='$id'>$nom</option>";
            } else {
                echo "<option value='$id'>$nom</option>";
            }
        }
    }
}
?>