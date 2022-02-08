<?php
require_once '../../clases/perfil/class_perfil.php';
require_once '../../clases/conexion.php';
$clase_p=new perfil();
$reg=$clase_p->obtener_perfil();

for($i=0;$i<count($reg);$i++){
    $id=$reg[$i]["id_perfil"];
    $nombre=$reg[$i]["nombre_perfil"];
    echo "<option value='$id'>$nombre</option>";
}