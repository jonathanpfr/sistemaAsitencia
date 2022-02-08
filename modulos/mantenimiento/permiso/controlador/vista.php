<?php
@session_start();
$id_usuario = $_SESSION["id_user"];
if (isset($id_usuario)) {
    $tra = new permiso();
    $reg = $tra->get_permiso();
    for ($i = 0; $i < count($reg); $i++) {

        $id = $reg[$i]["id_permiso"];
        $estado = $reg[$i]["id_estado"];


        echo "<td><a class='manito' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
        echo "<td>" . $reg[$i]["fecha_permiso"] . "</td>";
        echo "<td>" . $reg[$i]["hora_inicio"] . "</td>";
        echo "<td>" . $reg[$i]["hora_fin"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_motivo"] . "</td>";
        echo "<td>" . $reg[$i]["nombre"] . "</td>";
        echo "<td>" . $reg[$i]["apellidos"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_perfil"] . "</td>";
        echo "<td>" . $reg[$i]["nombre_cargo"] . "</td>";
        
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