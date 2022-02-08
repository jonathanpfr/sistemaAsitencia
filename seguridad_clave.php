<?php

session_start();
require_once './clases/usuario/class_usuario.php';
require_once './clases/conexion.php';
$login_dni = $_POST["login_dni"];
$clase_usu = new usuario();
$reg = $clase_usu->contar_usuario_dni($login_dni);
if ($reg[0]["contar"] != 0) {
    $id_usuario = $reg[0]["id_usuario"];
    $_SESSION["id_usuario"] = $id_usuario;
    if (isset($_SESSION["contar_login"])) {
        $_SESSION["contar_login"] = $_SESSION["contar_login"] + 1;
        if ($_SESSION["contar_login"] == 3) {
           
            $clase_usus = new usuario();
            $clase_usus->seguridad_clave($_SESSION["id_usuario"]);
//             echo "1";
        } else {
            echo "0";
        }
    } else {
        $_SESSION["contar_login"] = 1;
        echo "0";
    }
} else {
    echo "0";
}        