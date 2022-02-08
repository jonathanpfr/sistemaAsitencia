<?php
@session_start();
$id_usuario_sesion = $_SESSION['id_user'];
require_once("../../../clases/asistencia/class_asistencia.php");
require_once '../../../clases/horario/class_horario.php';
require_once '../../../clases/permiso/class_permiso.php';
require_once("../../../clases/conexion.php");


$i_id_usuario = $_POST["i_id_usuario"];
$i_fecha = $_POST["i_fecha"];
$hora_entrada_usuario = $_POST["i_hora"];
$tipo = $_POST["i_tipo"];
$ip_publica = $_SERVER['REMOTE_ADDR'];
$localIP = getHostByName(php_uname('n'));
$ip_publica_ip_local = $ip_publica . "," . $localIP;

//$hora_entrada_usuario = "15:40";
//$tipo = 1; //
//$i_id_usuario = 3;
//$i_fecha = "2016-05-25";

$clase_h = new asistencia();
$reg = $clase_h->buscar_horario($i_id_usuario);
$minutos_tolerancia = 10;

$hora_entrada = $reg[0]["hora_entrada"];
$hora_salida = $reg[0]["hora_salida"];
$hora_re_entrada = $reg[0]["hora_re_entrada"];
$hora_re_salida = $reg[0]["hora_re_salida"];
$id_tipo_contrato = $reg[0]["id_tipo_contrato"]; //1 tiempo completo, 2 medio tiempo


$hora_entrada_array = split(":", $hora_entrada);
$minutos_entrada = ((($hora_entrada_array[0]) * 60) + $hora_entrada_array[1]) + $minutos_tolerancia;

$hora_salida_array = split(":", $hora_salida);
$minutos_salida = ((($hora_salida_array[0]) * 60) + $hora_salida_array[1]);

$hora_re_salida_array = split(":", $hora_re_salida);
$minutos_re_salida = ((($hora_re_salida_array[0]) * 60) + $hora_re_salida_array[1]) + $minutos_tolerancia;

$hora_re_entrada_array = split(":", $hora_re_entrada);
$minutos_re_entrada = ((($hora_re_entrada_array[0]) * 60) + $hora_re_entrada_array[1]);


$hora_entrada_usuario_array = split(":", $hora_entrada_usuario);
$minutos_entrada_usuario = ((($hora_entrada_usuario_array[0]) * 60) + $hora_entrada_usuario_array[1]);
$estado = 4;

if ($tipo == 1) {
    if ($minutos_entrada_usuario > $minutos_entrada) {
        //verificar si hay permiso de esa hora
//        $clase_per = new permiso();
//        @$per_reg = $clase_per->get_permiso_usuario($i_fecha, $i_id_usuario);
//        if (@$per_reg[0]["id_permiso"] != null) {
//            @$hora_ini_permiso = $per_reg[0]["hora_inicio"]; //8:00
//            @$hora_fin_permiso = $per_reg[0]["hora_fin"]; //10:00
//
//            @$hora_ini_permiso_array = split(":", @$hora_ini_permiso);
//            @$minutos_ini_permiso = (((@$hora_ini_permiso_array[0]) * 60) + @$hora_ini_permiso_array[1]);
//
//            if ($id_tipo_contrato == 1) {
//                if (($minutos_entrada - $minutos_tolerancia) <= @$minutos_ini_permiso && $minutos_re_entrada >= @$minutos_ini_permiso) {
//                    @$hora_fin_permiso_array = split(":", @$hora_fin_permiso);
//                    @$minutos_fin_permiso = (((@$hora_fin_permiso_array[0]) * 60) + @$hora_fin_permiso_array[1]) + $minutos_tolerancia;
//                    if ($minutos_entrada_usuario > @$minutos_fin_permiso) {
//                        $estado = 7; // permiso tarde
//                    } else {
//                        $estado = 6; //permiso temprano
//                    }
//                } else {
//                    $estado = 5;
//                }
//            } else {
//                if (($minutos_entrada - $minutos_tolerancia) <= @$minutos_ini_permiso && $minutos_salida >= @$minutos_ini_permiso) {
//                    @$hora_fin_permiso_array = split(":", @$hora_fin_permiso);
//                    @$minutos_fin_permiso = (((@$hora_fin_permiso_array[0]) * 60) + @$hora_fin_permiso_array[1]) + $minutos_tolerancia;
//                    if ($minutos_entrada_usuario > @$minutos_fin_permiso) {
//                        $estado = 7; // permiso tarde
//                    } else {
//                        $estado = 6; //permiso temprano
//                    }
//                } else {
//                    $estado = 5;
//                }
//            }
//        } else {
            $estado = 5; //tarde
//        }
    } else {
        $estado = 4; //temprano
    }
}
if ($tipo == 4) {//hora salida refri
    if ($minutos_entrada_usuario > $minutos_re_salida) {
//        $clase_per = new permiso();
//        @$per_reg = $clase_per->get_permiso_usuario($i_fecha, $i_id_usuario);
//        if (@$per_reg[0]["id_permiso"] != null) {
//            @$hora_ini_permiso = $per_reg[0]["hora_inicio"]; //8:00
//            @$hora_fin_permiso = $per_reg[0]["hora_fin"]; //10:00
//
//            @$hora_ini_permiso_array = split(":", @$hora_ini_permiso);
//            @$minutos_ini_permiso = (((@$hora_ini_permiso_array[0]) * 60) + @$hora_ini_permiso_array[1]);
//
//            if ($id_tipo_contrato == 1) {
//                if (($minutos_entrada - $minutos_tolerancia) <= @$minutos_ini_permiso && $minutos_re_entrada >= @$minutos_ini_permiso) {
//                    @$hora_fin_permiso_array = split(":", @$hora_fin_permiso);
//                    @$minutos_fin_permiso = (((@$hora_fin_permiso_array[0]) * 60) + @$hora_fin_permiso_array[1]) + $minutos_tolerancia;
//                    if ($minutos_entrada_usuario > @$minutos_fin_permiso) {
//                        $estado = 7; // permiso tarde
//                    } else {
//                        $estado = 6; //permiso temprano
//                    }
//                } else {
//                    $estado = 5;
//                }
//            }
//        } else {
            $estado = 5; //tarde
//        }
    } else {
        $estado = 4; //temprano
    }
}

//4 temprano
//5 tarde
//6 permiso temprano
//7 permiso tarde
//echo $estado;

$tra = new asistencia();
$tra->add_asistencia_admin($i_id_usuario, $hora_entrada_usuario, $i_fecha, $tipo, $ip_publica_ip_local, $id_usuario_sesion, $estado);
//?>