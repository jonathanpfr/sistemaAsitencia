<?php

@session_start();
$id_usuario = $_SESSION["id_user"];
if (isset($id_usuario)) {
    $tra = new usuario();
    $reg = $tra->get_usuario();
    for ($i = 0; $i < count($reg); $i++) {

        $id = $reg[$i]["id_usuario"];
        $estado = $reg[$i]["id_estado"];

        echo "<td><a class='manito' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
        echo "<td>" . $reg[$i]["nombre"] . "</td>";
        echo "<td>" . $reg[$i]["apellidos"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_sexo"] . "</td>";
        echo "<td>" . $reg[$i]["telefono"] . "</td>";
        echo "<td>" . $reg[$i]["dni"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_cargo"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_sede"] . "</td>";

        if ($estado == 2) {
            echo "<td class='inactivo'>Inactivo</td>";
        } else {
            echo "<td class='activo'>Activo</td>";
        }
        echo "<td><a  class='manito'  onclick='eliminar($id)'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td>";
        echo "</tr>";
    }
}
?>               