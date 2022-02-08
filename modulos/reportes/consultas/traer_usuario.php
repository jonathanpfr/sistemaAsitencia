<?php
require_once("../../../clases/conexion.php");
require_once("../../../clases/usuario/class_usuario.php");

 if (!$_GET["q"]) return;
$im=new usuario();
$reg=$im->like_usuario_no_admin($_GET["q"]);
for ($i=0;$i<count($reg);$i++)
{
       $nombre = $reg[$i]["nombre"];
        $id_usuario = $reg[$i]["id_usuario"];
        $apellidos = $reg[$i]["apellidos"];
        $dni=$reg[$i]["dni"];
        $todo=$reg[$i]["todo"];
        echo "$todo|$id_usuario|$nombre|$apellidos|$dni\n";
}
?>