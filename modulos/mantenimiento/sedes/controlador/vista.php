<?php
@session_start();
$id_usuario = $_SESSION["id_user"];
if (isset($id_usuario)) {
    $tra = new sede();
    $reg = $tra->get_sede();
    for ($i = 0; $i < count($reg); $i++) {
        $id=$reg[$i]["id_sede"];
        $estado=$reg[$i]["id_estado"];
        
        echo "<tr class='text-center'>";
        echo "<td><a class='manito' onclick='modificar($id);'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";
        echo "<td>".$reg[$i]["nombre_sede"]."</td>";
       
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