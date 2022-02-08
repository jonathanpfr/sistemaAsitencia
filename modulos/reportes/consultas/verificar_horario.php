<?php
require_once '../../../clases/asistencia/class_asistencia.php';
require_once '../../../clases/conexion.php';
$i_fecha=$_POST["i_fecha"];//
$i_id_usuario=$_POST["i_id_usuario"];//i_id_usuario
$clase=new asistencia();
$reg=$clase->buscar_horario($i_id_usuario);
$id_dia= $reg[0]["id_dias"];//1=lunes-sabado,2 =solo domingo

$clase2=new asistencia();
$reg2=$clase2->buscar_horario_dia($i_fecha);
$dia= $reg2[0]["semana"];

if($id_dia==1&&$dia!="Sunday"){
    echo "0";
}
else if($id_dia==2&&$dia=="Sunday"){
    echo "0";
}
else{
    echo "1";
}